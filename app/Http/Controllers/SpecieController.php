<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use Validator;

class SpecieController extends Controller
{
    // const RESULTS_IN_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::orderBy('name')->get();
        return view('specie.index', ['species' => $species]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $species = Specie::all();
        $specie = new Specie;
        $validator = Validator::make($request->all(),
            [
                'specie_name' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        } 
        if (Specie::where('name', $request->specie_name)->exists()) {
            return redirect()->back()->with('info_message', 'This specie already is in the list');
        }
        
        else {
            $specie->name = mb_convert_case($request->specie_name, MB_CASE_TITLE, 'UTF-8');
            // dd($specie);
            $specie->save();
            return redirect()->route('specie.index')->with('success_message', 'Successfully added');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function show(Specie $specie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function edit(Specie $specie)
    {
        return view('specie.edit', ['specie' => $specie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specie $specie)
    {
        $validator = Validator::make($request->all(),
            [
                'specie_name' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:64'],
            ],
            [
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $specie->name = mb_convert_case($request->specie_name, MB_CASE_TITLE, 'UTF-8');
        // dd($specie);
        $specie->save();
        return redirect()->route('specie.index')->with('success_message', 'Successfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specie $specie)
    {
        if($specie->specieGetManagers()->count()) {
            return redirect()->route('specie.index')->with('info_message', 'You cannot delete specie, because u have manager
            working with it.');
        }
        $specie->delete();
        return redirect()->route('specie.index')->with('success_message', 'Successfully removed');
    }
}