<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RABController extends Controller
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

		return view('pages.usulan.add-rab')->with('usulan_id', $usulan_id);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'barang' => ['required', 'string', 'max:255'],
			'banyak' => ['required', 'integer'],
			'satuan' => ['sometimes', 'nullable'],
			'harga' => ['required', 'integer'],
		]);

		$request->satuan = ($request->satuan === null) ? '-' : ucwords(strtolower($request->satuan));

		RAB::create([
			'usulan_id' => $request->usulan_id,
			'goods' => $request->barang,
			'amount' => $request->banyak,
			'unit' => $request->satuan,
			'price' => $request->harga,
			'total' => (int)$request->banyak * (int)$request->harga,
		]);

		return redirect('usulan/' . $request->usulan_id);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(RAB $rab): void
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(RAB $rab): View
	{
		return view('pages.usulan.edit-rab')->with('rab', $rab);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, RAB $rab)
	{
		$request->validate([
			'barang' => ['required', 'string', 'max:255'],
			'banyak' => ['required', 'integer'],
			'satuan' => ['sometimes', 'nullable'],
			'harga' => ['required', 'integer'],
		]);

		$request->satuan = ($request->satuan === null) ? '-' : ucwords(strtolower($request->satuan));

		$rab->update([
			'goods' => $request->barang,
			'amount' => $request->banyak,
			'unit' => $request->satuan,
			'price' => $request->harga,
			'total' => (int)$request->banyak * (int)$request->harga,
		]);

		return redirect('usulan/' . $rab->usulan_id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(RAB $rab)
	{
		$rab->delete();

		return redirect('usulan/' . $rab->usulan_id);
	}
}
