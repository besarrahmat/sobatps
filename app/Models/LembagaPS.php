<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LembagaPS extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'ps';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'ps_name',
		'ps_sk_num',
		'ps_date',
		'area',
		'ps_chief',
		'kk_total',
		'ps_contact',
		'area_function',
		'sk_file',
		'rku_file',
		'rkt_file',
		'shp_file',
		'ps_type_id',
		'region_code',
		'address',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get the types that owns PS.
	 */
	public function types(): BelongsTo
	{
		return $this->belongsTo(Types::class);
	}

	/**
	 * Get the region that owns PS.
	 */
	public function region(): BelongsTo
	{
		return $this->belongsTo(Region::class);
	}
}
