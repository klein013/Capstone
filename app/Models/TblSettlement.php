<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Aug 2017 16:04:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblSettlement
 * 
 * @property int $settlement_id
 * @property int $settlement_hearing
 * @property \Carbon\Carbon $settlement_datetime
 * @property string $settlement_details
 * 
 * @property \App\Models\TblHearing $tbl_hearing
 *
 * @package App\Models
 */
class TblSettlement extends Eloquent
{
	protected $table = 'tbl_settlement';
	protected $primaryKey = 'settlement_id';
	public $timestamps = false;

	protected $casts = [
		'settlement_hearing' => 'int'
	];

	protected $dates = [
		'settlement_datetime'
	];

	protected $fillable = [
		'settlement_hearing',
		'settlement_datetime',
		'settlement_details'
	];

	public function tbl_hearing()
	{
		return $this->belongsTo(\App\Models\TblHearing::class, 'settlement_hearing');
	}
}
