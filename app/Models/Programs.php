<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'programs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'program',
		'program_num',
		'start_date',
		'end_date',
		'kak_date',
		'kak_file',
		'budget_allocation',
		'status',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
