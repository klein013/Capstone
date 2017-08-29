<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPrice
 * 
 * @property int $price_id
 * @property \Carbon\Carbon $price_date
 * @property float $price_amt
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_clearances
 *
 * @package App\Models
 */
class TblPrice extends Eloquent
{
	protected $table = 'tbl_price';
	protected $primaryKey = 'price_id';
	public $timestamps = false;

	protected $casts = [
		'price_amt' => 'float'
	];

	protected $dates = [
		'price_date'
	];

	protected $fillable = [
		'price_date',
		'price_amt'
	];

	public function tbl_clearances()
	{
		return $this->hasMany(\App\Models\TblClearance::class, 'clearance_price');
	}
}
