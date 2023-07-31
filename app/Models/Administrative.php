<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */

class Administrative extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "department",
        "position",
        "salary",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
