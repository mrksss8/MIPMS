<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentMedicine extends Model
{
    use HasFactory;

    protected $fillable = ['treatment_id','medicine_id','quantity','description'];

    public function medicine()
    {
        return $this->hasMany(Medicine::class, 'id','medicine_id');
    }
}
