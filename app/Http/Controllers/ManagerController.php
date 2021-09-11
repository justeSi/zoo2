<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Animal;
use Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::all();
        $managers = Manager::orderBy('name')->get();
        $animals = Animal::all();
        return view('manager.index', ['species' => $species, 'managers' => $managers, 'animals' => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::all();
        $animals = Animal::all();
        return view('manager.create', ['species' => $species, 'animals' => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manager = new Manager;
        $validator = Validator::make($request->all(),
            [
                'manager_name' => ['required', 'regex:/^([^0-9]*)$/', 'min:3', 'max:64'],
                'manager_surname' => ['required', 'regex:/^([^0-9]*)$/', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $manager->name = mb_convert_case($request->manager_name, MB_CASE_TITLE, 'UTF-8');
        $manager->surname = mb_convert_case($request->manager_surname, MB_CASE_TITLE, 'UTF-8');
        $manager->specie_id = $request->specie_id;
        // dd($manager);
        $manager->save();
        return redirect()->route('manager.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {   
        $animals = Animal::orderBy('name')->get();
        return view('manager.show', ['manager' => $manager, 'animals' => $manager->managerGetAnimals]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $animals = Animal::all();
        $species = Specie::all();
        return view('manager.edit', ['manager' => $manager, 'animals' => $animals, 'species' => $species]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $validator = Validator::make($request->all(),
            [
                'manager_name' => ['required', 'regex:/^([^0-9]*)$/', 'min:3', 'max:64'],
                'manager_surname' => ['required', 'regex:/^([^0-9]*)$/', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $manager->name = mb_convert_case($request->manager_name, MB_CASE_TITLE, 'UTF-8');
        $manager->surname = mb_convert_case($request->manager_surname, MB_CASE_TITLE, 'UTF-8');
        $manager->specie_id = $request->specie_id;
        // dd($manager);
        $manager->save();
        return redirect()->route('manager.index')->with('success_message', 'Sekmingai pakeista.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        if($manager->managerGetAnimals->count()){
            return redirect()->back()->with('info_message', 'negalimas veiksmas');
        }
        $manager->delete();
        return redirect()->route('manager.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}