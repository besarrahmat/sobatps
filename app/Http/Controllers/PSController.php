<?php

namespace App\Http\Controllers;

use App\Models\LembagaPS;
use App\Models\Region;
use App\Models\Types;
use App\Rules\SHPRevisionExclusive;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PSController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		switch (Auth::user()->roles_id) {
			case 2:
				$ps_list = DB::table('kups_pendamping')
					->join('kups', 'kups_pendamping.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_pendamping.user_id', '=', Auth::user()->id)
					->orderBy('ps.id')
					->distinct()
					->get(['ps.*']);
				break;

			case 3:
				$ps_list = DB::table('kups_user')
					->join('kups', 'kups_user.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_user.user_id', '=', Auth::user()->id)
					->orderBy('ps.id')
					->get(['ps.*']);
				break;

			default:
				$ps_list = LembagaPS::all();
				break;
		}

		$data = array(
			'ps_list' => $ps_list,
			'role' => Auth::user()->roles->code,
		);

		return view('pages.lembaga.list-ps')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$jenis = Types::all();

		$kab_kota_list = Region::whereRaw('LENGTH(kode) = 4')
			->get();

		$kecamatan_list = Region::whereRaw('LENGTH(kode) = 6')
			->get();

		$desa_list = Region::whereRaw('LENGTH(kode) = 10')
			->get();

		$data = array(
			'tipe' => $jenis,
			'kab_kota_list' => $kab_kota_list,
			'kecamatan_list' => $kecamatan_list,
			'desa_list' => $desa_list,
		);

		return view('pages.lembaga.add-ps')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'nama_ps' => ['required', 'string', 'max:255'],
			'jenis_ps' => ['required', 'integer', 'not_in:0'],
			'kab_kota_ps' => ['required', 'integer', 'not_in:0'],
			'kecamatan_ps' => ['required', 'integer', 'not_in:0'],
			'desa_ps' => ['required', 'integer', 'not_in:0'],
			'no_sk_ps' => ['required'],
			'tgl_sk_ps' => ['required', 'date', 'filled'],
			'luas_sk_ps' => ['required', 'numeric', 'min:0.01'],
			'ketua_ps' => ['sometimes', 'nullable', 'string', 'max:255'],
			'total_kk' => ['required', 'integer'],
			'kontak_ps' => ['sometimes', 'nullable', 'regex:/(08)[0-9]{9,11}/'],
			'fungsi_kawasan' => ['required', 'string'],
			'file_sk_ps' => ['sometimes', 'nullable', 'mimes:pdf'],
			'file_rku_ps' => ['sometimes', 'nullable', 'mimes:pdf'],
			'file_rkt_ps' => ['sometimes', 'nullable', 'mimes:pdf'],
			'file_shp_ps' => ['sometimes', 'nullable', 'mimes:pdf,zip,rar'],
		]);

		$request->ketua_ps = ($request->ketua_ps === null) ? 'xxx' : strtoupper($request->ketua_ps);

		$path = 'lembaga_ps/' . strtolower($request->nama_ps);

		if (!$request->hasFile('file_sk_ps')) {
			$request->file_sk_ps = null;
		} else {
			$file = date('U') . '-' . $request->file_sk_ps->getClientOriginalName();

			$request->file_sk_ps = $request->file_sk_ps->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			// $destination = public_path('berkas/' . $path);
			$destination = $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path;

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);
		}

		if (!$request->hasFile('file_rku_ps')) {
			$request->file_rku_ps = null;
		} else {
			$file = date('U') . '-' . $request->file_rku_ps->getClientOriginalName();

			$request->file_rku_ps = $request->file_rku_ps->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			// $destination = public_path('berkas/' . $path);
			$destination = $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path;

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);
		}

		if (!$request->hasFile('file_rkt_ps')) {
			$request->file_rkt_ps = null;
		} else {
			$file = date('U') . '-' . $request->file_rkt_ps->getClientOriginalName();

			$request->file_rkt_ps = $request->file_rkt_ps->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			// $destination = public_path('berkas/' . $path);
			$destination = $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path;

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);
		}

		if (!$request->hasFile('file_shp_ps')) {
			$request->file_shp_ps = null;
		} else {
			$file = date('U') . '-' . $request->file_shp_ps->getClientOriginalName();

			$request->file_shp_ps = $request->file_shp_ps->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			// $destination = public_path('berkas/' . $path);
			$destination = $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path;

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);
		}

		$desa = Region::where('kode', '=', $request->desa_ps)->get('daerah');
		$kecamatan = Region::where('kode', '=', $request->kecamatan_ps)->get('daerah');
		$kab_kota = Region::where('kode', '=', $request->kab_kota_ps)->get('daerah');

		$alamat = 'DESA ' . $desa[0]->daerah . ', KEC. ' . $kecamatan[0]->daerah . ', ' . $kab_kota[0]->daerah;

		LembagaPS::create([
			'ps_name' => strtoupper($request->nama_ps),
			'ps_sk_num' => $request->no_sk_ps,
			'ps_date' => $request->tgl_sk_ps,
			'area' => $request->luas_sk_ps,
			'ps_chief' => $request->ketua_ps,
			'kk_total' => $request->total_kk,
			'ps_contact' => $request->kontak_ps ?? 'xxx',
			'area_function' => $request->fungsi_kawasan,
			'sk_file' => $request->file_sk_ps,
			'rku_file' => $request->file_rku_ps,
			'rkt_file' => $request->file_rkt_ps,
			'shp_file' => $request->file_shp_ps,
			'ps_type_id' => $request->jenis_ps,
			'region_code' => $request->desa_ps,
			'address' => $alamat,
		]);

		return redirect('lembaga-ps');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(LembagaPS $lembaga_p): View
	{
		$empty = DB::table('ps_revisions')
			->where('ps_id', $lembaga_p->id)
			->get();

		if ($empty->isEmpty()) {
			if ($lembaga_p->sk_file != null) {
				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'SK',
						'file' => $lembaga_p->sk_file,
					]);
			}

			if ($lembaga_p->rku_file != null) {
				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'RKU',
						'file' => $lembaga_p->rku_file,
					]);
			}

			if ($lembaga_p->rkt_file != null) {
				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'RKT',
						'file' => $lembaga_p->rkt_file,
					]);
			}

			if ($lembaga_p->shp_file != null) {
				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'SHP',
						'file' => $lembaga_p->shp_file,
					]);
			}
		}

		$lembaga_p->ps_date = date('d-m-Y', strtotime($lembaga_p->ps_date));
		$lembaga_p->kecamatan = substr($lembaga_p->region_code, 0, 6);
		$lembaga_p->kab_kota = substr($lembaga_p->region_code, 0, 4);

		return view('pages.lembaga.detail-ps')->with('ps', $lembaga_p);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(LembagaPS $lembaga_p): View
	{
		$jenis = Types::all();

		$kab_kota_list = Region::whereRaw('LENGTH(kode) = 4')
			->get();

		$kecamatan_list = Region::whereRaw('LENGTH(kode) = 6')
			->get();

		$desa_list = Region::whereRaw('LENGTH(kode) = 10')
			->get();

		$lembaga_p->kecamatan = substr($lembaga_p->region_code, 0, 6);
		$lembaga_p->kab_kota = substr($lembaga_p->region_code, 0, 4);

		$sk_revisi = DB::table('ps_revisions')
			->where('ps_id', $lembaga_p->id)
			->where('file_type', 'SK')
			->get();
		$rku_revisi = DB::table('ps_revisions')
			->where('ps_id', $lembaga_p->id)
			->where('file_type', 'RKU')
			->get();
		$rkt_revisi = DB::table('ps_revisions')
			->where('ps_id', $lembaga_p->id)
			->where('file_type', 'RKT')
			->get();
		$shp_revisi = DB::table('ps_revisions')
			->where('ps_id', $lembaga_p->id)
			->where('file_type', 'SHP')
			->get();

		$data = array(
			'tipe' => $jenis,
			'kab_kota_list' => $kab_kota_list,
			'kecamatan_list' => $kecamatan_list,
			'desa_list' => $desa_list,
			'ps' => $lembaga_p,
			'revisi_sk' => $sk_revisi,
			'revisi_rku' => $rku_revisi,
			'revisi_rkt' => $rkt_revisi,
			'revisi_shp' => $shp_revisi,
		);

		return view('pages.lembaga.edit-ps')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, LembagaPS $lembaga_p): RedirectResponse
	{
		$request->validate([
			'nama_ps' => ['required', 'string', 'max:255'],
			'jenis_ps' => ['required', 'integer'],
			'kab_kota_ps' => ['sometimes', 'nullable', 'integer'],
			'kecamatan_ps' => ['sometimes', 'nullable', 'integer'],
			'desa_ps' => ['sometimes', 'nullable', 'integer'],
			'no_sk_ps' => ['required'],
			'tgl_sk_ps' => ['required', 'date', 'filled'],
			'luas_sk_ps' => ['required'],
			'ketua_ps' => ['sometimes', 'nullable', 'string', 'max:255'],
			'total_kk' => ['required', 'integer'],
			'kontak_ps' => ['sometimes', 'nullable', 'regex:/(08)[0-9]{9,11}/'],
			'fungsi_kawasan' => ['required', 'string'],
		]);

		$request->ketua_ps = ($request->ketua_ps === null) ? 'xxx' : strtoupper($request->ketua_ps);

		if (isset($request->desa_ps)) {
			$desa = Region::where('kode', '=', $request->desa_ps)->get('daerah');
			$kecamatan = Region::where('kode', '=', $request->kecamatan_ps)->get('daerah');
			$kab_kota = Region::where('kode', '=', $request->kab_kota_ps)->get('daerah');

			$alamat = 'DESA ' . $desa[0]->daerah . ', KEC. ' . $kecamatan[0]->daerah . ', ' . $kab_kota[0]->daerah;

			$lembaga_p->update([
				'region_code' => $request->desa_ps,
				'address' => $alamat,
			]);
		}

		if ($lembaga_p->ps_name != strtoupper($request->nama_ps)) {
			$old = 'lembaga_ps/' . strtolower($lembaga_p->ps_name);
			$new = 'lembaga_ps/' . strtolower($request->nama_ps);

			Storage::move($old, $new);
			// File::move(public_path('berkas/' . $old), public_path('berkas/' . $new));
			File::move($_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $old, $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $new);
		}

		$lembaga_p->update([
			'ps_name' => strtoupper($request->nama_ps),
			'ps_sk_num' => $request->no_sk_ps,
			'ps_date' => $request->tgl_sk_ps,
			'area' => $request->luas_sk_ps,
			'ps_chief' => $request->ketua_ps,
			'kk_total' => $request->total_kk,
			'ps_contact' => $request->kontak_ps ?? 'xxx',
			'area_function' => $request->fungsi_kawasan,
			'ps_type_id' => $request->jenis_ps,
		]);

		return redirect('lembaga-ps/' . $lembaga_p->id);
	}

	public function revision(Request $request, LembagaPS $lembaga_p): RedirectResponse
	{
		$request->validate([
			'file_type' => ['required', 'string'],
			'new_file' => ['required', new SHPRevisionExclusive($request->file_type)],
		]);

		$path = 'lembaga_ps/' . strtolower($lembaga_p->ps_name);

		$file = date('U') . '-' . $request->new_file->getClientOriginalName();

		$request->new_file = $request->new_file->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			// $destination = public_path('berkas/' . $path);
			$destination = $_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path;

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);

		switch ($request->file_type) {
			case 'SK':
			$lembaga_p->update([
					'sk_file' => $request->new_file,
			]);

				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'SK',
						'file' => $lembaga_p->sk_file,
					]);
				break;

			case 'RKU':
			$lembaga_p->update([
					'rku_file' => $request->new_file,
			]);

				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'RKU',
						'file' => $lembaga_p->rku_file,
					]);
				break;

			case 'RKT':
			$lembaga_p->update([
					'rkt_file' => $request->new_file,
			]);

				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'RKT',
						'file' => $lembaga_p->rkt_file,
					]);
				break;

			case 'SHP':
			$lembaga_p->update([
					'shp_file' => $request->new_file,
				]);

				DB::table('ps_revisions')
					->insert([
						'ps_id' => $lembaga_p->id,
						'file_type' => 'SHP',
						'file' => $lembaga_p->shp_file,
			]);
				break;
		}

		return redirect('lembaga-ps/' . $lembaga_p->id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(LembagaPS $lembaga_p): RedirectResponse
	{
		$path = 'lembaga_ps/' . strtolower($lembaga_p->ps_name);

		Storage::deleteDirectory($path);
		// File::deleteDirectory(public_path('berkas/' . $path));
		File::deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/' . 'berkas/' . $path);

		$lembaga_p->delete();

		return redirect('lembaga-ps');
	}
}
