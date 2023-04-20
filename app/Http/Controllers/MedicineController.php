<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\MedicineDosage;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $medicines = Medicine::with('category', 'dosage')->where('stocks', '>', 0)->orderBy('expi_date', 'asc')->paginate(15);
        return view('medicine.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MedicineCategory::orderBy('category', 'asc')->get();
        $dosages = MedicineDosage::orderBy('dosage', 'asc')->get();
        return view('medicine.create', compact('categories', 'dosages'));
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
            'brand_name' => 'required',
            'stocks' => 'required',
            'dosage_id' => 'required',
            'category_id' => 'required',
            'expi_date' => 'required|date|after_or_equal:today',
        ]);

        $medicine = Medicine::create($validated_request);

        //update medicine med_id
        $med = Medicine::find($medicine->id);
        $med->med_id = $medicine->id;
        $med->save();

        return redirect()->back()->withSuccess('Medicine added successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        $categories = MedicineCategory::all();
        $dosages = MedicineDosage::all();
        return view('medicine.edit', compact('medicine', 'categories', 'dosages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated_request = $request->validate([
            'brand_name' => 'required',
            'stocks' => 'required',
            'dosage_id' => 'required',
            'category_id' => 'required',
            'expi_date' => 'required',
        ]);

        Medicine::findOrFail($id)->update($validated_request);

        return redirect()->route('medicine.index')->withSuccess('Medicine Update successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}