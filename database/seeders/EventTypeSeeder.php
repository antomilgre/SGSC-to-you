<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Match'],
            ['name' => 'Tournament'],
            ['name' => 'Training'],
            ['name' => 'Meeting'],
            ['name' => 'Club Event'],
        ];

        foreach ($types as $type) {
            EventType::create($type);
        }
    }
}
