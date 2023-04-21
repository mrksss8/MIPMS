<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangay;

class BarangayController extends Controller
{
    public function index()
    {

        $brgys = Barangay::paginate(5);
        return view('brgy.index', compact('brgys'));
    }

    public function store(request $request)
    {

        $request->validate(['barangay' => 'required|unique:barangays',], ['barangay.required' => 'The barangay field is required.', 'barangay.unique' => 'The barangay already exists.',]);


        Barangay::create($request->all());

        return redirect()->route('brgy.index')->withSuccess('Barangay added successfully.');
    }
}