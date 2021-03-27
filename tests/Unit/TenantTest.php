<?php

namespace Tests\Unit;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TenantTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function it_can_be_created()
	{
		$tenant = new Tenant([
			'name' => 'TenantTest',
		]);

		$tenant->save();

		$this->assertDatabaseHas('tenants', [
			'name' => 'TenantTest',
		]);
		$this->assertCount(1, Tenant::all());
	}

	/** @test */
	public function a_user_belongs_to_a_tenant()
	{
		$tenant = Tenant::factory()->create(['name' => 'TenantTest']);
		$user = User::factory()->create(['tenant_id' => $tenant->id]);

		$this->assertTrue($user->tenant->id === $tenant->id);
	}
}
