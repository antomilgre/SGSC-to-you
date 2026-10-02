<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialRole extends Model
{
        protected $fillable = [
        'role_name',
        'priority'
    ];

    public function officials()
    {
        return $this->hasMany(OfficialMember::class,'role_id');
    }
}
