<?php

namespace App\Services;

use App\Repositories\ClubRepository;

class ClubService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }
       
       
    public static function show($data){
        return ClubRepository::show($data);
        
    }
}
