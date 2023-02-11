<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfaChildInfo extends Model
{
    use HasFactory;

    protected $fillable = ['father_name','mother_name','place_delivery','type_of_delivery','attended_by','birth_weight','birth_height','date_of_NBS','mother_TT_status','immun_at_other_facility'];
}
