<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\LembagaPS;
use App\Models\Programs;
use App\Models\Progress;
use App\Models\Region;
use Illuminate\View\View;

class StartController extends Controller
{
	/**
	 * Show the application landing page.
	 */
	public function index(): View
	{
		/**
		 * counts.blade.php
		 */
		$total_ps = LembagaPS::count();
		$total_kups = LembagaKUPS::count();
		$total_area_ps = LembagaPS::sum('area');

		/**
		 * map.blade.php
		 */
		$kode_kab = Region::whereRaw('LENGTH(kode) = 4')->get('kode')->toArray();

		$map_lembaga = [];

		foreach ($kode_kab as $kab) {
			$map_ps = LembagaPS::whereRaw('region_code LIKE CONCAT(' . $kab['kode'] . ', "%")')
				->count();

			$map_kups = LembagaKUPS::join('ps', 'kups.ps_id', '=', 'ps.id')
				->whereRaw('ps.region_code LIKE CONCAT(' . $kab['kode'] . ', "%")')
				->count();

			$map_program = Programs::join('usulan', 'programs.id', '=', 'usulan.program_id')
				->join('kups', 'usulan.kups_id', '=', 'kups.id')
				->join('ps', 'kups.ps_id', '=', 'ps.id')
				->whereRaw('ps.region_code LIKE CONCAT(' . $kab['kode'] . ', "%")')
				->count();

			$map = array($map_ps, $map_kups, $map_program);

			array_push($map_lembaga, $map);
		}

		/**
		 * services.blade.php
		 */
		$hl = LembagaPS::where('area_function', 'HL')
			->count();
		$hlhpt = LembagaPS::where('area_function', 'HL,HPT')
			->count();
		$hp = LembagaPS::where('area_function', 'HP')
			->count();
		$hphpt = LembagaPS::where('area_function', 'HP,HPT')
			->count();
		$hpk = LembagaPS::where('area_function', 'HPK')
			->count();
		$hpt = LembagaPS::where('area_function', 'HPT')
			->count();
		$xxx = LembagaPS::where('area_function', 'xxx')
			->count();

		/**
		 * gallery.blade.php
		 */
		$gallery =  Progress::whereRaw('approval = 1 AND (documentation LIKE CONCAT("%jpg") OR documentation LIKE CONCAT("%jpeg") OR documentation LIKE CONCAT("%png") OR documentation LIKE CONCAT("%gif"))')
			->get()
			->toArray();

		$check = empty($gallery);

		$array = array(
			'total_ps' => $total_ps,
			'total_kups' => $total_kups,
			'total_area' => $total_area_ps,
			'map_lembaga' => $map_lembaga,
			'hl' => $hl,
			'hlhpt' => $hlhpt,
			'hp' => $hp,
			'hphpt' => $hphpt,
			'hpk' => $hpk,
			'hpt' => $hpt,
			'xxx' => $xxx,
			'check' => $check,
			'gallery' => $gallery,
		);

		return view('pages.landing-page')->with($array);
	}
}
