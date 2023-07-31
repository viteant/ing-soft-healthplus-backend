<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * @mixin Builder
 */

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        "parent_id",
        "code",
        "plan_description",
    ];

    public function parent()
    {
        return $this->belongsTo(Account::class, 'id', 'parent_id');
    }
}
