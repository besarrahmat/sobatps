<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\LembagaPS;
use App\Models\Usulan;
use Illuminate\View\View;

class HomeController extends Controller
{
	/**
	 * Show the application dashboard.
	 */
	public function index(): View
	{
		$total_ps = LembagaPS::count();
		$total_kups = LembagaKUPS::count();
		$total_usulan = Usulan::count();

		$array = array(
			'total_ps' => $total_ps,
			'total_kups' => $total_kups,
			'total_usulan' => $total_usulan,
		);

		return view('pages.dashboard')->with($array);
	}
}
