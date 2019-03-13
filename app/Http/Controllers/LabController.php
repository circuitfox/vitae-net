<?php

namespace App\Http\Controllers;

use App\Events\LabAdded;
use App\Events\LabRemoved;
use App\Http\Requests;
use App\Patient;
use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.labs.create', ['patients' => Patient::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateLab $request) {
        $name = request('name');
        $file = request('doc');

        $lab = new \App\Lab;
        $path = 'labs/';
        $fileName = str_replace(' ', '-', $name) . rand(1111, 9999) . '.pdf';
        $pathInStorage = $path . $fileName;
        $lab->name = $name;
        $lab->description = request('description');
        $lab->file_path = $pathInStorage;
        $lab->patient_id = request('patient_id');
        // save it to the database
        $lab->save();

        // write pdf to storage
        Storage::disk('public')->putFileAs($path, $file, $fileName);

        if ($lab->patient_id) {
            event(new LabAdded($lab));
        }

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
        $pdf = asset('storage/' . $lab->file_path);
        $labs = session('labs');
        if (!isset($labs[$id])) {
            $labs[$id] = true;
            session(['labs' => $labs]);
        }
        return view('admin.lab', ['lab' => $lab, 'pdf' => $pdf]);
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
        return view('admin.lab.edit', ['lab' => $lab, 'patients' => Patient::all()]);
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
        $oldPatient = $lab->patient;
        $file = $request->doc;
        $data = $request->all();
        if (isset($data['doc'])) {
            $path = dirname($lab->file_path);
            $fileName = basename($lab->file_path);
            Storage::disk('public')->delete($lab->file_path);
            Storage::disk('public')->putFileAs($path, $file, $fileName);
            unset($data['doc']);
        }
        $lab->update($data);
        $newLab = $lab->fresh();
        if ($oldPatient) {
            event(new LabRemoved($lab, $oldPatient));
        }
        if ($newLab->patient_id) {
            event(new LabAdded($newLab));
        }

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
        Storage::disk('public')->delete($lab->file_path);
        $lab->delete();
        return redirect()->route('labs.index')->with('message','Lab has been deleted successfully');
    }
}
