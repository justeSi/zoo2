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
                'manager_name' => ['required','regex:/^[A-Z][a-z_-]{2,19}$/', 'min:3', 'max:64'],
                'manager_surname' => ['required','regex:/^[A-Z][a-z_-]{2,19}$/', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $manager->name = $request->manager_name;
        $manager->surname = $request->manager_surname;
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
        //
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
                'manager_name' => ['required', 'min:3', 'max:64'],
                'manager_surname' => ['required', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $manager->name = $request->manager_name;
        $manager->surname = $request->manager_surname;
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