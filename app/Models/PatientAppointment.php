<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class PatientAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        "attention_schedule_id",
        "patient_id",
        "attended",
        "annulled",
    ];

    public function attentionSchedule()
    {
        return $this->belongsTo(AttentionSchedule::class);
    }
}
