<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Club::create([
            'name'         => 'St. George Sports Club',
            'register_no'  => '87/2022',
            'logo'         => 'clubs/logo.png',
            'description'  => 'Community sports club promoting sports and teamwork.',
            'mission'      => 'Encourage youth participation in sports.',
            'vision'       => 'Build a strong sports culture in the community.',
            'founded_year' => 2022,
            'address'      => 'Kirathoor,Kanyakumari',
            'phone'        => '9003352825',
            'email'        => 'stgeorgescktr8722@gmail.com',
        ]);
    }
}
