<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $memberships = [
            [
                'title' => 'Player Membership',
                'fee' => 1000,
                'duration' => 12,
                'benefits' => 'Access to training and tournaments'
            ],
            [
                'title' => 'Fan Membership',
                'fee' => 500,
                'duration' => 12,
                'benefits' => 'Access to club events and updates'
            ]
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }
    }
}
