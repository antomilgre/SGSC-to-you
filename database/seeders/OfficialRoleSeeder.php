<?php
namespace Database\Seeders;

use App\Models\OfficialRole;
use Illuminate\Database\Seeder;

class OfficialRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'President', 'priority' => 1],
            ['role_name' => 'Vice President', 'priority' => 2],
            ['role_name' => 'Secretary', 'priority' => 3],
            ['role_name' => 'Deputy Secretary', 'priority' => 4],
            ['role_name' => 'Treasurer', 'priority' => 5],
            ['role_name' => 'Executive Member', 'priority' => 6],
        ];

        foreach ($roles as $role) {
            OfficialRole::create($role);
        }
    }
}
