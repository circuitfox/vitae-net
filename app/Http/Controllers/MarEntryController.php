<?php

namespace App\Http\Controllers;

use App\MarEntry;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MarEntryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', MarEntry::class);
        return view('admin.mar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateMarEntry $request)
    {
        $mars = $request->input('mars.*');
        foreach ($mars as &$mar) {
            if (isset($mar['given_at'])) {
                $mar['given_at'] = MarEntry::timesToInteger($mar['given_at']);
            }
            if (!isset($mar['stat'])) {
                $mar['stat'] = false;
            }
        }
        MarEntry::insert($mars);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marEntry = MarEntry::findOrFail($id);
        $this->authorize('update', $marEntry);
        return view('admin.mar.edit', ['marEntry' => $marEntry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateMarEntry $request, $id)
    {
        $mar = MarEntry::findOrFail($id);
        $data = $request->all();
        if (isset($data['given_at'])) {
            $data['given_at'] = MarEntry::timesToInteger($data['given_at']);
        }
        if (!isset($data['stat'])) {
            $data['stat'] = false;
        }
        $mar->update($data);
        return back();
    }
}
