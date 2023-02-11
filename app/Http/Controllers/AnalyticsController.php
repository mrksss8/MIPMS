<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(){
        
         $datas = DB::table('medicines')->get('*')->toArray();

            foreach($datas as $data){
                
                $dataPoints[] = array(
                    'label'=> $data->brand_name,
                    'y'=>$data->stocks,
                );
            }

        return view('analytics.index',compact('dataPoints'));
    }
}
