<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\InfaChildInfo;
use App\Models\PregWomen;
use App\Models\PhilHealthInfo;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(Patient::with('consultation')->get());
        
        $patients = Patient::with('infaChildInfo','pregWomen','philHealthInfo')->orderBy('id','desc')->paginate(5);
        return view('patient.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
            if($request->has('infants_child_info')){
                $infa_child = InfaChildInfo::create($request->all()); 
            }

            if($request->has('preg_women')){
                $preg_women = PregWomen::create($request->all());
            }

            if($request->has('phil_health_info')){
                $phil_health = PhilHealthInfo::create($request->all());
            }
            
            
            $patient = new Patient;
            $patient->last_name = $request->last_name;
            $patient->first_name = $request->first_name;
            $patient->middle_name = $request->middle_name;
            $patient->birth_date = $request->birth_date;
            $patient->sex = $request->sex;
            $patient->civil_status = $request->civil_status;
            $patient->contact_num = $request->contact_num;


            if($request->has('infants_child_info')){
                $patient->infa_child_info_id = $infa_child->id;
            }

            if($request->has('preg_women')){
                $patient->preg_women_info_id = $preg_women->id;
            }

            if($request->has('phil_health_info')){
                $patient->phil_health_info_id = $phil_health->id;
            }

            $patient->save();

        return redirect()->route('patient.index')->withSuccess('Patient added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::with('infaChildInfo','pregWomen','philHealthInfo')->where('id',$id)->first();
        return view('patient.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
