<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
