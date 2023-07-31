<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "patient_appointment_id",
        "patient_id",
        "date",
        "value",
        "fees",
        "discounts",
    ];

    public function patienAppointment()
    {
        return $this->belongsTo(PatientAppointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
