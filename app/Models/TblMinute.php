<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblMinute
 * 
 * @property int $minutes_id
 * @property int $minutes_hearing
 * @property string $minutes_details
 * @property \Carbon\Carbon $minutes_start
 * @property \Carbon\Carbon $minutes_end
 * @property \Carbon\Carbon $minutes_timerendered
 * @property int $minutes_official
 * 
 * @property \App\Models\TblHearing $tbl_hearing
 * @property \App\Models\TblOfficial $tbl_official
 *
 * @package App\Models
 */
class TblMinute extends Eloquent
{
	protected $primaryKey = 'minutes_id';
	public $timestamps = false;

	protected $casts = [
		'minutes_hearing' => 'int',
		'minutes_official' => 'int'
	];

	protected $dates = [
		'minutes_start',
		'minutes_end',
		'minutes_timerendered'
	];

	protected $fillable = [
		'minutes_hearing',
		'minutes_details',
		'minutes_start',
		'minutes_end',
		'minutes_timerendered',
		'minutes_official'
	];

	public function tbl_hearing()
	{
		return $this->belongsTo(\App\Models\TblHearing::class, 'minutes_hearing');
	}

	public function tbl_official()
	{
		return $this->belongsTo(\App\Models\TblOfficial::class, 'minutes_official');
	}
}
