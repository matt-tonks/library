<?php

namespace Tests\Unit;

use App\Models\Tenant;
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
}
