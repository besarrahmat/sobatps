<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SHPRevisionExclusive implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($file_type)
    {
        $this->file_type = $file_type;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mimes = $this->file_type === 'SHP' ? ['pdf', 'zip', 'rar'] : ['pdf'];
        if (!$value->isValid() || !in_array($value->getClientOriginalExtension(), $mimes)) {
            $fail('Data revisi harus berupa file dengan tipe: ' . implode(', ', $mimes) . '.');
        }
    }
}
