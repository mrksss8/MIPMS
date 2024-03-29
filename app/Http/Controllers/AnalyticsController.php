<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Treatment;
use App\Models\TreatmentMedicine;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Consultation;
use App\Models\Barangay;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {

        // dd($request->brgy);
        $brgys = Barangay::all();

        $initialMonth = Carbon::now()->format('m');
        $month = $request->month;
        $currentMonth = null;
        $currentMonth = $currentMonth ?? $month ?? $initialMonth;


        $patientsByBrgys = Patient::join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->select('addresses.brgy', DB::raw('count(patients.id) as patient_count'))
            ->groupBy('addresses.brgy')->get();

        //numPatientsPerBRGY
        // $patientsByBrgys = Patient::join('addresses', 'patients.address_id', '=', 'addresses.id')
        //     ->select('addresses.brgy', DB::raw('COUNT(DISTINCT patients.id) AS patient_count'))
        //     ->groupBy('addresses.brgy')
        //     ->get();


        if ($patientsByBrgys->isNotEmpty()) {
            foreach ($patientsByBrgys as $patientsByBrgy) {
                $DL_patientsBrgy[] = $patientsByBrgy->brgy;
                $DP_patientsBrgyCount[] = $patientsByBrgy->patient_count;
            }
        } else {
            $DL_patientsBrgy[] = null;
            $DP_patientsBrgyCount[] = null;
        }

        //numConsultationPerBRGY
        $consultationCountsByBrgys = DB::table('consultations')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->select('addresses.brgy', DB::raw('count(patients.id) as patient_count'))
            ->groupBy('addresses.brgy')->get();

        if ($consultationCountsByBrgys->isNotEmpty()) {
            foreach ($consultationCountsByBrgys as $consultationCountsByBrgy) {
                $DL_consultationBrgy[] = $consultationCountsByBrgy->brgy;
                $DP_consultationBrgyCount[] = $consultationCountsByBrgy->patient_count;
            }
        } else {
            $DL_consultationBrgy[] = null;
            $DP_consultationBrgyCount[] = null;
        }

        //numGivenMedPerBRGY
        // $medicinesByBrgys = Medicine::select('addresses.brgy', 'medicines.brand_name', DB::raw('sum(treatment_medicines.quantity) as total_quantity'))
        //     ->join('treatment_medicines', 'medicines.id', '=', 'treatment_medicines.medicine_id')
        //     ->join('treatments', 'treatment_medicines.treatment_id', '=', 'treatments.id')
        //     ->join('consultations', 'treatments.id', '=', 'consultations.treatment_id')
        //     ->join('patients', 'consultations.patient_id', '=', 'patients.id')
        //     ->join('addresses', 'patients.address_id', '=', 'addresses.id')
        //     ->groupBy('addresses.brgy', 'medicines.brand_name')->get();

        $medicinesByBrgys = Medicine::select('addresses.brgy', 'medicines.brand_name', DB::raw('SUM(treatment_medicines.quantity) AS total_quantity'))
            ->join('treatment_medicines', 'medicines.id', '=', 'treatment_medicines.medicine_id')
            ->join('treatments', 'treatment_medicines.treatment_id', '=', 'treatments.id')
            ->join('consultations', 'treatments.id', '=', 'consultations.treatment_id')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->groupBy('addresses.brgy')->get();


        if ($medicinesByBrgys->isNotEmpty()) {
            foreach ($medicinesByBrgys as $medicinesByBrgy) {
                $DL_medicinesBrgy[] = $medicinesByBrgy->brgy;
                $DP_medicinesBrgyCount[] = $medicinesByBrgy->total_quantity;
            }
        } else {
            $DL_medicinesBrgy[] = null;
            $DP_medicinesBrgyCount[] = null;
        }

        //medNumGivenByCategory
        $medCountByCategories = TreatmentMedicine::groupBy('category')
            ->selectRaw('category, sum(quantity) as sum')
            ->get();

        if ($medCountByCategories->isNotEmpty()) {
            foreach ($medCountByCategories as $medCountByCategory) {
                $DL_medCategory[] = $medCountByCategory->category;
                $DP_medCategoryCount[] = $medCountByCategory->sum;
            }
        } else {
            $DL_medCategory[] = null;
            $DP_medCategoryCount[] = null;
        }


        //criticalMed
        $criticalMedicines = DB::table('medicines')
            ->select('brand_name', DB::raw('SUM(stocks) as total_stocks'), 'med_id')
            ->groupBy('med_id')
            ->havingRaw('SUM(stocks) < 11')
            ->get();

        if ($criticalMedicines->isNotEmpty()) {
            foreach ($criticalMedicines as $criticalMedicine) {
                $DL_criticalMedicineBrandName[] = $criticalMedicine->brand_name;
                $DP_criticalMedicineBrandNameStock[] = $criticalMedicine->total_stocks;
            }
        } else {
            $DL_criticalMedicineBrandName[] = null;
            $DP_criticalMedicineBrandNameStock[] = null;
        }

        //expiredMed
        $expiredMedicines = DB::table('medicines')
            ->select('brand_name', DB::raw('SUM(stocks) as total_stocks'), 'med_id', 'expi_date')
            ->where('expi_date', '<=', Carbon::today())
            ->groupBy('med_id')
            ->get();

        if ($expiredMedicines->isNotEmpty()) {
            foreach ($expiredMedicines as $expiredMedicine) {
                $DL_expiMedicineBrandName[] = $expiredMedicine->brand_name;
                $DP_expiMedicineBrandNameStock[] = $expiredMedicine->total_stocks;
            }
        } else {
            $DL_expiMedicineBrandName[] = null;
            $DP_expiMedicineBrandNameStock[] = null;
        }
        //To expiredMed    
        $toexpiredMedicines = DB::table('medicines')
            ->select('brand_name', DB::raw('SUM(stocks) as total_stocks'), 'med_id', 'expi_date')
            ->where('expi_date', '>', Carbon::today())
            ->where('expi_date', '<=', Carbon::today()->addMonth())
            ->groupBy('med_id')
            ->get();

        if ($toexpiredMedicines->isNotEmpty()) {
            foreach ($toexpiredMedicines as $toexpiredMedicine) {
                $DL_toexpiMedicineBrandName[] = $toexpiredMedicine->brand_name;
                $DP_toexpiMedicineBrandNameStock[] = $toexpiredMedicine->total_stocks;
            }
        } else {
            $DL_toexpiMedicineBrandName[] = null;
            $DP_toexpiMedicineBrandNameStock[] = null;
        }

        //patientSexCount
        $patientMaleCount = Patient::where('sex', 'male')->count();
        $patientFemaleCount = Patient::where('sex', 'female')->count();




        $now = Carbon::now(); // get current datetime
        $past_months = []; // create empty array to store past months

        $now = Carbon::now(); // get current datetime
        $past_months = []; // create empty array to store past months

        for ($i = 1; $i <= $now->month; $i++) {
            // subtract i months from current datetime
            $past_month = $now->copy()->subMonths($i - 1);
            $past_month_number = $past_month->format('m'); // get month number
            $past_month_name = $past_month->format('F'); // get month name
            $past_months[$past_month_number] = $past_month_name; // add month number and name to array
        }

        //treatmentCountsByBrgys
        $treatmentCountsByBrgys = Treatment::whereHas('consultation.patient.address', function ($query) {
            $query->where('brgy', '!=', ''); // check if barangay is not empty
        })
            ->whereMonth('treatments.created_at', $currentMonth) // filter by current month
            ->selectRaw('count(*) as count, addresses.brgy')
            ->join('consultations', 'treatments.consultation_id', '=', 'consultations.id')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->groupBy('addresses.brgy')
            ->get();


        if ($treatmentCountsByBrgys->isNotEmpty()) {
            foreach ($treatmentCountsByBrgys as $treatmentCountsByBrgy) {
                $DL_treatmentBrgy[] = $treatmentCountsByBrgy->brgy;
                $DP_treatmentBrgyCount[] = $treatmentCountsByBrgy->count;
            }
        } else {
            $DL_treatmentBrgy[] = null;
            $DP_treatmentBrgyCount[] = null;
        }

        //patientCountsByBrgys
        $patientCountsByBrgys = Patient::join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->select('addresses.brgy', DB::raw('COUNT(patients.id) as patient_count'))
            ->whereMonth('patients.created_at', '=', $currentMonth)
            ->groupBy('addresses.brgy')
            ->get();


        if ($patientCountsByBrgys->isNotEmpty()) {
            foreach ($patientCountsByBrgys as $patientCountsByBrgy) {
                $DL_patientBrgy[] = $patientCountsByBrgy->brgy;
                $DP_patientBrgyCount[] = $patientCountsByBrgy->patient_count;
            }
        } else {
            $DL_patientBrgy[] = null;
            $DP_patientBrgyCount[] = null;
        }

        $consultationCountsByBrgys = Consultation::select('addresses.brgy', DB::raw('COUNT(consultations.id) as consultation_count'))
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->whereMonth('consultations.created_at', '=', $currentMonth)
            ->groupBy('addresses.brgy')
            ->get();

        if ($consultationCountsByBrgys->isNotEmpty()) {
            foreach ($consultationCountsByBrgys as $consultationCountsByBrgy) {
                $DL_constultationBrgy[] = $consultationCountsByBrgy->brgy;
                $DP_constultationBrgyCount[] = $consultationCountsByBrgy->consultation_count;
            }
        } else {
            $DL_constultationBrgy[] = null;
            $DP_constultationBrgyCount[] = null;
        }

        $medicineGivenCountsByBrgys = TreatmentMedicine::select('medicines.id', 'medicines.brand_name', 'addresses.brgy', DB::raw('SUM(quantity) as quantity_sum'))
            ->join('medicines', 'treatment_medicines.medicine_id', '=', 'medicines.id')
            ->join('treatments', 'treatment_medicines.treatment_id', '=', 'treatments.id')
            ->join('consultations', 'treatments.consultation_id', '=', 'consultations.id')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->whereMonth('treatment_medicines.created_at', '=', $currentMonth)
            ->groupBy('addresses.brgy')
            ->get();

        if ($medicineGivenCountsByBrgys->isNotEmpty()) {
            foreach ($medicineGivenCountsByBrgys as $medicineGivenCountsByBrgy) {
                $DL_medicineBrgy[] = $medicineGivenCountsByBrgy->brgy;
                $DP_medicineBrandNameBrgyCount[] = $medicineGivenCountsByBrgy->brand_name;
                $DP_medicineBrgyCount[] = $medicineGivenCountsByBrgy->quantity_sum;
            }
        } else {
            $DL_medicineBrgy[] = null;
            $DP_medicineBrgyCount[] = null;
            $DP_medicineBrandNameBrgyCount[] = null;
        }

        $medicinesByBrgy = DB::table('treatment_medicines')
            ->join('medicines', 'treatment_medicines.medicine_id', '=', 'medicines.id')
            ->join('treatments', 'treatment_medicines.treatment_id', '=', 'treatments.id')
            ->join('consultations', 'treatments.consultation_id', '=', 'consultations.id')
            ->join('patients', 'consultations.patient_id', '=', 'patients.id')
            ->join('addresses', 'patients.address_id', '=', 'addresses.id')
            ->select('medicines.brand_name', 'addresses.brgy', DB::raw('SUM(treatment_medicines.quantity) as total_quantity'))
            ->where('addresses.brgy', '=', $request->brgy)
            ->groupBy('medicines.brand_name', 'addresses.brgy')
            ->get();

        $currentBrgy = $request->brgy;


        if ($medicinesByBrgy->isNotEmpty()) {
            foreach ($medicinesByBrgy as $medicineByBrgy) {
                $DL_medicineBrand_name[] = $medicineByBrgy->brand_name;
                $DP_medicineTotal_quantity[] = $medicineByBrgy->total_quantity;
                $DP_brgy[] = $medicineByBrgy->brgy;
            }
        } else {
            $DL_medicineBrand_name[] = null;
            $DP_medicineTotal_quantity[] = null;
            $DP_brgy[] = null;
        }

        return view(
            'analytics.index',
            compact(
                'DL_patientsBrgy',
                'DP_patientsBrgyCount',
                'DL_consultationBrgy',
                'DP_consultationBrgyCount',
                'DL_medicinesBrgy',
                'DP_medicinesBrgyCount',
                'DL_medCategory',
                'DP_medCategoryCount',
                'DL_criticalMedicineBrandName',
                'DP_criticalMedicineBrandNameStock',
                'DL_expiMedicineBrandName',
                'DP_expiMedicineBrandNameStock',
                'patientMaleCount',
                'patientFemaleCount',
                'DL_treatmentBrgy',
                'DP_treatmentBrgyCount',
                'DL_patientBrgy',
                'DP_patientBrgyCount',
                'DL_constultationBrgy',
                'DP_constultationBrgyCount',
                'DL_medicineBrgy',
                'DP_medicineBrandNameBrgyCount',
                'DP_medicineBrgyCount',
                'past_months',
                'currentMonth',
                'toexpiredMedicines',
                'DL_toexpiMedicineBrandName',
                'DP_toexpiMedicineBrandNameStock',
                'DL_medicineBrand_name',
                'DP_medicineTotal_quantity',
                'DP_brgy',
                'brgys',
                'currentBrgy'
            )
        );
    }
}