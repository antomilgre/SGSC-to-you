<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    //
    protected $fillable = [
        'membership_id',
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
