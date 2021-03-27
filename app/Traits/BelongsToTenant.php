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

		// When creating model, add tenant id from session

		static::creating(function ($model) {
			$model->tenant_id = session('tenant_id');
		});
	}
}
