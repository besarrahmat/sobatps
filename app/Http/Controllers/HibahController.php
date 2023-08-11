<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HibahController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		$hibah_list = DB::table('hibah')
			->orderBy('approval')
			->orderByDesc('tanggal_sk')
			->orderByDesc('id')
			->get();

		$check = DB::table('hibah')
			->where('approval', 0)
			->count();

		$pendamping = User::where('roles_id', 2)
			->get();

		$kups_list = LembagaKUPS::get('kups_name');

		$index = 0;

		foreach ($hibah_list as $hibah) {
			foreach ($pendamping as $user) {
				if ($hibah->edited_name === $user->name) {
					$hibah->is_exist_name = true;
					break;
				} else {
					$hibah->is_exist_name = false;
				}
				if (count($pendamping) - 1 == $index) {
					$hibah->is_exist_name = false;
				}
				$index++;
			}
		}

		foreach ($hibah_list as $hibah) {
			foreach ($kups_list as $kups) {
				if ($hibah->deleted_kups === $kups->kups_name) {
					$hibah->is_exist_kups = true;
					break;
				} else {
					$hibah->is_exist_kups = false;
				}
				if (count($kups_list) - 1 == $index) {
					$hibah->is_exist_kups = false;
				}
				$index++;
			}
		}

		foreach ($hibah_list as $hibah) {
			$hibah->tanggal_sk = date('d-m-Y', strtotime($hibah->tanggal_sk));
		}

		$data = array(
			'hibah_list' => $hibah_list,
			'check' => $check,
		);

		return view('pages.lembaga.list-draft-hibah')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$kups_list = LembagaKUPS::join('ps', 'kups.ps_id', '=', 'ps.id')
			->leftJoin('kups_pendamping', 'kups_pendamping.kups_id', '=', 'kups.id')
			->where('kups_pendamping.user_id', '=', auth()->user()->id)
			->orderBy('kups.id')
			->get(['kups_pendamping.id', 'kups.kups_name', 'ps.ps_name']);

		return view('pages.lembaga.add-draft-hibah')->with('kups', $kups_list);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'tanggal' => ['required', 'date', 'filled'],
			'kups_pendamping' => ['required', 'integer', 'not_in:0'],
			'file_sk' => ['required', 'mimes:pdf'],
		]);

		$kups =	LembagaKUPS::join('kups_pendamping', 'kups_pendamping.kups_id', '=', 'kups.id')
			->join('users', 'users.id', '=', 'kups_pendamping.user_id')
			->where('kups_pendamping.id', $request->kups_pendamping)
			->orderBy('kups.id')
			->get(['kups.kups_name', 'users.name']);

		foreach ($kups as $test) {
			$request['name'] = $test->name;
			$request['kups_name'] = $test->kups_name;
		}

		$path = 'hibah/' . $request->kups_pendamping;

		$file = date('U') . '-' . $request->file_sk->getClientOriginalName();

		$request->file_sk = $request->file_sk->storeAs($path, $file);

		DB::table('hibah')
			->insert([
				'edited_name' => $request->name,
				'deleted_kups' => $request->kups_name,
				'tanggal_sk' => $request->tanggal,
				'file_sk' => $request->file_sk,
			]);

		return redirect('draft-hibah');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id): void
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id): void
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id): void
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id): void
	{
		//
	}

	/**
	 * Approve the specified resource in storage.
	 */
	public function approve(string $id): RedirectResponse
	{
		DB::table('hibah')
			->where('id', $id)
			->update(['approval' => 1]);

		return back();
	}
}
