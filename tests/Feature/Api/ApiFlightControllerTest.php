<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiFlightControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_index_returns_all_flights()
    {
        $plane = Plane::factory()->create();
        Flight::factory()->count(3)->create(['plane_id' => $plane->id]);

        $response = $this->getJson(route('apiflightall'));

        $response->assertOk()
            ->assertJsonCount(3);
    }

    public function test_if_show_returns_a_flight()
    {
        $plane = Plane::factory()->create();
        $flight = Flight::factory()->create(['plane_id' => $plane->id]);

        $response = $this->getJson(route('apiflightshow', $flight->id));

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $flight->id,
                'departure' => $flight->departure,
            ]);
    }

    public function test_if_admin_can_store_a_flight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $plane = Plane::factory()->create();

        $data = [
            'date' => now()->addDays(3),
            'departure' => 'Sevilla',
            'arrival' => 'Valencia',
            'plane_id' => $plane->id,
            'reserved' => 0,
            'aviable' => 1,
        ];

        $response = $this->actingAs($admin, 'api')
            ->postJson(route('apiflightstore'), $data);

        $response->assertOk()
            ->assertJsonFragment(['departure' => 'Sevilla']);

        $this->assertDatabaseHas('flights', ['arrival' => 'Valencia']);
    }

    public function test_if_admin_can_update_a_flight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $plane = Plane::factory()->create();
        $flight = Flight::factory()->create(['plane_id' => $plane->id]);

        $data = [
            'date' => now()->addDays(5),
            'departure' => 'Bilbao',
            'arrival' => 'Roma',
            'plane_id' => $plane->id,
            'reserved' => 5,
            'aviable' => 1,
        ];

        $response = $this->actingAs($admin, 'api')
            ->putJson(route('apiflightupdate', $flight->id), $data);

        $response->assertOk()
            ->assertJsonFragment(['arrival' => 'Roma']);

        $this->assertDatabaseHas('flights', ['departure' => 'Bilbao']);
    }

    public function test_if_admin_can_delete_a_flight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $plane = Plane::factory()->create();
        $flight = Flight::factory()->create(['plane_id' => $plane->id]);

        $response = $this->actingAs($admin, 'api')
            ->deleteJson(route('apiflightdestroy', $flight->id));

        $response->assertOk();

        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }

    public function test_if_non_admin_cannot_store_flight()
    {
        $user = User::factory()->create(['isAdmin' => false]);
        $plane = Plane::factory()->create();

        $data = [
            'date' => now()->addDays(3),
            'departure' => 'Zaragoza',
            'arrival' => 'Granada',
            'plane_id' => $plane->id,
            'reserved' => 0,
            'aviable' => 1,
        ];

        $response = $this->actingAs($user, 'api')
            ->postJson(route('apiflightstore'), $data);

        $response->assertRedirect('/');
    }
}
