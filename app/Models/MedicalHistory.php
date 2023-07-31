<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_patient",
        "id_doctor",
        "date",
        "reason",
        "diagnosis",
        "treatment",
        "observations",
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
