<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //
    protected $fillable = [
        'title',
        'fee',
        'duration',
        'benefits',
        'status',
    ];

    public function applications()
    {
        return $this->hasMany(MembershipApplication::class);
    }
}
