<?php
namespace App\Services;

use App\Repositories\AdminRepository;

class AdminService
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
        $user = AdminRepository::acceptRegistrationRequest($id);
        return $user;
    }
}
