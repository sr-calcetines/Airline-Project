<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['web', 'role:admin'])->get('/admin-test', fn () => 'admin ok');
        Route::middleware(['web', 'role:user'])->get('/user-test', fn () => 'user ok');
    }

    public function test_if_admin_can_access_admin_route()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($admin)
             ->get('/admin-test')
             ->assertOk()
             ->assertSee('admin ok');
    }

    public function test_if_normal_user_cannot_access_admin_route()
    {
        $user = User::factory()->create(['isAdmin' => false]);

        $this->actingAs($user)
             ->get('/admin-test')
             ->assertRedirect('/')
             ->assertSessionHas('error', 'No tienes permiso para acceder a esta página.');
    }

    public function test_if_user_can_access_user_route()
    {
        $user = User::factory()->create(['isAdmin' => false]);

        $this->actingAs($user)
             ->get('/user-test')
             ->assertOk()
             ->assertSee('user ok');
    }

    public function test_if_admin_cannot_access_user_route()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($admin)
             ->get('/user-test')
             ->assertRedirect('/login')
             ->assertSessionHas('error', 'Debes iniciar sesión.');
    }

    public function test_if_guest_cannot_access_admin_or_user_routes()
    {
        $this->get('/admin-test')
             ->assertRedirect('/')
             ->assertSessionHas('error', 'No tienes permiso para acceder a esta página.');

        $this->get('/user-test')
             ->assertRedirect('/login')
             ->assertSessionHas('error', 'Debes iniciar sesión.');
    }
}
