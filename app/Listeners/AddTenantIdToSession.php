<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Session;

class AddTenantIdToSession
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  object  $event
	 * @return void
	 */
	public function handle($event)
	{
		if ($event->user->tenant_id) {
			Session::put('tenant_id', $event->user->tenant_id);
		}
	}
}
