<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 Aug 2017 06:24:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblMinute
 * 
 * @property int $minutes_id
 * @property int $minutes_hearing
 * @property string $minutes_details
 * 
 * @property \App\Models\TblHearing $tbl_hearing
 *
 * @package App\Models
 */
class TblMinute extends Eloquent
{
	protected $primaryKey = 'minutes_id';
	public $timestamps = false;

	protected $casts = [
		'minutes_hearing' => 'int'
	];

	protected $fillable = [
		'minutes_hearing',
		'minutes_details'
	];

	public function tbl_hearing()
	{
		return $this->belongsTo(\App\Models\TblHearing::class, 'minutes_hearing');
	}
}
