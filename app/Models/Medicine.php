<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['brand_name','stocks','dosage_id','category_id','med_id','expi_date'];


    public function dosage()
    {
        return $this->hasOne(MedicineDosage::class, 'id', 'dosage_id');
    }

     public function category()
    {
        return $this->hasOne(MedicineCategory::class, 'id', 'category_id');
    }

}
