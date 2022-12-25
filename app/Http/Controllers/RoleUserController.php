<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
	protected $role, $user;

	public function __construct(Role $role, User $user)
	{
		$this->role = $role;
		$this->user = $user;
		$this->middleware(['can:roles', 'can:users']);
	}

	public function roles($idUser)
	{
		$user = $this->user->find($idUser);
		if (!$user) {
			return redirect()->back();
		}
		$roles = $user->roles()->paginate();
		return view('admin.pages.users.roles.index', compact('user', 'roles'));
	}

	public function rolesAvailable(Request $request, $idUser)
	{
		$user = $this->user->find($idUser);
		if (!$user) {
			return redirect()->back();
		}
		$filters = $request->except('_token');
		$roles = $user->rolesAvailable($request->filter);
		return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
	}

	public function attachRolesUser(Request $request, $idUser)
	{
		$user = $this->user->find($idUser);
		if (!$user) {
			return redirect()->back();
		}
		if (!$request->roles || count($request->roles) == 0) {
			return redirect()
				->back()
				->with('info', 'Precisa escolher pelo menos uma permissão');
		}
		$user->roles()->attach($request->roles);
		return redirect()->route('users.roles', $user->id);
	}

	public function detachRolesUser($idUser, $idRole)
	{
		$user = $this->user->find($idUser);
		$role = $this->role->find($idRole);
		if (!$user || !$role) {
			return redirect()->back();
		}
		$user->roles()->detach($role);
		return redirect()->route('users.roles', $user->id);
	}


}
