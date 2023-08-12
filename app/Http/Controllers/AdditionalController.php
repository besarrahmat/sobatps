<?php

namespace App\Http\Controllers;

use App\Models\Additionals;
use App\Models\MasterAdditionals;
use App\Models\Usulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdditionalController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): void
	{
		//
	}

	/**
	 * Store a 'blank' resource in storage.
	 */
	public static function blank_file(string $id): void
	{
		$type = MasterAdditionals::count();

		for ($i = 1; $i <= $type; $i++) {
			Additionals::create([
				'usulan_id' => $id,
				'file_type' => $i,
				'file' => null,
				'tanggal' => null,
				'deskripsi' => null,
				'approval' => null,
				'note' => null,
			]);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request): View
	{
		$usulan_id = $request->query('usulan_id');

		$extra_list = MasterAdditionals::orderBy('urutan')
			->get();

		return view('pages.usulan.add-kelengkapan')->with('usulan_id', $usulan_id)->with('extra_list', $extra_list);
	}

	/**
	 * Store a 'newly created' resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$usulan = Usulan::findOrFail($request->usulan_id);

		$request->validate([
			'jenis_file' => ['required', 'integer', 'not_in:0'],
			'tgl_laporan' => ['required', 'date', 'filled'],
			'deskripsi' => ['sometimes', 'nullable'],
			'file_laporan' => ['required', 'nullable', 'mimes:pdf'],
		]);

		if (!$request->hasFile('file_laporan')) {
			$request->file_laporan = null;
		} else {
			$path = 'proposal/' . $usulan->program_id . '-' . $usulan->kups_id . '/' . strtolower($usulan->applicant_name);
			$file = date('U') . '-' . $request->file_laporan->getClientOriginalName();

			$request->file_laporan = $request->file_laporan->storeAs($path, $file);
		}

		$file = Additionals::where('usulan_id', $request->usulan_id)
			->where('file_type', $request->jenis_file)
			->get('file');

		if (is_null($file[0]->file)) {
			Additionals::where('usulan_id', $request->usulan_id)
				->where('file_type', $request->jenis_file)
				->update([
					'file' => $request->file_laporan,
					'tanggal' => $request->tgl_laporan,
					'deskripsi' => $request->deskripsi ?? '-',
					'approval' => 0,
					'note' => '-',
				]);
		} else {
			Additionals::create([
				'usulan_id' => $request->usulan_id,
				'file_type' => $request->jenis_file,
				'file' => $request->file_laporan,
				'tanggal' => $request->tgl_laporan,
				'deskripsi' => $request->deskripsi ?? '-',
				'approval' => 0,
				'note' => '-',
			]);
		}

		return redirect('usulan/' . $request->usulan_id);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Additionals $kelengkapan): void
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request, Additionals $kelengkapan): View
	{
		$extra_list = MasterAdditionals::orderBy('urutan')
			->get();

		$tipe = $request->query('tipe');

		$data = array(
			'extra_list' => $extra_list,
			'tipe' => $tipe,
			'kelengkapan' => $kelengkapan,
		);

		return view('pages.usulan.edit-kelengkapan')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Additionals $kelengkapan)
	{
		$usulan = Usulan::findOrFail($kelengkapan->usulan_id);

		$request->validate([
			'jenis_file' => ['required', 'integer'],
			'tgl_laporan' => ['required', 'date', 'filled'],
			'deskripsi' => ['sometimes', 'nullable'],
			'file_laporan' => ['sometimes', 'nullable', 'mimes:pdf'],
		]);

		$kelengkapan->update([
			'file_type' => $request->jenis_file,
			'tanggal' => $request->tgl_laporan,
			'deskripsi' => $request->deskripsi ?? '-',
		]);

		if ($request->hasFile('file_laporan')) {
			if (isset($kelengkapan->file) && Storage::exists($kelengkapan->file)) {
				Storage::delete($kelengkapan->file);
			}

			$path = 'proposal/' . $usulan->program_id . '-' . $usulan->kups_id . '/' . strtolower($usulan->applicant_name);
			$file = date('U') . '-' . $request->file_laporan->getClientOriginalName();

			$request->file_laporan = $request->file_laporan->storeAs($path, $file);

			$kelengkapan->update([
				'file' => $request->file_laporan,
				'approval' => 0,
			]);
		}

		return redirect('usulan/' . $kelengkapan->usulan_id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Additionals $kelengkapan): void
	{
		//
	}

	/**
	 * Show the form for approving the specified resource.
	 */
	public function pending(Request $request, Additionals $kelengkapan): View
	{
		$tipe_id = $request->query('tipe');

		$tipe = MasterAdditionals::where('id', $tipe_id)
			->first('jenis');

		$kelengkapan->tanggal = date('d-m-Y', strtotime($kelengkapan->tanggal));

		$jenis = array(
			'id' => $tipe_id,
			'tipe' => $tipe->jenis,
		);

		return view('pages.usulan.approve-kelengkapan')->with('jenis', $jenis)->with('kelengkapan', $kelengkapan);
	}

	/**
	 * Approve the specified resource in storage.
	 */
	public function approve(Request $request, Additionals $kelengkapan): RedirectResponse
	{
		$request->validate([
			'approval' => ['sometimes', 'boolean'],
			'catatan' => ['sometimes', 'nullable'],
		]);

		$kelengkapan->update([
			'approval' => $request->approval,
			'note' => $request->catatan ?? '-',
		]);

		return redirect('usulan/' . $kelengkapan->usulan_id);
	}
}
