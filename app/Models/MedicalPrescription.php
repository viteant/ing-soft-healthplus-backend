<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class MedicalPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        "medical_history_id",
        "medicine",
        "instructions",
        "observations",
    ];

    public function medicalHistory()
    {
        return $this->belongsTo(MedicalHistory::class);
    }
}
