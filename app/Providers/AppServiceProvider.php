<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		// Using closure based composers..
		View::composer('layouts.dashboard', function ($view) {
			if (Auth::user()->roles_id == 3) {
				$test = User::leftJoin('kups_user', 'kups_user.user_id', '=', 'users.id')
					->where('users.roles_id', '=', 3)
					->where('users.id', '=', Auth::user()->id)
					->get(['kups_user.user_id'])
					->first();
				View::share('user_id', $test['user_id']);
			} else {
				View::share('user_id', Auth::user()->id);
			}
		});
	}
}
