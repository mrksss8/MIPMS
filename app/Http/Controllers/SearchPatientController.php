<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;

class SearchPatientController extends Controller
{
    public function index()
    {


        return view('search_patient.index');
    }

    public function search(Request $request)
    {

        $patient = Patient::where('family_id', $request->family_id)
            ->with('infaChildInfo', 'pregWomen', 'philHealthInfo', 'address', 'consultation.treatment')
            ->first();


        if ($patient == null) {
            return view('search_patient.not-found');
        } else {

            $randomNumber = sprintf("%04d", rand(0, 9999));
            $patientFamilyID = $request->family_id;
            $patientFamilyIDString = strval($patientFamilyID);


            // return view('search_patient.verify', compact('randomNumber', 'patientFamilyIDString'));

            $basic = new \Vonage\Client\Credentials\Basic("bed04d30", "auFUxV8wbo2XeST1");
            $client = new \Vonage\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("639159281108", 'PMIS-Bay', "Your Verification code is " . $randomNumber . " ")
            );

            $message = $response->current();

            if ($message->getStatus() == 0) {
                echo "The message sent successfully";
                $errorMessage = null;
                return view('search_patient.verify', compact('randomNumber', 'patientFamilyIDString', 'errorMessage'));
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
        }

        // return view('search_patient.show', compact('patient'));
    }

    public function verify(Request $request)
    {
        $patient = Patient::where('family_id', $request->family_id)
            ->with('infaChildInfo', 'pregWomen', 'philHealthInfo', 'address', 'consultation.treatment')
            ->first();

        if ($request->veri_code_true == $request->veri_code) {
            return view('search_patient.show', compact('patient'));
        } else {
            $randomNumber = $request->veri_code_true;
            $patientFamilyIDString = $request->family_id;
            $errorMessage = "Oops! Something went wrong. Pls. Enter valid cerification code";
            return view('search_patient.verify', compact('randomNumber', 'patientFamilyIDString', 'errorMessage'));
            // return redirect()->back()->withError('Oops! Something went wrong. Pls. Enter valid cerification code');
        }
    }

}