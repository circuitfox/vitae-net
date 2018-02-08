<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        return view('admin.labs', ['labs' => Lab::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Lab::class);
        return view('admin.labs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Requests\CreateLab $request) {
    $name = request('name');
    $pathInStorage = 'labs/' . $name . rand(1111, 9999) . '.pdf';
    // TODO: The storage location needs to be changed
    //$path = $request->file('doc')->storeAs('/public', $pathInStorage);

    // create a new patient using the form data
    $lab = new \App\Lab;
    $lab->name = $name;
    $lab->description = request('description');
    $lab->file_path = $pathInStorage;
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
        $lab = Lab::findOrFail($id);
        return view('admin.lab', ['lab' => $lab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        $this->authorize('update', $lab);
        return view('admin.lab.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateLab $request, $id)
    {
        $lab = Lab::find($id);
        $lab->update($request->all());
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
        $this->authorize('delete', $lab);
        // TODO: This needs to be changed once the storage location is changed
        // $labFile = $lab->file_path;
        // File::delete('storage/' . $labFile);
        $lab->delete();
        return redirect()->route('labs.index')->with('message','Lab has been deleted successfully');
    }
}
