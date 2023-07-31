<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
* @mixin Builder
*/

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "address",
        "phone",
        "dni",
        "billing_name",
        "billing_address",
        "billing_phone",
        "billing_document",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
