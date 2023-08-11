<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		$user_list = User::join('roles', 'users.roles_id', '=', 'roles.id')
			->where('users.id', '!=', Auth::user()->id)
			->where('users.roles_id', '!=', 7)
			->orderBy('users.roles_id')
			->get(['users.*', 'roles.role']);

		return view('pages.auth.list-user', compact('user_list'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$roles = Roles::whereNotIn('id', [4, 7])
			->get();

		return view('pages.auth.add-user')->with('roles', $roles);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
			'roles' => ['required', 'integer', 'not_in:0'],
		]);

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'roles_id' => $request->roles,
		]);

		return redirect('user');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(User $user): void
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user): View
	{
		$roles = Roles::whereNotIn('id', [4, 7])
			->get();

		return view('pages.auth.edit-user', compact('user'))->with('roles', $roles);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, User $user): RedirectResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
			'roles' => ['required', 'integer'],
		]);

		DB::table('hibah')
			->where('edited_name', $user->name)
			->update(['edited_name' => $request->name]);

		$user->update([
			'name' => $request->name,
			'email' => $request->email,
			'roles_id' => $request->roles,
		]);

		return redirect('user');
	}

	public function password(Request $request, User $user): RedirectResponse
	{
		$request->validate([
			'current_password' => ['required', new MatchOldPassword($user->password)],
			'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user->update([
			'password' => Hash::make($request->new_password),
		]);

		return redirect('user');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user): RedirectResponse
	{
		$user->delete();

		return redirect('user');
	}
}
