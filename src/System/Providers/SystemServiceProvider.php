<?php

namespace Myrtle\Core\System\Providers;

use Pseudo\Auth\Guest;
use Myrtle\System\Http\Controllers\Administrator\SystemInformationController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bootGateInterceptions();
	}

	protected function bootGateInterceptions()
	{
		Gate::before(function ($user, $ability)
		{
			// Login and Logout don't check for an Ability
			// It simply just checks for Authentication
			// We should return early in those cases
			if (($ability == 'login' || $ability == 'logout'))
			{
				return;
			}

			if ( ! $user instanceof Guest)
			{
				$bypass = $user->roles->contains(function ($role, $key)
				{
					return $role->id === 1;
				});

				if ($bypass)
				{
					return $bypass;
				}
			}
		});
	}
}
