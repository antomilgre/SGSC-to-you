<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'sport_id',
        'name',
        'category',
        'coach_name',
        'description'
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class,'event_team');
    }
}
