<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StartController extends Controller
{
	/**
	 * Show the application landing page.
	 */
	public function index(): View
	{
		return view('pages.landing-page');
	}
}
