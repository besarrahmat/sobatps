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

	'accepted' => 'Data harus diterima.',
	'accepted_if' => 'Data harus diterima bila :other adalah :value.',
	'active_url' => 'Data bukan URL yang valid.',
	'after' => 'Data harus berupa tanggal setelah :date.',
	'after_or_equal' => 'Data harus berupa tanggal setelah atau sama dengan :date.',
	'alpha' => 'Data hanya boleh berisi huruf.',
	'alpha_dash' => 'Data hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
	'alpha_num' => 'Data hanya boleh berisi huruf dan angka.',
	'array' => 'Data hanya berupa array.',
	'ascii' => 'Data hanya boleh berisi karakter dan simbol alfanumerik single-byte.',
	'before' => 'Data harus berupa tanggal sebelum :date.',
	'before_or_equal' => 'Data harus berupa tanggal sebelum atau sama dengan :date.',
	'between' => [
		'array' => 'Data harus antara :min dan :max item.',
		'file' => 'Data harus antara :min dan :max kilobyte.',
		'numeric' => 'Data harus antara :min dan :max.',
		'string' => 'Data harus antara :min dan :max karakter.',
	],
	'boolean' => 'Data harus bernilai benar atau salah.',
	'can' => 'Data berisi nilai yang tidak diperbolehkan.',
	'confirmed' => 'Konfirmasi data tidak sesuai.',
	'current_password' => 'Password salah.',
	'date' => 'Data bukan tanggal yang valid.',
	'date_equals' => 'Data harus berupa tanggal yang sama dengan :date.',
	'date_format' => 'Data tidak sesuai dengan format :format.',
	'decimal' => 'Data harus memiliki :desimal angka di belakang koma.',
	'declined' => 'Data harus ditolak.',
	'declined_if' => 'Data harus ditolak bila :other adalah :value.',
	'different' => 'Data dan :other harus berbeda.',
	'digits' => 'Data must be :digits digit.',
	'digits_between' => 'Data harus antara :min dan :max digit.',
	'dimensions' => 'Data memiliki dimensi gambar yang tidak valid.',
	'distinct' => 'Kolom memiliki nilai yang sama.',
	'doesnt_end_with' => 'Data tidak boleh diakhiri dengan salah satu dari data berikut: :values.',
	'doesnt_start_with' => 'Data tidak boleh diawali dengan salah satu dari data berikut: :values.',
	'email' => 'Data harus berupa alamat email yang valid.',
	'ends_with' => 'Data harus diakhiri dengan salah satu dari berikut ini: :values.',
	'enum' => 'Data yang dipilih tidak valid.',
	'exists' => 'Data yang dipilih tidak valid.',
	'file' => 'Data harus berupa file.',
	'filled' => 'Kolom harus memiliki nilai.',
	'gt' => [
		'array' => 'Data harus memiliki lebih dari :value item.',
		'file' => 'Data harus lebih besar dari :value kilobyte.',
		'numeric' => 'Data harus lebih besar dari :value.',
		'string' => 'Data harus lebih besar dari :value karakter.',
	],
	'gte' => [
		'array' => 'Data harus memiliki :value item atau lebih.',
		'file' => 'Data harus lebih besar dari atau sama dengan :value kilobyte.',
		'numeric' => 'Data harus lebih besar dari atau sama dengan :value.',
		'string' => 'Data harus lebih besar dari atau sama dengan :value karakter.',
	],
	'image' => 'Data harus berupa gambar.',
	'in' => 'Data yang dipilih tidak valid.',
	'in_array' => 'Data tidak ada di dalam :other.',
	'integer' => 'Data harus bilangan bulat.',
	'ip' => 'Data harus berupa alamat IP yang valid.',
	'ipv4' => 'Data harus berupa alamat IPv4 yang valid.',
	'ipv6' => 'Data harus berupa alamat IPv6 yang valid.',
	'json' => 'Data harus berupa JSON yang valid.',
	'lowercase' => 'Data harus menggunakan huruf kecil.',
	'lt' => [
		'array' => 'Data harus memiliki kurang dari :value item.',
		'file' => 'Data harus lebih kecil dari :value kilobyte.',
		'numeric' => 'Data harus lebih kecil dari :value.',
		'string' => 'Data harus lebih kecil dari :value karakter.',
	],
	'lte' => [
		'array' => 'Data tidak boleh lebih dari :value item.',
		'file' => 'Data harus lebih kecil dari atau sama dengan :value kilobyte.',
		'numeric' => 'Data harus lebih kecil dari atau sama dengan :value.',
		'string' => 'Data harus lebih kecil dari atau sama dengan :value karakter.',
	],
	'mac_address' => 'Data harus berupa alamat MAC yang valid.',
	'max' => [
		'array' => 'Data tidak boleh memiliki lebih dari :max item.',
		'file' => 'Data tidak boleh lebih besar dari :max kilobyte.',
		'numeric' => 'Data tidak boleh lebih besar dari :max.',
		'string' => 'Data tidak boleh lebih besar dari :max karakter.',
	],
	'max_digits' => 'Data tidak boleh memiliki lebih dari :max digit.',
	'mimes' => 'Data harus berupa file dengan tipe: :values.',
	'mimetypes' => 'Data harus berupa file dengan tipe: :values.',
	'min' => [
		'array' => 'Data harus memiliki setidaknya :min item.',
		'file' => 'Data harus minimal :min kilobyte.',
		'numeric' => 'Data harus minimal :min.',
		'string' => 'Data harus minimal :min karakter.',
	],
	'min_digits' => 'Data harus memiliki setidaknya :min digit.',
	'missing' => 'Data harus hilang.',
	'missing_if' => 'Data harus hilang ketika :other bernilai :value.',
	'missing_unless' => 'Data harus hilang kecuali :other adalah :value.',
	'missing_with' => 'Data harus hilang ketika :values ada.',
	'missing_with_all' => 'Data harus hilang ketika :values ada.',
	'multiple_of' => 'Data harus kelipatan dari :value.',
	'not_in' => 'Data yang dipilih tidak valid.',
	'not_regex' => 'Format data tidak valid.',
	'numeric' => 'Data harus berupa angka.',
	'password' => [
		'letters' => 'Password harus mengandung setidaknya satu huruf.',
		'mixed' => 'Password harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
		'numbers' => 'Password harus mengandung setidaknya satu angka.',
		'symbols' => 'Password harus mengandung setidaknya satu simbol.',
		'uncompromised' => 'Password yang diberikan telah muncul dalam kebocoran data. Silakan pilih password yang berbeda.',
	],
	'present' => 'Data harus ada.',
	'prohibited' => 'Kolom dilarang.',
	'prohibited_if' => 'Kolom dilarang bila :other adalah :value.',
	'prohibited_unless' => 'Kolom dilarang kecuali :other ada di :values.',
	'prohibits' => 'Kolom melarang :other untuk ada.',
	'regex' => 'Format data tidak valid.',
	'required' => 'Kolom harus diisi.',
	'required_array_keys' => 'Kolom harus berisi entri untuk: :values.',
	'required_if' => 'Kolom harus diisi bila :other adalah :value.',
	'required_if_accepted' => 'Kolom harus diisi bila :other diterima.',
	'required_unless' => 'Kolom harus diisi kecuali :other ada di :values.',
	'required_with' => 'Kolom harus diisi bila :values ada.',
	'required_with_all' => 'Kolom harus diisi bila :values ada.',
	'required_without' => 'Kolom harus diisi bila :values tidak ada.',
	'required_without_all' => 'Kolom harus diisi bila tidak ada :values yang ada.',
	'same' => 'Data dan :other harus sesuai.',
	'size' => [
		'array' => 'Data harus berisi :size item.',
		'file' => 'Data harus :size kilobyte.',
		'numeric' => 'Data harus :size.',
		'string' => 'Data harus :size karakter.',
	],
	'starts_with' => 'Data harus diawali dengan salah satu dari berikut ini: :values.',
	'string' => 'Data harus string.',
	'timezone' => 'Data harus berupa zona waktu yang valid.',
	'unique' => 'Data telah diambil.',
	'uploaded' => 'Data gagal diupload.',
	'uppercase' => 'Data harus menggunakan huruf kapital.',
	'url' => 'Data harus berupa URL yang valid.',
	'ulid' => 'Data harus berupa ULID yang valid.',
	'uuid' => 'Data harus berupa UUID yang valid.',

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
			'required' => 'Silahkan pilih role terlebih dahulu.',
		],
		'jenis_ps' => [
			'required' => 'Silahkan pilih jenis PS terlebih dahulu.',
		],
		'kab_kota_ps' => [
			'required' => 'Silahkan pilih kabupaten atau kota asal terlebih dahulu.',
		],
		'kecamatan_ps' => [
			'required' => 'Silahkan pilih kecamatan asal terlebih dahulu.',
		],
		'desa_ps' => [
			'required' => 'Silahkan pilih desa asal terlebih dahulu.',
		],
		'kelas' => [
			'required' => 'Silahkan pilih kategori kelas terlebih dahulu.',
		],
		'lembaga_ps' => [
			'required' => 'Silahkan pilih lembaga PS terlebih dahulu.',
		],
		'tahun_sk' => [
			'between' => 'Tahun harus diantara :min dan :max.',
		],
		'lembaga_kups' => [
			'required' => 'Silahkan pilih lembaga KUPS terlebih dahulu.',
		],
		'pendamping' => [
			'required' => 'Silahkan pilih pendamping terlebih dahulu.',
		],
		'user' => [
			'required' => 'Silahkan pilih user terlebih dahulu.',
		],
		'program' => [
			'required' => 'Silahkan pilih program terlebih dahulu.',
		],
		'jenis_file' => [
			'required' => 'Silahkan pilih jenis kelengkapan terlebih dahulu.',
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
