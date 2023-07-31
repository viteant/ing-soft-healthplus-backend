<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class MedicalCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_patient",
        "id_doctor",
        "date",
        "description",
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
