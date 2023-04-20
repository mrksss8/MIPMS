<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\Treatment;
use Carbon\Carbon;

use Spatie\Permission\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get();

        $roleNamesAndUserCounts = array();

        // Get all roles
        $roles = Role::all();
        foreach ($roles as $role) {
            // Get the number of users that belong to this role
            $userCount = $role->users()->count();

            // Add the role name and user count to the array
            $roleNamesAndUserCounts[] = array(
                'roleName' => $role->name,
                'userCount' => $userCount
            );
        }


        $patient_count = Patient::all()->count();

        $forTreatment_count = Consultation::doesntHave('treatment')->count();

        $criticalMedicine_count = Medicine::groupBy('med_id')
            ->havingRaw('sum(stocks) > 0')
            ->havingRaw('sum(stocks) < 10')
            ->count();

        $treatmentedPatientToday_count = Treatment::whereDate('created_at', Carbon::today())->count();

        //patientSexCount
        $patientMaleCount = Patient::where('sex', 'male')->count();
        $patientFemaleCount = Patient::where('sex', 'female')->count();

        //patientAgeCount
        $newborns_Cnt = 0;
        $infants_Cnt = 0;
        $children_Cnt = 0;
        $adolescents_Cnt = 0;
        $adults_Cnt = 0;
        $senior_Cnt = 0;

        $newborns_Cnt = 0;
        $infants_Cnt = 0;
        $children_Cnt = 0;
        $adolescents_Cnt = 0;
        $adults_Cnt = 0;
        $senior_Cnt = 0;

        $patients = Patient::all();
        foreach ($patients as $patient) {
            $ageInMonths = Carbon::parse($patient->birth_date)->diffInMonths(Carbon::now());

            if (Carbon::parse($patient->birth_date)->diffInDays(Carbon::now()) <= 30) {
                $newborns_Cnt++;
            } elseif ($ageInMonths > 0 && $ageInMonths <= 12) {
                $infants_Cnt++;
            } elseif ($ageInMonths > 12 && $ageInMonths <= 144) {
                $children_Cnt++;
            } elseif ($ageInMonths > 144 && $ageInMonths <= 204) {
                $adolescents_Cnt++;
            } elseif ($ageInMonths > 204 && $ageInMonths < 720) {
                $adults_Cnt++;
            } elseif ($ageInMonths >= 720) {
                $senior_Cnt++;
            }
        }


        return view('home', compact('roleNamesAndUserCounts', 'patient_count', 'forTreatment_count', 'criticalMedicine_count', 'treatmentedPatientToday_count', 'patientMaleCount', 'patientFemaleCount', 'newborns_Cnt', 'infants_Cnt', 'adolescents_Cnt', 'children_Cnt', 'adults_Cnt', 'senior_Cnt', 'users'));
    }
}