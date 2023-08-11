<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usulan extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'usulan';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'applicant_name',
		'proposal_sp_num',
		'proposal_date',
		'budget',
		'status',
		'proposal',
		'longitude',
		'latitude',
		'program_id',
		'kups_id',
		'user_id',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get the programs that owns usulan.
	 */
	public function programs(): BelongsTo
	{
		return $this->belongsTo(Programs::class);
	}

	/**
	 * Get the KUPS that owns usulan.
	 */
	public function kups(): BelongsTo
	{
		return $this->belongsTo(LembagaKUPS::class);
	}
}
