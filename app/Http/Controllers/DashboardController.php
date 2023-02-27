<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\Treatment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $patient_count = Patient::all()->count();

        $forTreatment_count = Consultation::doesntHave('treatment')->count();

        $criticalMedicine_count = Medicine::groupBy('med_id')
            ->havingRaw('sum(stocks) > 0')
            ->havingRaw('sum(stocks) < 10')
            ->count();

        $treatmentedPatientToday_count = Treatment::whereDate('created_at', Carbon::today())->count();

        return view('home', compact('patient_count', 'forTreatment_count', 'criticalMedicine_count', 'treatmentedPatientToday_count'));
    }
}