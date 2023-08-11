<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'types';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $guarded = [
		'type'
	];
}
