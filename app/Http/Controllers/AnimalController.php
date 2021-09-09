<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Manager;
use Validator;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::all();
        $managers = Manager::all();
        $animals = Animal::all();
        return view('animal.index', ['species' => $species, 'managers' => $managers, 'animals' => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::all();
        $managers = Manager::all();
        return view('animal.create', ['species' => $species, 'managers' => $managers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = new Animal;
        $validator = Validator::make($request->all(),
        [
            'animal_name' => ['required', 'min:3', 'max:64'],
            'birth_year' => ['required','regex:/^[1-9]+/','not_in:0', 'max:4'],
            'animal_book' => ['required','string','between:3,200'],
        ],
     [
    ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $manager = Manager::find($request->manager_id);
        if($manager->specie_id != $request->specie_id) {
            return redirect()->back()->with('info_message', 'Manager you selected is not responsible for this specie.');
        }
        else {
            $animal->name = $request->animal_name;
            $animal->birth_year = $request->birth_year;
            $animal->animal_book = $request->animal_book;
            $animal->specie_id = $request->specie_id;
            $animal->manager_id = $request->manager_id;
            // dd($animal);
            $animal->save();
        }
        return redirect() -> route('animal.index')->with('success_message', 'New animal has been successfully added.');
    
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        $managers = Manager::all();
        $species = Specie::all();
        return view('animal.edit', ['animal' => $animal, 'managers' => $managers, 'species' => $species]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $animal->name = $request->animal_name;
        $animal->birth_year = $request->animal_birth_year;
        $animal->animal_book = $request->animal_book;
        $animal->specie_id = $request->specie_id;
        $animal->manager_id = $request->manager_id;
        // dd($animal);
        $animal->save();
        return redirect()->route('animal.index')->with('success_message', 'Sekmingai pakeista.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animal.index')->with('success_message', 'Sekmingai ištrinta.');
    }
}