<?php

namespace App\Http\Controllers;

use App\Models\MedicineDosage;
use Illuminate\Http\Request;

class MedicineDosageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicine_dosage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validated_request = $request->validate([
            'dosage' => 'required|regex:/^[A-Za-z\s]+$/|unique:medicine_dosages',
        ], ['dosage.unique' => 'Dosage has already exist']);


        MedicineDosage::create($validated_request);

        return redirect()->back()->withSuccess('Medicine Dosage added successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicineDosage  $medicineDosage
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineDosage $medicineDosage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicineDosage  $medicineDosage
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineDosage $medicineDosage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicineDosage  $medicineDosage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineDosage $medicineDosage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicineDosage  $medicineDosage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineDosage $medicineDosage)
    {
        //
    }
}