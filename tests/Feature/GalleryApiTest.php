<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_can_be_created_and_retrieved_with_its_images_relation(): void
    {
        $created = $this->postJson('/api/galleries', [
            'title' => 'Annual Sports Day 2026',
            'type' => 'photo',
        ]);

        $created->assertCreated()
            ->assertJsonPath('status', true)
            ->assertJsonPath('data.title', 'Annual Sports Day 2026');

        $this->getJson('/api/galleries')
            ->assertOk()
            ->assertJsonPath('status', true)
            ->assertJsonPath('data.data.0.images', []);
    }
}
