<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\LembagaPS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KUPSController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		switch (Auth::user()->roles_id) {
			case 2:
				$kups_list = DB::table('kups_pendamping')
					->join('kups', 'kups_pendamping.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_pendamping.user_id', '=', Auth::user()->id)
					->orderBy('kups.id')
					->get(['kups.*', 'ps.ps_name']);
				break;

			case 3:
				$kups_list = DB::table('kups_user')
					->join('kups', 'kups_user.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_user.user_id', '=', Auth::user()->id)
					->orderBy('kups.id')
					->get(['kups.*', 'ps.ps_name']);
				break;

			default:
				$kups_list = LembagaKUPS::join('ps', 'kups.ps_id', '=', 'ps.id')
					->orderBy('kups.id')
					->get(['kups.*', 'ps.ps_name']);
				break;
		}

		$data = array(
			'kups_list' => $kups_list,
			'role' => Auth::user()->roles->code,
		);

		return view('pages.lembaga.list-kups')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$ps = LembagaPS::get(['id', 'ps_name', 'address']);

		return view('pages.lembaga.add-kups')->with('ps', $ps);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'lembaga_ps' => ['required', 'integer', 'not_in:0'],
			'nama_kups' => ['required', 'string', 'max:255'],
			'no_sk_kups' => ['sometimes', 'nullable'],
			'jenis_usaha' => ['sometimes', 'nullable', 'string'],
			'komoditas' => ['sometimes', 'nullable', 'string'],
			'kelas' => ['required', 'integer', 'not_in:0'],
			'ketua_kups' => ['sometimes', 'nullable', 'string', 'max:255'],
			'kontak_kups' => ['sometimes', 'nullable', 'regex:/(08)[0-9]{9,11}/'],
		]);

		$request->ketua_kups = ($request->ketua_kups === null) ? 'xxx' : strtoupper($request->ketua_kups);

		$new_kups_id = LembagaKUPS::create([
			'kups_name' => strtoupper($request->nama_kups),
			'kups_sk_num' => $request->no_sk_kups ?? 'xxx',
			'business_type' => $request->jenis_usaha ?? 'xxx',
			'comodity' => $request->komoditas ?? 'xxx',
			'class' => $request->kelas,
			'kups_chief' => $request->ketua_kups,
			'kups_contact' => $request->kontak_kups ?? 'xxx',
			'ps_id' => $request->lembaga_ps,
		]);

		if (Auth::user()->roles_id == 2) {
			$kups_id = $new_kups_id->id;
			$user_id = Auth::user()->id;

			DB::table('kups_pendamping')
				->insert([
					'user_id' => $user_id,
					'kups_id' => $kups_id,
				]);
		}

		return redirect('lembaga-kups');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(LembagaKUPS $lembaga_kup): View
	{
		return view('pages.lembaga.detail-kups')->with('kups', $lembaga_kup);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(LembagaKUPS $lembaga_kup)
	{
		$ps = LembagaPS::get(['id', 'ps_name', 'address']);

		$data = array(
			'kups' => $lembaga_kup,
			'ps' => $ps,
		);

		return view('pages.lembaga.edit-kups')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, LembagaKUPS $lembaga_kup)
	{
		$request->validate([
			'lembaga_ps' => ['required', 'integer'],
			'nama_kups' => ['required', 'string', 'max:255'],
			'no_sk_kups' => ['sometimes', 'nullable'],
			'jenis_usaha' => ['sometimes', 'nullable', 'string'],
			'komoditas' => ['sometimes', 'nullable', 'string'],
			'kelas' => ['required', 'integer', 'not_in:0'],
			'ketua_kups' => ['sometimes', 'nullable', 'string', 'max:255'],
			'kontak_kups' => ['sometimes', 'nullable', 'regex:/(08)[0-9]{9,11}/'],
		]);

		$request->nama_kups = strtoupper($request->nama_kups);
		$request->ketua_kups = ($request->ketua_kups === null) ? 'xxx' : strtoupper($request->ketua_kups);

		DB::table('hibah')
			->where('deleted_kups', $lembaga_kup->kups_name)
			->update(['deleted_kups' => $request->nama_kups]);

		$lembaga_kup->update([
			'kups_name' => $request->nama_kups,
			'kups_sk_num' => $request->no_sk_kups ?? 'xxx',
			'business_type' => $request->jenis_usaha ?? 'xxx',
			'comodity' => $request->komoditas ?? 'xxx',
			'class' => $request->kelas,
			'kups_chief' => $request->ketua_kups,
			'kups_contact' => $request->kontak_kups ?? 'xxx',
			'ps_id' => $request->lembaga_ps,
		]);

		return redirect('lembaga-kups/' . $lembaga_kup->id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(LembagaKUPS $lembaga_kup)
	{
		$lembaga_kup->delete();

		return redirect('lembaga-kups');
	}
}
