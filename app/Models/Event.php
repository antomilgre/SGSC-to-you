<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'event_type_id',
        'sport_id',
        'event_date',
        'event_time',
        'location',
        'status',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'event_team');
    }
}
