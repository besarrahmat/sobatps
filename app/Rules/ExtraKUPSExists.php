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
		if ($attribute == 'pendamping') {
			$isExist = DB::table('kups_pendamping')
				->where('user_id', $value)
				->where('kups_id', request()->input('lembaga_kups'))
				->first();
		} elseif ($attribute == 'user') {
			$isExist = DB::table('kups_user')
				->where('user_id', $value)
				->where('kups_id', request()->input('lembaga_kups'))
				->first();

			$isOnlyOne = DB::table('kups_user')
				->where('user_id', $value)
				->count();

			if ($isOnlyOne > 0) {
				$fail('User KUPS hanya boleh satu Lembaga KUPS.');
			}
		}

		if ($isExist) {
			$fail('Data sudah ada.');
		}
	}
}
