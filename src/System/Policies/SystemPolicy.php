<?php

namespace Myrtle\Core\System\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	public function admin(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key)
		{
			return $ability->name === 'system.admin';
		});
	}

	public function accessAdmin(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) {
			return $ability->name === 'system.access.admin';
		});
	}

	public function information(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user)
		{
			return $ability->name === 'system.information.view' || $this->admin($user);
		});
	}

	public function any(User $user)
	{
		return $this->permissions($user) || $this->admin($user);
	}
}
