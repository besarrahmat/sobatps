<?php

return [

	/*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

	'accepted' => 'The data must be accepted.',
	'accepted_if' => 'The data must be accepted when :other is :value.',
	'active_url' => 'The data must be a valid URL.',
	'after' => 'The data must be a date after :date.',
	'after_or_equal' => 'The data must be a date after or equal to :date.',
	'alpha' => 'The data must only contain letters.',
	'alpha_dash' => 'The data must only contain letters, numbers, dashes, and underscores.',
	'alpha_num' => 'The data must only contain letters and numbers.',
	'array' => 'The data must be an array.',
	'ascii' => 'The data must only contain single-byte alphanumeric characters and symbols.',
	'before' => 'The data must be a date before :date.',
	'before_or_equal' => 'The data must be a date before or equal to :date.',
	'between' => [
		'array' => 'The data must have between :min and :max items.',
		'file' => 'The data must be between :min and :max kilobytes.',
		'numeric' => 'The data must be between :min and :max.',
		'string' => 'The data must be between :min and :max characters.',
	],
	'boolean' => 'The data must be true or false.',
	'can' => 'The data contains an unauthorized value.',
	'confirmed' => 'The data confirmation does not match.',
	'current_password' => 'The password is incorrect.',
	'date' => 'The data must be a valid date.',
	'date_equals' => 'The data must be a date equal to :date.',
	'date_format' => 'The data must match the format :format.',
	'decimal' => 'The data must have :decimal decimal places.',
	'declined' => 'The data must be declined.',
	'declined_if' => 'The data must be declined when :other is :value.',
	'different' => 'The data and :other must be different.',
	'digits' => 'The data must be :digits digits.',
	'digits_between' => 'The data must be between :min and :max digits.',
	'dimensions' => 'The data has invalid image dimensions.',
	'distinct' => 'The data has a duplicate value.',
	'doesnt_end_with' => 'The data must not end with one of the following: :values.',
	'doesnt_start_with' => 'The data must not start with one of the following: :values.',
	'email' => 'The data must be a valid email address.',
	'ends_with' => 'The data must end with one of the following: :values.',
	'enum' => 'The selected data is invalid.',
	'exists' => 'The selected data is invalid.',
	'file' => 'The data must be a file.',
	'filled' => 'The data must have a value.',
	'gt' => [
		'array' => 'The data must have more than :value items.',
		'file' => 'The data must be greater than :value kilobytes.',
		'numeric' => 'The data must be greater than :value.',
		'string' => 'The data must be greater than :value characters.',
	],
	'gte' => [
		'array' => 'The data must have :value items or more.',
		'file' => 'The data must be greater than or equal to :value kilobytes.',
		'numeric' => 'The data must be greater than or equal to :value.',
		'string' => 'The data must be greater than or equal to :value characters.',
	],
	'image' => 'The data must be an image.',
	'in' => 'The selected data is invalid.',
	'in_array' => 'The data must exist in :other.',
	'integer' => 'The data must be an integer.',
	'ip' => 'The data must be a valid IP address.',
	'ipv4' => 'The data must be a valid IPv4 address.',
	'ipv6' => 'The data must be a valid IPv6 address.',
	'json' => 'The data must be a valid JSON string.',
	'lowercase' => 'The data must be lowercase.',
	'lt' => [
		'array' => 'The data must have less than :value items.',
		'file' => 'The data must be less than :value kilobytes.',
		'numeric' => 'The data must be less than :value.',
		'string' => 'The data must be less than :value characters.',
	],
	'lte' => [
		'array' => 'The data must not have more than :value items.',
		'file' => 'The data must be less than or equal to :value kilobytes.',
		'numeric' => 'The data must be less than or equal to :value.',
		'string' => 'The data must be less than or equal to :value characters.',
	],
	'mac_address' => 'The data must be a valid MAC address.',
	'max' => [
		'array' => 'The data must not have more than :max items.',
		'file' => 'The data must not be greater than :max kilobytes.',
		'numeric' => 'The data must not be greater than :max.',
		'string' => 'The data must not be greater than :max characters.',
	],
	'max_digits' => 'The data must not have more than :max digits.',
	'mimes' => 'The data must be a file of type: :values.',
	'mimetypes' => 'The data must be a file of type: :values.',
	'min' => [
		'array' => 'The data must have at least :min items.',
		'file' => 'The data must be at least :min kilobytes.',
		'numeric' => 'The data must be at least :min.',
		'string' => 'The data must be at least :min characters.',
	],
	'min_digits' => 'The data must have at least :min digits.',
	'missing' => 'The data must be missing.',
	'missing_if' => 'The data must be missing when :other is :value.',
	'missing_unless' => 'The data must be missing unless :other is :value.',
	'missing_with' => 'The data must be missing when :values is present.',
	'missing_with_all' => 'The data must be missing when :values are present.',
	'multiple_of' => 'The data must be a multiple of :value.',
	'not_in' => 'The selected data is invalid.',
	'not_regex' => 'The data format is invalid.',
	'numeric' => 'The data must be a number.',
	'password' => [
		'letters' => 'Password must contain at least one letter.',
		'mixed' => 'Password must contain at least one uppercase and one lowercase letter.',
		'numbers' => 'Password must contain at least one number.',
		'symbols' => 'Password must contain at least one symbol.',
		'uncompromised' => 'The given password has appeared in a data leak. Please choose a different password.',
	],
	'present' => 'The data must be present.',
	'prohibited' => 'The data is prohibited.',
	'prohibited_if' => 'The data is prohibited when :other is :value.',
	'prohibited_unless' => 'The data is prohibited unless :other is in :values.',
	'prohibits' => 'The data prohibits :other from being present.',
	'regex' => 'The data format is invalid.',
	'required' => 'The data is required.',
	'required_array_keys' => 'The data must contain entries for: :values.',
	'required_if' => 'The data is required when :other is :value.',
	'required_if_accepted' => 'The data is required when :other is accepted.',
	'required_unless' => 'The data is required unless :other is in :values.',
	'required_with' => 'The data is required when :values is present.',
	'required_with_all' => 'The data is required when :values are present.',
	'required_without' => 'The data is required when :values is not present.',
	'required_without_all' => 'The data is required when none of :values are present.',
	'same' => 'The data must match :other.',
	'size' => [
		'array' => 'The data must contain :size items.',
		'file' => 'The data must be :size kilobytes.',
		'numeric' => 'The data must be :size.',
		'string' => 'The data must be :size characters.',
	],
	'starts_with' => 'The data must start with one of the following: :values.',
	'string' => 'The data must be a string.',
	'timezone' => 'The data must be a valid timezone.',
	'unique' => 'The data has already been taken.',
	'uploaded' => 'The data failed to upload.',
	'uppercase' => 'The data must be uppercase.',
	'url' => 'The data must be a valid URL.',
	'ulid' => 'The data must be a valid ULID.',
	'uuid' => 'The data must be a valid UUID.',

	/*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

	'custom' => [
		'roles' => [
			'required' => 'Please select role first.',
		],
		'jenis_ps' => [
			'required' => 'Please select PS type first.',
		],
		'kab_kota_ps' => [
			'required' => 'Please select regency or city of origin first.',
		],
		'kecamatan_ps' => [
			'required' => 'Please select district of origin first.',
		],
		'desa_ps' => [
			'required' => 'Please select vilalge of origin first.',
		],
		'kelas' => [
			'required' => 'Please select class category first.',
		],
		'lembaga_ps' => [
			'required' => 'Please select PS institute first.',
		],
		'tahun_sk' => [
			'between' => 'The year must be between :min and :max.',
		],
		'lembaga_kups' => [
			'required' => 'Please select KUPS institute first.',
		],
		'pendamping' => [
			'required' => 'Please select user first.',
		],
		'user' => [
			'required' => 'Please select user first.',
		],
		'program' => [
			'required' => 'Please select program first.',
		],
		'jenis_file' => [
			'required' => 'Please select additional type first.',
		],
	],

	/*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap our attribute placeholder
  | with something more reader friendly such as "E-Mail Address" instead
  | of "email". This simply helps us make our message more expressive.
  |
  */

	'attributes' => [],

];
