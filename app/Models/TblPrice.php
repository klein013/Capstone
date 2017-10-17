<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPrice
 * 
 * @property int $price_id
 * @property int $clearance_id
 * @property float $price_amt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblPrice extends Eloquent
{
	protected $table = 'tbl_price';
	protected $primaryKey = 'price_id';

	protected $casts = [
		'clearance_id' => 'int',
		'price_amt' => 'float'
	];

	protected $fillable = [
		'clearance_id',
		'price_amt'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'clearance_id');
	}

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_price');
	}
}
