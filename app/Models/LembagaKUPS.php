<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LembagaKUPS extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'kups';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'kups_name',
		'kups_sk_num',
		'business_type',
		'comodity',
		'class',
		'kups_chief',
		'kups_contact',
		'ps_id',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get PS that owns KUPS.
	 */
	public function ps(): BelongsTo
	{
		return $this->belongsTo(LembagaPS::class);
	}

	/**
	 * Get the user associated with KUPS.
	 */
	public function user(): HasOne
	{
		return $this->hasOne(User::class);
	}
}
