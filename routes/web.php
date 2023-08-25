<?php

use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HibahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KUPSController;
use App\Http\Controllers\MasterAdditionalsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\PSController;
use App\Http\Controllers\RABController;
use App\Http\Controllers\SKController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StartController::class, 'index'])->name('start');
Route::get('lembaga-list', [DataController::class, 'lembaga_list'])->name('start.lembaga');
Route::get('program-list', [DataController::class, 'program_list'])->name('start.program');
Route::get('receiver-list', [DataController::class, 'receiver_list'])->name('start.receiver');
Route::get('category-list', [DataController::class, 'category_list'])->name('start.category');

Route::get('home', [HomeController::class, 'index'])
	->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::resources([
		'user' => UserController::class,
		'program' => ProgramController::class,
		'extra' => MasterAdditionalsController::class,
		'lembaga-ps' => PSController::class,
		'lembaga-kups' => KUPSController::class,
		'list-sk' => SKController::class,
		'draft-hibah' => HibahController::class,
		'usulan' => UsulanController::class,
		'rab' => RABController::class,
		'kelengkapan' => AdditionalController::class,
		'progress' => ProgressController::class,
	]);

	Route::patch('user/{user}/password', [UserController::class, 'password'])->name('user.password');

	Route::patch('program/{program}/open-close', [ProgramController::class, 'open_close'])->name('program.status');
	Route::get('program/{program}/pendaftar', [ProgramController::class, 'list'])->name('program.list');

	Route::get('lembaga-ps/kode/{kode}', function ($kode) {
		if (strlen($kode) == 4) {
			$query = DB::select("SELECT * FROM region WHERE LENGTH(kode) = 6 AND kode LIKE CONCAT($kode, '%')");
		} else {
			$query = DB::select("SELECT * FROM region WHERE LENGTH(kode) = 10 AND kode LIKE CONCAT($kode, '%')");
		}
		return response()->json($query);
	})->name('lembaga-ps.create-kode');
	Route::get('lembaga-ps/{lembaga_p}/kode/{kode}', function ($id, $kode) {
		if (strlen($kode) == 4) {
			$query = DB::select("SELECT * FROM region WHERE LENGTH(kode) = 6 AND kode LIKE CONCAT($kode, '%')");
		} else {
			$query = DB::select("SELECT * FROM region WHERE LENGTH(kode) = 10 AND kode LIKE CONCAT($kode, '%')");
		}
		return response()->json($query);
	})->name('lembaga-ps.edit-kode');

	Route::get('lembaga-kups/{id}/pendampingan', [KUPSController::class, 'list_kups_pendamping'])->name('lembaga-kups.list-pendamping-kups');
	Route::post('lembaga-kups/pendampingan', [KUPSController::class, 'add_kups_pendamping'])->name('lembaga-kups.store-pendamping-kups');
	Route::delete('lembaga-kups/{id}/pendampingan', [KUPSController::class, 'delete_kups_pendamping'])->name('lembaga-kups.delete-pendamping-kups');
	Route::get('lembaga-kups/{id}/user', [KUPSController::class, 'list_kups_user'])->name('lembaga-kups.list-user-kups');
	Route::post('lembaga-kups/user', [KUPSController::class, 'add_kups_user'])->name('lembaga-kups.store-user-kups');
	Route::delete('lembaga-kups/{id}/user', [KUPSController::class, 'delete_kups_user'])->name('lembaga-kups.delete-user-kups');

	Route::patch('draft-hibah/{draft_hibah}/approve', [HibahController::class, 'approve'])->name('draft-hibah.approve');

	Route::patch('usulan/{usulan}/open-close', [UsulanController::class, 'open_close'])->name('usulan.status');

	Route::get('kelengkapan/{kelengkapan}/pending', [AdditionalController::class, 'pending'])->name('kelengkapan.pending');
	Route::patch('kelengkapan/{kelengkapan}/approve', [AdditionalController::class, 'approve'])->name('kelengkapan.approve');

	Route::patch('progress/{progress}/approve', [ProgressController::class, 'approve'])->name('progress.approve');

	Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
