<?php
namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Football Training Session',
                'description' => 'Weekly evening training for senior team',
                'event_type_id' => 3, // Training
                'sport_id' => 1, // Football
                'event_date' => '2026-05-10',
                'event_time' => '18:00:00',
                'location' => 'Club Ground',
                'status' => 'upcoming'
            ],
            [
                'title' => 'District Football Tournament',
                'description' => 'Inter-district football competition',
                'event_type_id' => 2, // Tournament
                'sport_id' => 1,
                'event_date' => '2026-06-01',
                'event_time' => '10:00:00',
                'location' => 'District Stadium',
                'status' => 'upcoming'
            ],
            [
                'title' => 'Cricket Practice',
                'description' => 'Morning practice for cricket team',
                'event_type_id' => 3,
                'sport_id' => 2, // Cricket
                'event_date' => '2026-05-15',
                'event_time' => '07:00:00',
                'location' => 'Cricket Ground',
                'status' => 'upcoming'
            ],
            [
                'title' => 'Volleyball Friendly Match',
                'description' => 'Friendly match with local club',
                'event_type_id' => 1, // Match
                'sport_id' => 3, // Volleyball
                'event_date' => '2026-05-20',
                'event_time' => '16:00:00',
                'location' => 'Community Hall',
                'status' => 'upcoming'
            ],
            [
                'title' => 'Badminton Tournament',
                'description' => 'Internal badminton tournament',
                'event_type_id' => 2,
                'sport_id' => 4, // Badminton
                'event_date' => '2026-05-25',
                'event_time' => '09:00:00',
                'location' => 'Indoor Stadium',
                'status' => 'upcoming'
            ],
            [
                'title' => 'Club Annual Meeting',
                'description' => 'Annual general body meeting',
                'event_type_id' => 4, // Meeting
                'sport_id' => 1, // can be any (or keep generic)
                'event_date' => '2026-07-01',
                'event_time' => '11:00:00',
                'location' => 'Club Office',
                'status' => 'upcoming'
            ]
        ];

        foreach($events as $event){
            Event::create($event);
        }
    }
}
