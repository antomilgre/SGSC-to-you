<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $fillable = [
        'team_id',
        'name',
        'jersey_number',
        'position',
        'age',
        'photo',
        'bio',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
