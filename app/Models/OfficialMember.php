<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialMember extends Model
{
    protected $fillable = [
        'role_id',
        'name',
        'photo',
        'phone',
        'email',
        'description',
        'year_start',
        'year_end',
        'status',
    ];

    public function role()
    {
        return $this->belongsTo(OfficialRole::class, 'role_id');
    }
}
