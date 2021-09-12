<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Manager;
use Validator;
use PDF;

class AnimalController extends Controller
{
    
    const RESULTS_IN_PAGE = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::all();
        $managers = Manager::all();
        $animals = Animal::orderBy('name')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
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
                'animal_name' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:64'],
                'birth_year' => ['required','not_in:0', 'max:4'],
                'animal_book' => ['required','string'],
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
            $animal->name = mb_convert_case($request->animal_name, MB_CASE_TITLE, 'UTF-8');
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
        $managers = Manager::orderBy('name')->get();
        return view('animal.show', ['managers' => $managers, 'animal' => $animal]);
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
        $validator = Validator::make($request->all(),
            [
                'animal_name' => ['required', 'regex:/^([^0-9]*)$/', 'min:3', 'max:64'],
                'animal_birth_year' => ['required','min:4', 'max:4'],
                'animal_book' => ['required','string'],
            ],
            [
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
            $manager = Manager::find($request->manager_id);
            if($manager->specie_id != $request->specie_id) {
                return redirect()->back()->with('info_message', 'Manager you selected is not responsible for this specie.');
            }
            else {
                $animal->name = mb_convert_case($request->animal_name, MB_CASE_TITLE, 'UTF-8');
                $animal->birth_year = $request->animal_birth_year;
                $animal->animal_book = $request->animal_book;
                $animal->specie_id = $request->specie_id;
                $animal->manager_id = $request->manager_id;
                // dd($animal);
                $animal->save();
            }
        return redirect()->route('animal.index')->with('success_message', 'Successfully changed');
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
        return redirect()->route('animal.index')->with('success_message', 'Successfully removed.');
    }
    
    public function pdf(Animal $animal)
    {
        $pdf = PDF::loadView('animal.pdf', ['animal' => $animal]);
        return $pdf->download(ucfirst($animal->name).'-'.ucfirst($animal->animalGetSpecie->name).'.pdf');
    }

}