<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'description',
    ];

    protected $casts = [
        "permissions" => "json"
    ];
}
