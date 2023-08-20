<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Usulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProgressController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): void
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request): View
	{
		$usulan_id = $request->query('usulan_id');

		return view('pages.usulan.add-progress')->with('usulan_id', $usulan_id);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$usulan = Usulan::findOrFail($request->usulan_id);

		$request->validate([
			'aktivitas' => ['required', 'string', 'max:255'],
			'tanggal' => ['required', 'date', 'filled'],
			'dokumentasi' => ['required', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
		]);

		if (!$request->hasFile('dokumentasi')) {
			$request->dokumentasi = null;
		} else {
			$path = 'proposal/' . $usulan->program_id . '-' . $usulan->kups_id . '/' . strtolower($usulan->applicant_name);
			$file = now()->format('U') . '-' . $request->dokumentasi->getClientOriginalName();

			$request->dokumentasi = $request->dokumentasi->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			$destination = public_path('berkas/' . $path);

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);
		}

		Progress::create([
			'usulan_id' => $request->usulan_id,
			'date' => $request->tanggal,
			'activity' => $request->aktivitas,
			'documentation' => $request->dokumentasi,
			'approval' => 0,
		]);

		return redirect('usulan/' . $request->usulan_id);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Progress $progress): void
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Progress $progress): View
	{
		return view('pages.usulan.edit-progress')->with('progress', $progress);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Progress $progress): RedirectResponse
	{
		$usulan = Usulan::findOrFail($progress->usulan_id);

		$request->validate([
			'aktivitas' => ['required', 'string', 'max:255'],
			'tanggal' => ['required', 'date', 'filled'],
			'dokumentasi' => ['sometimes', 'nullable', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
		]);

		$progress->update([
			'date' => $request->tanggal,
			'activity' => $request->aktivitas,
		]);

		if ($request->hasFile('dokumentasi')) {
			if (isset($progress->documentation) && Storage::exists($progress->documentation)) {
				Storage::delete($progress->documentation);
				File::delete(public_path('berkas/' . $progress->documentation));
			}

			$path = 'proposal/' . $usulan->program_id . '-' . $usulan->kups_id . '/' . strtolower($usulan->applicant_name);
			$file = date('U') . '-' . $request->dokumentasi->getClientOriginalName();

			$request->dokumentasi = $request->dokumentasi->storeAs($path, $file);

			$source = storage_path('app/public/' . $path);
			$destination = public_path('berkas/' . $path);

			if (!File::exists($destination)) {
				File::makeDirectory($destination, 0777, true, true);
			}

			File::copyDirectory($source, $destination);

			$progress->update([
				'documentation' => $request->dokumentasi,
			]);
		}

		return redirect('usulan/' . $progress->usulan_id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Progress $progress)
	{
		Storage::delete($progress->documentation);
		File::delete(public_path('berkas/' . $progress->documentation));

		$progress->delete();

		return redirect('usulan/' . $progress->usulan_id);
	}

	/**
	 * Approve the specified resource in storage.
	 */
	public function approve(Progress $progress)
	{
		$progress->approval = 1;

		$progress->save();

		return back();
	}
}
