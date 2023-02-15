<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'first_name', 'middle_name', 'birth_date', 'sex', 'civil_status','contact_num','address_id' ];


    //Relationship
    public function infaChildInfo()
    {
        return $this->hasOne(InfaChildInfo::class,'id','infa_child_info_id');
    }

    public function pregWomen()
    {
        return $this->hasOne(PregWomen::class,'id', 'preg_women_info_id');
    }

    public function philHealthInfo()
    {
        return $this->hasOne(PhilHealthInfo::class,'id', 'phil_health_info_id',);
    }

    public function address()
    {
        return $this->hasOne(Address::class,'id', 'address_id',);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id','patient_id');
    }


}
