<?php
namespace App\Repositories;

use App\Models\User;
use Log;

class AdminRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function acceptRegistrationRequest($id)
    {
        $user         = User::where('id', $id)->first();
       Log::debug($user);
       Log::debug($id);
        $user->status = 1;
        $user->save();
        return $user;
    }
}
