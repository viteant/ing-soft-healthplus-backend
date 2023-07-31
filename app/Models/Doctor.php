<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "specialism",
        "degree",
        "service_price",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
