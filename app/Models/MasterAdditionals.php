<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAdditionals extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'master_additionals';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'jenis',
		'deskripsi',
		'urutan',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
