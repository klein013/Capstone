<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPersoninvolve
 * 
 * @property string $personinvolve_resident
 * @property int $personinvolve_case
 * @property string $personinvolve_type
 * 
 * @property \App\Models\TblCase $tbl_case
 * @property \App\Models\TblResident $tbl_resident
 * @property \App\Models\TblHearingattendance $tbl_hearingattendance
 * @property \App\Models\TblHearingletter $tbl_hearingletter
 *
 * @package App\Models
 */
class TblPersoninvolve extends Eloquent
{
	protected $table = 'tbl_personinvolve';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'personinvolve_case' => 'int'
	];

	protected $fillable = [
		'personinvolve_resident',
		'personinvolve_case',
		'personinvolve_type'
	];

	public function tbl_case()
	{
		return $this->belongsTo(\App\Models\TblCase::class, 'personinvolve_case');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'personinvolve_resident');
	}

	public function tbl_hearingattendance()
	{
		return $this->hasOne(\App\Models\TblHearingattendance::class, 'ha_personinvolve', 'personinvolve_resident');
	}

	public function tbl_hearingletter()
	{
		return $this->hasOne(\App\Models\TblHearingletter::class, 'hl_personinvolve', 'personinvolve_resident');
	}
}
