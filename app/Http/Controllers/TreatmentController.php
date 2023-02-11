<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\TreatmentMedicine;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\MedicineDosage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $for_treatments = Consultation::with('patient')->where('treatment_id',null)->orderBy('id','desc')->paginate(5);
        return view('treatment.create',compact('for_treatments'));
    }

    public function create_treatment($id)
    {
        $medicines = Medicine::with('dosage')->get();
        $dosages = MedicineDosage::all();
        $consultation = Consultation::with('patient')->findOrFail($id);

      return view('treatment.create-treatment',compact('consultation','medicines','dosages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        $treatment = Treatment::create($request->all());

        $consultation = Consultation::find($request->consultation_id);
        $consultation->treatment_id = $treatment->id;
        $consultation->save();

        // $treatment_medecine = TreatmentMedicine::create($request->all());
        //  $treatment_medecine_update = TreatmentMedicine::find($treatment_medecine->id);
        //  $treatment_medecine_update->treatment_id = $treatment->id;
        //  $treatment_medecine_update->save();

      
        for($i = 0; $i<count($request->medicine_id); $i++)
                {
                $medicines = [
                    [
                        'treatment_id' => $treatment->id,
                        'medicine_id' =>  $request->medicine_id[$i],
                        'quantity' => $request->quantity[$i],
                        'description' => $request->description[$i],
                        ]
                    ];   
                    TreatmentMedicine::insert($medicines);
                    

                    $med = Medicine::where('med_id',$request->medicine_id[$i])->where('stocks','>',0)->orderBy('expi_date', 'asc')->latest()->first();
                        $med_stocks = $med->stocks - $request->quantity[$i];
                    $med->stocks = $med_stocks;
                    $med->save();

                }


        

            return redirect()->route('treatment.create')->withSuccess('Treatment given successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        //
    }
}
