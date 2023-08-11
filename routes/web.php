<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterAdditionalsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PSController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [HomeController::class, 'index'])
	->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::resources([
		'user' => UserController::class,
		'program' => ProgramController::class,
		'extra' => MasterAdditionalsController::class,
		'lembaga-ps' => PSController::class,
	]);

	Route::patch('user/{user}/password', [UserController::class, 'password'])->name('user.password');

	Route::patch('program/{program}/open-close', [ProgramController::class, 'open_close'])->name('program.status');

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

	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
