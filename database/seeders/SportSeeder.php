<?php
namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sports = [
            [
                'name'        => 'Football',
                'description' => 'Football team activities and tournaments',
                'status'      => 1,
            ],
            [
                'name'        => 'Cricket',
                'description' => 'Cricket matches and practice sessions',
                'status'      => 1,
            ],
            [
                'name'        => 'Volleyball',
                'description' => 'Volleyball training and competitions',
                'status'      => 0,
            ],
            [
                'name'        => 'Badminton',
                'description' => 'Badminton games and tournaments',
                'status'      => 0,
            ],
        ];

        foreach ($sports as $sport) {
            Sport::create($sport);
        }
    }
}
