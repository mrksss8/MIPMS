<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\TreatmentMedicine;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\MedicineDosage;
use App\Models\LaboratoryList;
use App\Models\Laboratory;
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
        $for_treatments = Consultation::with('patient')->where('treatment_id', null)->orderBy('date', 'desc')->paginate(5);
        return view('treatment.create', compact('for_treatments'));
    }

    public function create_treatment($id)
    {
        $medicines = Medicine::with('dosage')->groupBy('med_id')->where('stocks', '>', 0)->get();
        $dosages = MedicineDosage::all();
        $consultation = Consultation::with('patient')->findOrFail($id);
        $lab_list = LaboratoryList::all();

        return view('treatment.create-treatment', compact('consultation', 'medicines', 'dosages', 'lab_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ['findings', 'next_consultation', 'consultation_id'];

        // $treatment = Treatment::create($request->all());

        $treatment = new Treatment;
        $treatment->findings = $request->findings;
        $treatment->next_consultation = $request->next_consultation;
        $treatment->consultation_id = $request->consultation_id;



        // $treatment_medecine = TreatmentMedicine::create($request->all());
        //  $treatment_medecine_update = TreatmentMedicine::find($treatment_medecine->id);
        //  $treatment_medecine_update->treatment_id = $treatment->id;
        //  $treatment_medecine_update->save();

        if ($request->medicine_id != null) {
            for ($i = 0; $i < count($request->medicine_id); $i++) {

                //get medicine category
                $medic = Medicine::with('category')->where('id', $request->medicine_id[$i])->first();
                $category = $medic->category->category;

                $request_med = $request->quantity[$i];
                $stocks_sum = Medicine::where('med_id', $request->medicine_id[$i])->sum('stocks');

                if ($stocks_sum > $request_med) {
                    $treatment->save();

                    $consultation = Consultation::find($request->consultation_id);
                    $consultation->treatment_id = $treatment->id;
                    $consultation->save();

                    if ($request->lab_name != null) {

                        for ($j = 0; $j < count($request->lab_name); $j++) {

                            $lab_des = $request->lab_name[$i] . "_des";
                            $laboratories = [
                                [
                                    'treatment_id' => $treatment->id,
                                    'lab_name' => $request->lab_name[$j],
                                    'lab_des' => $request->$lab_des,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]
                            ];
                            Laboratory::insert($laboratories);
                        }
                    }

                    $medicines = [
                        [
                            'treatment_id' => $treatment->id,
                            'medicine_id' => $request->medicine_id[$i],
                            'category' => $category,
                            'quantity' => $request->quantity[$i],
                            'description' => $request->description[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    ];
                    TreatmentMedicine::insert($medicines);

                    while ($request_med > 0) {

                        $med = Medicine::where('med_id', $request->medicine_id[$i])->where('stocks', '>', 0)->orderBy('expi_date', 'asc')->latest()->first();

                        if ($request_med > $med->stocks) {
                            $med_stocks = $med->stocks - $med->stocks;
                        } else {
                            $med_stocks = $med->stocks - $request_med;
                        }

                        //iterator decreament
                        $request_med = $request_med - $med->stocks;

                        $med->stocks = $med_stocks;
                        $med->save();
                    }
                } else {
                    $med = Medicine::where('med_id', $request->medicine_id[$i])->where('stocks', '>', 0)->orderBy('expi_date', 'asc')->latest()->first();
                    return redirect()->back()->with('error', "Insuficient Medicince {$med->brand_name}");
                }
            }
        } else {
            $treatment->save();

            $consultation = Consultation::find($request->consultation_id);
            $consultation->treatment_id = $treatment->id;
            $consultation->save();


            for ($i = 0; $i < count($request->lab_name); $i++) {

                $lab_des = $request->lab_name[$i] . "_des";
                $laboratories = [
                    [
                        'treatment_id' => $treatment->id,
                        'lab_name' => $request->lab_name[$i],
                        'lab_des' => $request->$lab_des,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                ];
                Laboratory::insert($laboratories);
            }
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