<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        "account_id",
        "date",
        "value",
    ];

    protected $casts = [
        'date' => 'dateTime:d/m/Y H:i'
    ];
}
