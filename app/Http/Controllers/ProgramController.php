<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProgramController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		$program_list = Programs::all();
		$date_index = 0;

		foreach ($program_list as $program) {
			$program_list[$date_index]->start_date = date('d-m-Y', strtotime($program->start_date));
			$program_list[$date_index]->end_date = date('d-m-Y', strtotime($program->end_date));
			$date_index++;
		}

		return view('pages.auth.list-program')->with('program_list', $program_list);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$count = Programs::count();

		return view('pages.auth.add-program')->with('count', $count);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$count = Programs::count();

		$request->validate([
			'nama_program' => ['required', 'string', 'max:255'],
			'tanggal_mulai' => ['required', 'date', 'filled', 'before_or_equal:tanggal_selesai'],
			'tanggal_selesai' => ['required', 'date', 'filled', 'after_or_equal:tanggal_mulai'],
			'no_program' => ['required', 'gt:' . $count],
			'tanggal_kak' => ['required', 'date', 'filled'],
			'alokasi_dana' => ['required'],
			'file_kak' => ['sometimes', 'nullable', 'mimes:pdf'],
		]);

		if (!$request->hasFile('file_kak')) {
			$request->file_kak = null;
		} else {
			$file = date('U') . '-' . $request->file_kak->getClientOriginalName();

			$request->file_kak = $request->file_kak->storeAs('program', $file);
		}

		Programs::create([
			'program' => strtoupper($request->nama_program),
			'program_num' => $request->no_program,
			'start_date' => $request->tanggal_mulai,
			'end_date' => $request->tanggal_selesai,
			'kak_date' => $request->tanggal_kak,
			'kak_file' => $request->file_kak,
			'budget_allocation' => $request->alokasi_dana,
			'status' => 0,
		]);

		return redirect('program');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Programs $program): View
	{
		$program->start_date = date('d-m-Y', strtotime($program->start_date));
		$program->end_date = date('d-m-Y', strtotime($program->end_date));
		$program->kak_date = date('d-m-Y', strtotime($program->kak_date));

		return view('pages.auth.detail-program')->with('program', $program);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Programs $program): View
	{
		return view('pages.auth.edit-program')->with('program', $program);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Programs $program): RedirectResponse
	{
		$request->validate([
			'nama_program' => ['required', 'string', 'max:255'],
			'tanggal_mulai' => ['required', 'date', 'filled', 'before_or_equal:tanggal_selesai'],
			'tanggal_selesai' => ['required', 'date', 'filled', 'after_or_equal:tanggal_mulai'],
			'tanggal_kak' => ['required', 'date', 'filled'],
			'alokasi_dana' => ['required'],
			'file_kak' => ['sometimes', 'nullable', 'mimes:pdf'],
		]);

		$program->update([
			'program' => strtoupper($request->nama_program),
			'start_date' => $request->tanggal_mulai,
			'end_date' => $request->tanggal_selesai,
			'kak_date' => $request->tanggal_kak,
			'budget_allocation' => $request->alokasi_dana,
		]);

		if ($request->hasFile('file_kak')) {
			if (isset($program->kak_file) && Storage::exists($program->kak_file)) {
				Storage::delete($program->kak_file);
			}

			$file = date('U') . '-' . $request->file_kak->getClientOriginalName();

			$request->file_kak = $request->file_kak->storeAs('program', $file);

			$program->update([
				'kak_file' => $request->file_kak,
			]);
		}

		return redirect('program/' . $program->id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Programs $program): RedirectResponse
	{
		Storage::delete($program->kak_file);

		$program->delete();

		return redirect('program');
	}

	/**
	 * Open or close the status of a specified resource.
	 */
	public function open_close(Programs $program): RedirectResponse
	{
		if ($program->status == 0) {
			$program->status = 1;
		} else {
			$program->status = 0;
		}

		$program->save();

		return back();
	}
}
