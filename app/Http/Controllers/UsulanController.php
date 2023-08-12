<?php

namespace App\Http\Controllers;

use App\Models\Additionals;
use App\Models\MasterAdditionals;
use App\Models\Programs;
use App\Models\Progress;
use App\Models\RAB;
use App\Models\Usulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UsulanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		switch (Auth::user()->roles_id) {
			case 2:
				$usulan_list = Usulan::join('programs', 'usulan.program_id', '=', 'programs.id')
					->join('kups_pendamping', 'usulan.kups_id', '=', 'kups_pendamping.kups_id')
					->where('kups_pendamping.user_id', '=', Auth::user()->id)
					->orderBy('usulan.id')
					->get(['usulan.*', 'programs.program']);
				break;

			case 3:
				$usulan_list = Usulan::join('programs', 'usulan.program_id', '=', 'programs.id')
					->join('kups_user', 'usulan.kups_id', '=', 'kups_user.kups_id')
					->where('kups_user.user_id', '=', Auth::user()->id)
					->orderBy('usulan.id')
					->get(['usulan.*', 'programs.program']);
				break;

			default:
				$usulan_list = Usulan::join('programs', 'usulan.program_id', '=', 'programs.id')
					->orderBy('usulan.id')
					->get(['usulan.*', 'programs.program']);
				break;
		}

		$date_index = 0;

		foreach ($usulan_list as $usulan) {
			$usulan_list[$date_index]->proposal_date = date('d-m-Y', strtotime($usulan->proposal_date));
			$date_index++;
		}

		$kosong = Programs::where('status', 1)->get()->isEmpty();

		$list = array(
			'usulan_list' => $usulan_list,
			'kosong' => $kosong,
		);

		return view('pages.usulan.list-usulan')->with($list);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		switch (Auth::user()->roles_id) {
			case 2:
				$kups = DB::table('kups_pendamping')
					->join('kups', 'kups_pendamping.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_pendamping.user_id', '=', Auth::user()->id)
					->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);
				break;

			case 3:
				$kups = DB::table('kups_user')
					->join('kups', 'kups_user.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_user.user_id', '=', Auth::user()->id)
					->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);
				break;

			default:
				break;
		}

		$programs = Programs::where('status', '=', 1)
			->get(['id', 'program']);

		$list = array(
			'kups' => $kups,
			'programs' => $programs,
		);

		return view('pages.usulan.add-usulan')->with('list', $list);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		if (Auth::user()->roles_id == 3) {
			$kups = DB::table('kups_user')
				->join('kups', 'kups_user.kups_id', '=', 'kups.id')
				->join('ps', 'kups.ps_id', '=', 'ps.id')
				->where('kups_user.user_id', '=', Auth::user()->id)
				->first('kups.id');

			$request['lembaga_kups'] = $kups->id;
		}

		$request->validate([
			'lembaga_kups' => ['sometimes', 'integer', 'not_in:0'],
			'program' => ['required', 'integer', 'not_in:0'],
			'nama_pengusul' => ['required', 'string', 'max:255'],
			'no_sp_proposal' => ['required'],
			'tgl_proposal' => ['required', 'date', 'filled'],
			'budget_proposal' => ['required'],
			'proposal' => ['sometimes', 'nullable', 'mimes:pdf'],
			'latitude' => ['sometimes', 'nullable', 'regex:/^(-?\d+(\.\d+)?)$/'],
			'longitude' => ['sometimes', 'nullable', 'regex:/^(-?\d+(\.\d+)?)$/'],
		]);

		if (!$request->hasFile('proposal')) {
			$request->proposal = null;
		} else {
			$path = 'proposal/' . $request->program . '-' . $request->lembaga_kups . '/' . strtolower($request->nama_pengusul);
			$file = date('U') . '-' . $request->proposal->getClientOriginalName();

			$request->proposal = $request->proposal->storeAs($path, $file);
		}

		$extra_id = Usulan::create([
			'applicant_name' => strtoupper($request->nama_pengusul),
			'proposal_sp_num' => $request->no_sp_proposal,
			'proposal_date' => $request->tgl_proposal,
			'budget' => $request->budget_proposal,
			'status' => null,
			'proposal' => $request->proposal,
			'longitude' => $request->longitude,
			'latitude' => $request->latitude,
			'program_id' => $request->program,
			'kups_id' => $request->lembaga_kups,
			'user_id' => Auth::user()->id,
		]);

		AdditionalController::blank_file($extra_id->id);

		return redirect('usulan');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Usulan $usulan): View
	{
		$usulan->proposal_date = date('d-m-Y', strtotime($usulan->proposal_date));

		$rab = RAB::where('usulan_id', $usulan->id)
			->get();

		$rab_total = RAB::where('usulan_id', $usulan->id)
			->sum('total');

		$extra_list = $this->show_additionals($usulan->id);

		$progress = Progress::where('usulan_id', $usulan->id)
			->get();

		$date_index = 0;

		foreach ($progress as $item) {
			$progress[$date_index]->date = date('d-m-Y', strtotime($item->date));
			$date_index++;
		}

		$usulan['rab'] = $rab;
		$usulan['rab_total'] = $rab_total;
		$usulan['extra_list'] = $extra_list;
		$usulan['progress'] = $progress;

		return view('pages.usulan.detail-usulan')->with('usulan', $usulan);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Usulan $usulan): View
	{
		switch (Auth::user()->roles_id) {
			case 2:
				$kups = DB::table('kups_pendamping')
					->join('kups', 'kups_pendamping.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_pendamping.user_id', '=', Auth::user()->id)
					->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);
				break;

			case 3:
				$kups = DB::table('kups_user')
					->join('kups', 'kups_user.kups_id', '=', 'kups.id')
					->join('ps', 'kups.ps_id', '=', 'ps.id')
					->where('kups_user.user_id', '=', Auth::user()->id)
					->get(['kups.id', 'kups.kups_name', 'ps.ps_name']);
				break;

			default:
				break;
		}

		$programs = Programs::where('status', '=', 1)
			->get(['id', 'program']);

		$list = array(
			'kups' => $kups,
			'programs' => $programs,
		);

		$data = array(
			'usulan' => $usulan,
			'list' => $list,
		);

		return view('pages.usulan.edit-usulan')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Usulan $usulan): RedirectResponse
	{
		$request->validate([
			'program' => ['required', 'integer'],
			'nama_pengusul' => ['required', 'string', 'max:255'],
			'no_sp_proposal' => ['required'],
			'tgl_proposal' => ['required', 'date', 'filled'],
			'budget_proposal' => ['required'],
			'proposal' => ['sometimes', 'nullable', 'mimes:pdf'],
			'latitude' => ['sometimes', 'nullable', 'regex:/^(-?\d+(\.\d+)?)$/'],
			'longitude' => ['sometimes', 'nullable', 'regex:/^(-?\d+(\.\d+)?)$/'],
		]);

		if ($request->latitude != null && $request->longitude != null) {
			$usulan->update([
				'longitude' => $request->longitude,
				'latitude' => $request->latitude,
			]);
		}

		$usulan->update([
			'applicant_name' => strtoupper($request->nama_pengusul),
			'proposal_sp_num' => $request->no_sp_proposal,
			'proposal_date' => $request->tgl_proposal,
			'budget' => $request->budget_proposal,
			'program_id' => $request->program,
		]);

		if ($request->hasFile('proposal')) {
			if (isset($usulan->proposal) && Storage::exists($usulan->proposal)) {
				Storage::delete($usulan->proposal);
			}

			$path = 'proposal/' . $request->program . '-' . $usulan->kups_id . '/' . strtolower($request->nama_pengusul);
			$file = date('U') . '-' . $request->proposal->getClientOriginalName();

			$request->proposal = $request->proposal->storeAs($path, $file);

			$usulan->update([
				'proposal' => $request->proposal,
			]);
		}

		return redirect('usulan/' . $usulan->id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Usulan $usulan): RedirectResponse
	{
		$path = 'proposal/' . $usulan->program_id . '-' . $usulan->kups_id;

		Storage::deleteDirectory($path);

		$usulan->delete();

		return redirect('usulan');
	}

	/**
	 * Accept or decline the status of a specified resource.
	 */
	public function open_close(Request $request, Usulan $usulan): RedirectResponse
	{
		$usulan->status = $request->query('status');

		$usulan->save();

		return back();
	}

	/**
	 * Display the specified resource from additionals.
	 */
	private function show_additionals($id)
	{
		$extra_list = MasterAdditionals::all();

		foreach ($extra_list as $extra) {
			$extra->tanggal = $extra->approval = $extra->approve_id = null;
			$extra->catatan = $extra->note = '-';
			$extra->is_file_exist = false;
			$extra->file_list = [];

			$latestRecord = Additionals::where('file_type', $extra->id)
				->where('usulan_id', $id)
				->latest('id')
				->first(['tanggal', 'deskripsi', 'approval', 'file']);

			if ($latestRecord) {
				$extra->tanggal = $latestRecord->tanggal ? date('d-m-Y', strtotime($latestRecord->tanggal)) : null;
				$extra->approval = $latestRecord->approval;
				$extra->is_file_exist = (bool) $latestRecord->file;

				if ($latestRecord->deskripsi !== '-') $extra->catatan = $latestRecord->deskripsi ?? '-';
			}

			$note = Additionals::where('file_type', $extra['id'])
				->where('usulan_id', $id)
				->where('note', '!=', '-')
				->latest('id')
				->first('note');

			$approve_id = Additionals::where('file_type', $extra->id)
				->where('usulan_id', $id)
				->where('approval', 0)
				->value('id');

			$extra->note = $note->note ?? '-';
			$extra->approve_id = $approve_id ?? null;

			$extra->file_list = Additionals::where('file_type', $extra->id)
				->where('usulan_id', $id)
				->orderBy('id')
				->get(['id', 'file', 'approval']);
		}

		return $extra_list;
	}
}
