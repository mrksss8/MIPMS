<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineStockController extends Controller
{
    public function create($id){
        $medicine = Medicine::find($id);

        return view('add-stock.create',compact('medicine'));
    }

    public function store(Request $request){

            Medicine::create($request->all());

        return redirect()->route('medicine.index')->withSuccess('Stock added successfuly!');
    }
}
