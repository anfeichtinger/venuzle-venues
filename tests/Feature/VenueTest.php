<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Venue;

class VenueTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_add_venue()
    {
        $venue = Venue::factory()->make()->toArray();
        $response = $this->postJson('api/venues/add', $venue);
        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => $venue['name'],
                'open_at' => $venue['open_at'],
                'close_at' => $venue['close_at']
            ]);
    }
}
