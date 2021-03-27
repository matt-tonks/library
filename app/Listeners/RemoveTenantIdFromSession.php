<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Session;

class RemoveTenantIdFromSession
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
		Session::forget('tenant_id');
	}
}
