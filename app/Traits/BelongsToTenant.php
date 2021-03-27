<?php

namespace App\Traits;

use App\Scopes\TenantScope;

trait BelongsToTenant
{
	protected static function booted()
	{
		parent::booted();

		// Apply the tenant scope
		static::addGlobalScope(new TenantScope());
	}
}
