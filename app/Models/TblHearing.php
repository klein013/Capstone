<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblHearing
 * 
 * @property int $hearing_id
 * @property int $hearing_case
 * @property \Carbon\Carbon $hearing_sched
 * @property int $hearing_type
 * @property string $hearing_status
 * @property bool $hearing_exists
 * 
 * @property \App\Models\TblCase $tbl_case
 * @property \App\Models\TblCasestage $tbl_casestage
 * @property \App\Models\TblHearingattendance $tbl_hearingattendance
 * @property \App\Models\TblHearingletter $tbl_hearingletter
 * @property \Illuminate\Database\Eloquent\Collection $tbl_minutes
 * @property \Illuminate\Database\Eloquent\Collection $tbl_settlements
 *
 * @package App\Models
 */
class TblHearing extends Eloquent
{
	protected $table = 'tbl_hearing';
	protected $primaryKey = 'hearing_id';
	public $timestamps = false;

	protected $casts = [
		'hearing_case' => 'int',
		'hearing_type' => 'int',
		'hearing_exists' => 'bool'
	];

	protected $dates = [
		'hearing_sched'
	];

	protected $fillable = [
		'hearing_case',
		'hearing_sched',
		'hearing_type',
		'hearing_status',
		'hearing_exists'
	];

	public function tbl_case()
	{
		return $this->belongsTo(\App\Models\TblCase::class, 'hearing_case');
	}

	public function tbl_casestage()
	{
		return $this->belongsTo(\App\Models\TblCasestage::class, 'hearing_type');
	}

	public function tbl_hearingattendance()
	{
		return $this->hasOne(\App\Models\TblHearingattendance::class, 'ha_hearing');
	}

	public function tbl_hearingletter()
	{
		return $this->hasOne(\App\Models\TblHearingletter::class, 'hl_hearing');
	}

	public function tbl_minutes()
	{
		return $this->hasMany(\App\Models\TblMinute::class, 'minutes_hearing');
	}

	public function tbl_settlements()
	{
		return $this->hasMany(\App\Models\TblSettlement::class, 'settlement_hearing');
	}
}
