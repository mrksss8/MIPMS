<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class SearchPatientController extends Controller
{
    public function index()
    {


        return view('search_patient.index');
    }

    public function search(Request $request)
    {

        $patient = Patient::where('family_id', $request->family_id)
            ->with('infaChildInfo', 'pregWomen', 'philHealthInfo', 'address')
            ->first();

        if ($patient == null) {
            return view('search_patient.not-found');
        }

        return view('search_patient.show', compact('patient'));
    }

}