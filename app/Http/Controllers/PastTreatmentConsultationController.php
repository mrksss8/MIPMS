<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\TreatmentMedicine;
class PastTreatmentConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with('patient')->orderBy('id','desc')->paginate(5);
        return view('past-treatment-consultation.index',compact('consultations'));
    }

    public function show($id)
    {
        $consultation = Consultation::with('patient','treatment.medicine.dosage')->findOrFail($id);
        return view('past-treatment-consultation.show',compact('consultation'));
    }


}
