<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Treatment;
use App\Models\TreatmentMedicine;
use App\Models\Medicine;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        //  $datas = DB::table('medicines')->get('*')->toArray();

        //     foreach($datas as $data){

        //         $dataPoints[] = array(
        //             'label'=> $data->brand_name,
        //             'y'=>$data->stocks,
        //         );
        //     }

        // 

        //global variable to get last 7 days 
        $date = Carbon::today()->subDays(7);
        $treatments = Treatment::where('created_at', '>=', $date)->get()->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('Y-m-d');
        });

        foreach ($treatments as $treatment => $record) {
            //  echo $treatment;

            $count = count($record);
            //  echo $count;

            //     $data[] = array(
            //     'date' => $treatment,
            //     'count' => $count,
            //    );

            $dataLabels[] = $treatment;
            $dataPoints[] = $count;
        }

        // $treatment_medicines = TreatmentMedicine::where('created_at', '>=', $date)
        //     ->groupBy('category')
        //     ->selectRaw('category, sum(quantity) as total_quantity')
        //     ->get();

        $treatment_medicines = TreatmentMedicine::where('created_at', '>=', $date)->get()->groupBy(function ($q) {
            return Carbon::parse($q->created_at)->format('Y-m-d');
        });

        foreach ($treatment_medicines as $treatment_medicine => $records) {
            $med_count = 0;
            foreach ($records as $key => $record) {
                $med_count = $med_count + $record->quantity;

            }
            $dataPoints_treat_med[] = $med_count;
            $dataLabels_treat_med[] = $treatment_medicine;
        }

        // $med = DB::table('treatment_medicines')
        //      ->select('quantity')
        //      ->groupBy('medicine_id')
        //      ->get();

        // $med = TreatmentMedicine::with('medicine')->groupBy('medicine_id')->count();

        // $med  = DB::table('treatment_medicines')
        //      ->select('quantity', DB::raw('count(*) as total'))
        //      ->groupBy('medicine_id')
        //      ->get();

        $med_count_by_categories = TreatmentMedicine::groupBy('category')->where('created_at', '>=', Carbon::today())
            ->selectRaw('category, sum(quantity) as sum')
            ->get();

        foreach ($med_count_by_categories as $med_count_by_category) {
            $dataPoints_med_count_by_category[] = $med_count_by_category->sum;
            $dataLabels_med_count_by_category[] = $med_count_by_category->category;

        }
        return view('analytics.index', compact('dataLabels', 'dataPoints', 'dataPoints_treat_med', 'dataLabels_treat_med', 'dataPoints_med_count_by_category', 'dataLabels_med_count_by_category'));
    }
}