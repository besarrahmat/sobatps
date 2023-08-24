<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExtraKUPSExists implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$isExist = DB::table('kups_pendamping')
			->where('user_id', $value)
			->where('kups_id', request()->input('lembaga_kups'))
			->first();

		if ($isExist) {
			$fail('Data sudah ada.');
		}
	}
}
