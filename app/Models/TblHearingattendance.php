<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Aug 2017 16:04:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblHearingattendance
 * 
 * @property int $ha_hearing
 * @property int $ha_personinvolve
 * @property bool $ha_attented
 * 
 * @property \App\Models\TblHearing $tbl_hearing
 * @property \App\Models\TblPersoninvolve $tbl_personinvolve
 *
 * @package App\Models
 */
class TblHearingattendance extends Eloquent
{
	protected $table = 'tbl_hearingattendance';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ha_hearing' => 'int',
		'ha_personinvolve' => 'int',
		'ha_attented' => 'bool'
	];

	protected $fillable = [
		'ha_hearing',
		'ha_personinvolve',
		'ha_attented'
	];

	public function tbl_hearing()
	{
		return $this->belongsTo(\App\Models\TblHearing::class, 'ha_hearing');
	}

	public function tbl_personinvolve()
	{
		return $this->belongsTo(\App\Models\TblPersoninvolve::class, 'ha_personinvolve', 'personinvolve_resident');
	}
}
