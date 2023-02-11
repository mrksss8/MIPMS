<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['date','age','weight','height','BP','PR','RR','CC','patient_id','other_info','treatment_id'];


    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function treatment()
    {
        return $this->hasOne(Treatment::class, 'id', 'treatment_id');
    }
}
