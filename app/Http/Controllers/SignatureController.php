<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Signature;
use App\Http\Requests;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Signature::class);
        return view('admin.signatures', ['signatures' => Signature::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateSignature $request)
    {
        $date = new DateTime('now', new DateTimeZone('America/Chicago'));
        $data = $request->all();
        $sigs = [];
        $complete = $request->session()->get('complete.' . $data['medical_record_number']);
        if ($complete === null) {
            $complete = [];
        }
        if (isset($data['medications'])) {
            foreach ($data['medications'] as $idx => $med) {
                $sigs[$idx]['medical_record_number'] = $data['medical_record_number'];
                $sigs[$idx]['medication_id'] = $med['medication_id'];
                $sigs[$idx]['comments'] = $med['comments'];
                $sigs[$idx]['student_name'] = $data['student_name'];
                $sigs[$idx]['time'] = $data['time'] . ' ' . $date->format('m/d/Y');
                array_push($complete, [
                    'medication_id' => $med['medication_id'],
                    'time' => $sigs[$idx]['time'],
                ]);
            }
        }
        $request->session()->put('complete.' . $data['medical_record_number'], $complete);
        Signature::insert($sigs);
        return back();
    }

    public function delete(Requests\DestroySignature $request)
    {
        if (isset($request->ids)) {
            Signature::destroy($request->ids);
        }
        return back();
    }
}
