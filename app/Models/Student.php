<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'father',
        'mother',
        'dob',
        'member_id',
        'aadhaar',
        'class',
        'address',
        'mobile',
    ];
}
