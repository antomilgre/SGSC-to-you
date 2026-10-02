<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
        protected $fillable = [
        'name',
        'register_no',
        'logo',
        'description',
        'mission',
        'vision',
        'founded_year',
        'address',
        'phone',
        'email'
    ];
}
