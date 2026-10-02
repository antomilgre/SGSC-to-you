<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
        protected $fillable = [
        'user_id', 'type_id', 'reference_id', 'registered_at', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'reference_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'reference_id');
    }
}
