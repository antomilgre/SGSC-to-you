<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClubFlowApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_activity_registration_financial_and_event_team_flows_work(): void
    {
        $user = User::factory()->create();

        $type = $this->postJson('/api/types', ['name' => 'activity'])->assertCreated()->json('data');
        $activity = $this->postJson('/api/activities', [
            'title' => 'Fitness Camp', 'type_id' => $type['id'], 'date' => '2026-10-10',
        ])->assertCreated()->json('data');

        $this->postJson('/api/registrations', [
            'user_id' => $user->id, 'type_id' => $type['id'], 'reference_id' => $activity['id'],
            'registered_at' => '2026-10-01 10:00:00',
        ])->assertCreated();

        $this->postJson('/api/financial-transactions', [
            'user_id' => $user->id, 'type' => 'activity', 'reference_id' => $activity['id'],
            'registered_at' => '2026-10-01 10:00:00',
        ])->assertCreated();

        $sport = $this->postJson('/api/sports', ['name' => 'Football'])->assertCreated()->json('data');
        $team = $this->postJson('/api/teams', ['sport_id' => $sport['id'], 'name' => 'Senior Team'])->assertCreated()->json('data');
        $eventType = $this->postJson('/api/event-type', ['name' => 'Tournament'])->assertOk()->json('data');
        $event = $this->postJson('/api/events', [
            'title' => 'Club Cup', 'event_type_id' => $eventType['id'], 'sport_id' => $sport['id'],
            'event_date' => '2026-11-01', 'team_ids' => [$team['id']],
        ])->assertOk()->json('data');

        $this->getJson('/api/events/' . $event['id'])
            ->assertOk()
            ->assertJsonPath('data.teams.0.id', $team['id']);
    }
}
