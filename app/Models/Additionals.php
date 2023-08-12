<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Additionals extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'additionals';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'file_type',
		'file',
		'tanggal',
		'deskripsi',
		'approval',
		'note',
		'usulan_id',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get usulan associated with additionals.
	 */
	public function usulan(): HasOne
	{
		return $this->hasOne(Usulan::class);
	}

	/**
	 * Get master_additionals associated with additionals.
	 */
	public function extra(): HasOne
	{
		return $this->hasOne(MasterAdditionals::class);
	}
}
