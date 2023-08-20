<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SKController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		$sk_list = DB::table('sk')
			->orderBy('tanggal_sk', 'desc')
			->orderBy('id', 'desc')
			->get();

		return view('pages.auth.list-sk')->with('sk_list', $sk_list);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('pages.auth.add-sk');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'tanggal_sk' => ['required', 'before_or_equal:' . date_format(now(), 'Y-m-d')],
			'keterangan' => ['sometimes', 'nullable', 'string'],
			'file_sk' => ['required', 'mimes:pdf'],
		]);

		$file = date('U') . '-' . $request->file_sk->getClientOriginalName();

		$request->file_sk = $request->file_sk->storeAs('sk_umum', $file);

		$source = storage_path('app/public/sk_umum');
		$destination = public_path('berkas/sk_umum');

		if (!File::exists($destination)) {
			File::makeDirectory($destination, 0777, true, true);
		}

		File::copyDirectory($source, $destination);

		DB::table('sk')
			->insert([
				'tahun_sk' => substr($request->tanggal_sk, 0, 4),
				'tanggal_sk' => $request->tanggal_sk,
				'keterangan' => $request->keterangan ?? '-',
				'file_sk' => $request->file_sk,
			]);

		return redirect('list-sk');
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
	public function destroy(string $id): RedirectResponse
	{
		$sk = DB::table('sk')
			->find($id, 'file_sk');

		Storage::delete($sk->file_sk);
		File::delete(public_path('berkas/' . $sk->file_sk));

		DB::table('sk')
			->delete($id);

		return redirect('list-sk');
	}
}
