<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */

class AttentionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        "doctor_id",
        "days",
        "start",
        "end",
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
