<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaneModelTest extends TestCase
{
    use RefreshDatabase;
    public function test_if_can_create_a_plane()
    {
        $plane = Plane::create([
            'name' => 'Boeing 747',
            'max_capacity' => 300
        ]);

        $this->assertDatabaseHas('planes', [
            'name' => 'Boeing 747',
            'max_capacity' => 300
        ]);
    }

    public function test_if_has_many_flights()
    {
        $plane = Plane::factory()->create();
        $flights = Flight::factory()->count(3)->create(['plane_id' => $plane->id]);

        $this->assertCount(3, $plane->flights);
        $this->assertTrue($plane->flights->first() instanceof Flight);
    }
}
