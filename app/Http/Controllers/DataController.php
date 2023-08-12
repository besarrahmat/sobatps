<?php

namespace App\Http\Controllers;

use App\Models\LembagaKUPS;
use App\Models\LembagaPS;
use App\Models\Programs;
use App\Models\Usulan;
use Illuminate\View\View;

class DataController extends Controller
{
	/**
	 * Show the application secondary landing page.
	 */

	/**
	 * lembaga-list.blade.php
	 */
	public function lembaga_list(): View
	{
		$ps_list = LembagaPS::join('types', 'ps.ps_type_id', '=', 'types.id')
			->orderBy('ps.id')
			->get(['ps.id', 'ps.ps_name', 'ps.address', 'ps.ps_sk_num', 'types.type']);

		$index = 0;

		foreach ($ps_list as $ps) {
			$kups = LembagaKUPS::where('ps_id', $ps['id'])
				->orderBy('id')
				->get(['kups_name', 'kups_sk_num', 'business_type', 'comodity', 'kups_chief']);

			$ps_list[$index]->kups_list = $kups;
			$index++;
		}

		return view('includes.data.lembaga-list', compact('ps_list'));
	}

	/**
	 * program-list.blade.php
	 */
	public function program_list(): View
	{
		$program_list = Programs::orderByDesc('status')
			->orderByDesc('start_date')
			->orderBy('program_num')
			->get(['id', 'program', 'status']);

		$index = 0;

		foreach ($program_list as $program) {
			$usulan_list = Usulan::join('kups', 'usulan.kups_id', '=', 'kups.id')
				->join('ps', 'kups.ps_id', '=', 'ps.id')
				->where('usulan.program_id', $program['id'])
				->count();

			$program_list[$index]->total = $usulan_list;
			$index++;
		}

		return view('includes.data.program-list', compact('program_list'));
	}

	/**
	 * receiver-list.blade.php
	 */
	public function receiver_list(): View
	{
		$receiver_list = Usulan::join('programs', 'usulan.program_id', '=', 'programs.id')
			->join('kups', 'usulan.kups_id', '=', 'kups.id')
			->join('ps', 'kups.ps_id', '=', 'ps.id')
			->join('types', 'ps.ps_type_id', '=', 'types.id')
			->orderBy('ps.id')
			->get(['ps.id', 'ps.ps_name', 'ps.address', 'ps.ps_sk_num', 'types.type', 'kups.kups_name', 'usulan.proposal_date', 'programs.program']);

		$index = 0;

		foreach ($receiver_list as $year) {
			$receiver_list[$index]->proposal_year = date('Y', strtotime($year->proposal_date));
			$index++;
		}

		return view('includes.data.receiver-list', compact('receiver_list'));
	}

	/**
	 * category-list.blade.php
	 */
	public function category_list(): View
	{
		$ps_list = LembagaPS::join('types', 'ps.ps_type_id', '=', 'types.id')
			->orderBy('ps.id')
			->get(['ps.id', 'ps.ps_name', 'ps.address', 'types.type']);

		$index = 0;

		foreach ($ps_list as $ps) {
			$kups_list = LembagaKUPS::where('ps_id', $ps->id)
				->orderBy('id')
				->get(['kups_name', 'class', 'comodity']);

			if ($kups_list != []) {
				$class_index = 0;

				foreach ($kups_list as $kups) {
					switch ($kups->class) {
						case '1':
							$test = $kups->class = 'Platinum';
							break;

						case '2':
							$test = $kups->class = 'Gold';
							break;

						case '3':
							$test = $kups->class = 'Silver';
							break;

						case '4':
							$test = $kups->class = 'Blue';
							break;

						default:
							$test = $kups->class = 'Belum terdata';
							break;
					}

					$kups_list[$class_index]->$test;
					$class_index++;
				}
			}

			$ps_list[$index]->kups_list = $kups_list;
			$index++;
		}

		return view('includes.data.category-list')->with('category_list', $ps_list);
	}
}
