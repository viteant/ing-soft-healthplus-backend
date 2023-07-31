<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        "medical_history_id",
        "type",
        "description",
        "status",
        "results",
    ];

    public function medicalHistory()
    {
        return $this->belongsTo(MedicalHistory::class);
    }
}
