<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LabController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::all();
        return view('labs.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request) {
    $name = request('name');
    $pathInStorage = 'labs/' . $name . rand(1111, 9999) . '.pdf';
    $path = $request->file('doc')->storeAs('/public', $pathInStorage);

    // create a new patient using the form data
    $lab = new \App\Lab;
    $lab->name = $name;
    $lab->description = request('description');
    $lab->path = $pathInStorage;
    $lab->patient_id = request('patient_id');
    // save it to the database
    $lab->save();

    // redirect to home page
    return redirect()->route('labs.index')->with('message','Lab has been added successfully');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lab = Lab::find($id);
        $labUpdate = $request->all();
        $lab->update($labUpdate);
        return redirect()->route('labs.index')->with('message','Lab has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $labFile = $lab->path;
        File::delete('storage/' . $labFile);
        $lab->delete();
        return redirect()->route('labs.index')->with('message','Lab has been deleted successfully');
    }
}
