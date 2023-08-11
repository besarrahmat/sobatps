<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
	/**
	 * Show the application dashboard.
	 */
	public function index(): View
	{
		return view('pages.home');
	}
}