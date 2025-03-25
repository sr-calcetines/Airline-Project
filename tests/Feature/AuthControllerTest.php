<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_registers_successfully(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount("users", 1);
    }

    public function test_if_user_register_fails_due_to_missing_confirmation(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678"
        ]);

        $response->assertStatus(302)->assertRedirect("/");
        $this->assertDatabaseCount("users", 0);
    }

    public function test_if_api_user_registers_successfully(): void
    {
        $response = $this->post("/api/auth/register", [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ]);

        $response->assertStatus(201)->assertJsonFragment([
            "name" => "test",
            "email" => "example@example.com"
        ]);
        $this->assertDatabaseCount("users", 1);
    }

    public function test_if_api_user_register_fails_due_to_invalid_data(): void
    {
        $response = $this->post("/api/auth/register", [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
        ]);

        $response->assertStatus(400);
        $this->assertDatabaseCount("users", 0);
    }

    public function test_if_user_can_login_successfully(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post(route("login"), [
            "email" => $user->email,
            "password" => "12345678"
        ]);

        $response->assertStatus(302)->assertRedirect("/");
    }

    public function test_if_user_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post(route("login"), [
            "email" => $user->email,
            "password" => "12345677"
        ]);

        $response->assertStatus(302)->assertRedirect("/");
    }

    public function test_if_api_user_can_login_successfully(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post("/api/auth/login", [
            "email" => "example@example.com",
            "password" => "12345678",
        ]);
        $response->assertStatus(200)->assertJsonStructure(["access_token", "token_type", "expires_in"]);
    }

    public function test_if_api_user_login_fails_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post("/api/auth/login", [
            "email" => "example@example.com",
            "password" => "1234567",
        ]);
        $response->assertStatus(401)->assertJsonFragment(["error" => "Unauthorized"]);
    }

    public function test_if_api_returns_current_authenticated_user(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("me"));

        $response->assertStatus(200)->assertJsonFragment([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        ]);
    }

    public function test_if_api_can_refresh_token(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("refresh"));

        $response->assertStatus(200)->assertJsonStructure(["access_token", "token_type", "expires_in"]);
    }

    public function test_if_web_user_can_logout_successfully(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("logout"));

        $response->assertStatus(302);
        $this->assertFalse(auth()->check());
    }

    public function test_if_api_user_can_logout_successfully(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post("/api/auth/logout");

        $response->assertStatus(200)->assertJsonFragment(["message" => "Successfully logged out"]);
    }
    
}