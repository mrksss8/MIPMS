<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangay;

class BarangayController extends Controller
{
    public function index()
    {

        $brgys = Barangay::all();
        return view('brgy.index', compact('brgys'));
    }

    public function store(request $request)
    {

        Barangay::create($request->all());

        return redirect()->route('brgy.index')->withSuccess('Barangay added successfully.');
    }
}