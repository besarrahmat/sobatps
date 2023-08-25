<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\User;
use App\Rules\ExtraKUPSExists;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KUPSExtraController extends Controller
{
	/**
	 * Show the form for choosing some resource.
	 */
	public function list_kups_pendamping(): View
	{
		$kups_list = LembagaKUPS::join('ps', 'kups.ps_id', '=', 'ps.id')
			->leftJoin('kups_pendamping', 'kups_pendamping.kups_id', '=', 'kups.id')
			->orderBy('kups.id')
			->distinct()
			->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);

		$pendamping = User::join('roles', 'users.roles_id', '=', 'roles.id')
			->leftJoin('kups_pendamping', 'kups_pendamping.user_id', '=', 'users.id')
			->where('roles.role', '=', 'Pendamping')
			->orderBy('users.id')
			->distinct()
			->get(['users.id', 'users.name']);

		$kups_pendamping = $pendamping;
		$index = 0;

		foreach ($pendamping as $user) {
			$kups = LembagaKUPS::join('kups_pendamping', 'kups_pendamping.kups_id', '=', 'kups.id')
				->join('ps', 'kups.ps_id', '=', 'ps.id')
				->where('kups_pendamping.user_id', $user->id)
				->orderBy('kups.id')
				->get(['kups_pendamping.id', 'kups.kups_name', 'ps.ps_name']);

			$kups_pendamping[$index]->kups = $kups;
			$index++;
		}

		$data = array(
			'kups' => $kups_list,
			'pendamping' => $pendamping,
			'list' => $kups_pendamping,
		);

		return view('pages.lembaga.kelola-pendamping-kups')->with($data);
	}

	/**
	 * Store a choosed resource in storage.
	 */
	public function add_kups_pendamping(Request $request): RedirectResponse
	{
		$request->validate([
			'lembaga_kups' => ['required', 'integer', 'not_in:0'],
			'pendamping' => ['required', 'integer', 'not_in:0', new ExtraKUPSExists()],
		]);

		DB::table('kups_pendamping')
			->insert([
				'user_id' => $request->pendamping,
				'kups_id' => $request->lembaga_kups,
			]);

		return redirect('lembaga-kups/' . Auth::user()->id . '/pendampingan');
	}

	/**
	 * Delete a choosed resource in storage.
	 */
	public function delete_kups_pendamping(int $id): RedirectResponse
	{
		DB::table('kups_pendamping')
			->where('id', $id)
			->delete();

		return redirect('lembaga-kups/' . Auth::user()->id . '/pendampingan');
	}

	/**
	 * Show the form for choosing a resource.
	 */
	public function list_kups_user(): View
	{
		$kups_list = LembagaKUPS::join('ps', 'kups.ps_id', '=', 'ps.id')
			->leftJoin('kups_user', 'kups_user.kups_id', '=', 'kups.id')
			->orderBy('kups.id')
			->distinct()
			->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);

		$users = User::join('roles', 'users.roles_id', '=', 'roles.id')
			->leftJoin('kups_user', 'kups_user.user_id', '=', 'users.id')
			->where('roles.role', '=', 'User')
			->orderBy('users.id')
			->distinct()
			->get(['users.id', 'users.name']);

		$kups_user = $users;
		$index = 0;

		foreach ($kups_user as $user) {
			$kups =	LembagaKUPS::join('kups_user', 'kups_user.kups_id', '=', 'kups.id')
				->join('ps', 'kups.ps_id', '=', 'ps.id')
				->where('kups_user.user_id', $user->id)
				->orderBy('kups.id')
				->get(['kups_user.id', 'kups.kups_name', 'ps.ps_name']);

			$kups_user[$index]->kups = $kups;
			$index++;
		}

		$data = array(
			'kups' => $kups_list,
			'user' => $users,
			'list' => $kups_user,
		);

		return view('pages.lembaga.kelola-user-kups')->with($data);
	}

	/**
	 * Store a choosed resource in storage.
	 */
	public function add_kups_user(Request $request)
	{
		$request->validate([
			'lembaga_kups' => ['required', 'integer', 'not_in:0'],
			'user' => ['required', 'integer', 'not_in:0', new ExtraKUPSExists()],
		]);

		DB::table('kups_user')
			->insert([
				'user_id' => $request->user,
				'kups_id' => $request->lembaga_kups,
			]);

		return redirect('lembaga-kups/' . Auth::user()->id . '/user');
	}

	/**
	 * Delete a choosed resource in storage.
	 */
	public function delete_kups_user(int $id): RedirectResponse
	{
		DB::table('kups_user')
			->where('id', $id)
			->delete();

		return redirect('lembaga-kups/' . Auth::user()->id . '/user');
	}
}
