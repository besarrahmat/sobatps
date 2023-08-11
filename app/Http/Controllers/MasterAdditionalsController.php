<?php

namespace App\Http\Controllers;

use App\Models\MasterAdditionals;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterAdditionalsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		$extra_list = MasterAdditionals::all()
			->sortBy('urutan');

		return view('pages.auth.list-extra')->with('extra_list', $extra_list);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$count = MasterAdditionals::count();
		$count++;

		return view('pages.auth.add-extra')->with('urutan', $count);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$count = MasterAdditionals::count();
		$count++;

		$request->validate([
			'jenis' => ['required', 'string', 'max:255'],
			'deskripsi' => ['required', 'string'],
		]);

		MasterAdditionals::create([
			'jenis' => $request->jenis,
			'deskripsi' => $request->deskripsi,
			'urutan' => $count,
		]);

		return redirect('extra');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(MasterAdditionals $extra): View
	{
		return view('pages.auth.detail-extra')->with('extra', $extra);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(MasterAdditionals $extra): View
	{
		return view('pages.auth.edit-extra')->with('extra', $extra);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, MasterAdditionals $extra)
	{
		$request->validate([
			'jenis' => ['required', 'string', 'max:255'],
			'urutan' => ['required', 'integer'],
			'deskripsi' => ['required', 'string'],
		]);

		$extra->update([
			'jenis' => $request->jenis,
			'deskripsi' => $request->deskripsi,
			'urutan' => $request->urutan,
		]);

		return redirect('extra');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(MasterAdditionals $extra)
	{
		$extra->delete();

		return redirect('extra');
	}
}
