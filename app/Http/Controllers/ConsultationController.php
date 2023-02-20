<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Patient;

class ConsultationController extends Controller
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
    public function create(Request $request)
    {
        $patients = Patient::query()
        ->where('last_name', 'LIKE', "%{$request->term}%") 
        ->orWhere('first_name', 'LIKE', "%{$request->term}%") 
        ->orWhere('middle_name', 'LIKE', "%{$request->term}%") 
        
        ->orderBy('id','desc')->paginate(5);

        return view('consultation.create',compact('patients'));
    }

    public function create_consultation($id)
    {
        $patient = Patient::findOrFail($id);
        return view('consultation.create-consultation',compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'weight' => 'required',
            'height' => 'required',
            'BP' => 'required',
            'PR' => 'required',
            'RR' => 'required',
            'CC' => 'required',
            'patient_id' => 'required',
          
        ]);
        Consultation::create($request->all());
        return redirect()->route('consultation.create')->withSuccess('Consultation added successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
