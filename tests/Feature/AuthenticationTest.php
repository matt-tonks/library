<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_screen_can_be_rendered()
	{
		$response = $this->get('/login');

		$response->assertStatus(200);
	}

	public function test_users_can_authenticate_using_the_login_screen()
	{
		$user = User::factory()->create();

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'password',
		]);

		$this->assertAuthenticated();
		$response->assertRedirect(RouteServiceProvider::HOME);
	}

	public function test_users_can_not_authenticate_with_invalid_password()
	{
		$user = User::factory()->create();

		$this->post('/login', [
			'email' => $user->email,
			'password' => 'wrong-password',
		]);

		$this->assertGuest();
	}

	public function test_users_tenant_id_is_set_in_session_when_logging_in()
	{
		$tenant = Tenant::factory()->create();
		$user = User::factory()->create(['tenant_id' => $tenant->id]);

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'password',
		]);

		$this->assertAuthenticated();
		$response->assertRedirect(RouteServiceProvider::HOME);
		$this->assertTrue(session('tenant_id') === $tenant->id);
	}
}
