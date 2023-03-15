<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Treatment;
use App\Models\TreatmentMedicine;
use App\Models\Medicine;
use App\Models\Consultation;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {

        //treatment count for 7 days
        $treatmentCountForPastSevenDays = Treatment::where('created_at', '>=', Carbon::today()->subDays(7))->get()->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('Y-m-d');
        });

        $DL_treatmentDay[] = null;
        $DP_treatmentCount[] = null;
        foreach ($treatmentCountForPastSevenDays as $day => $treament) {
            $count = count($treament);

            $DL_treatmentDay[] = $day;
            $DP_treatmentCount[] = $count;
        }

        //medicine count given for 7 days
        $medCountGivenForPastSevenDays = TreatmentMedicine::where('created_at', '>=', Carbon::today()->subDays(7))->get()->groupBy(function ($q) {
            return Carbon::parse($q->created_at)->format('Y-m-d');
        });

        $DL_medGivenDay[] = null;
        $DP_medCount[] = null;
        foreach ($medCountGivenForPastSevenDays as $day => $meds) {
            $medCount = 0;
            foreach ($meds as $key => $med) {
                $medCount = $medCount + $med->quantity;

            }
            $DL_medGivenDay[] = $day;
            $DP_medCount[] = $medCount;
        }

        //medicine count by Category
        $medCountByCategories = TreatmentMedicine::groupBy('category')->where('created_at', '>=', Carbon::today())
            ->selectRaw('category, sum(quantity) as sum')
            ->get();

        $DL_medCategory[] = null;
        $DP_medCategoryCount[] = null;
        foreach ($medCountByCategories as $medCountByCategory) {
            $DL_category[] = $medCountByCategory->category;
            $DP_categoryCount[] = $medCountByCategory->sum;
        }

        //patient count by BRGY
        $currentMonth = date('m');
        $patientCountsByBrgys = DB::table('consultations')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->whereMonth('consultations.created_at', '=', $currentMonth)
            ->select('addresses.brgy', DB::raw('count(patients.id) as patient_count'))
            ->groupBy('addresses.brgy')
            ->get();

        $DL_patientBrgy[] = null;
        $DP_patientCount[] = null;
        foreach ($patientCountsByBrgys as $patientCountsByBrgy) {
            $DL_patientBrgy[] = $patientCountsByBrgy->brgy;
            $DP_patientCount[] = $patientCountsByBrgy->patient_count;
        }

        return view('analytics.index', compact('DL_patientBrgy', 'DP_patientCount', 'DL_treatmentDay', 'DP_treatmentCount', 'DL_medGivenDay', 'DP_medCount', 'DL_medCategory', 'DP_medCategoryCount'));



    }
}