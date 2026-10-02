<?php

namespace App\Repositories;

use App\Models\Club;

class ClubRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function show($data){
        return Club::first();
    }
}
