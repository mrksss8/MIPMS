<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['findings', 'next_consultation', 'consultation_id'];

    public function medicine()
    {
        return $this->belongsToMany(Medicine::class, 'treatment_medicines')->withPivot('quantity','description');
    }
    
}
