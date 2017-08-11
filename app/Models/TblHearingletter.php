<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 Aug 2017 14:16:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblHearingletter
 * 
 * @property int $hl_hearing
 * @property int $hl_personinvolve
 * @property string $hl_lettertype
 * @property \Carbon\Carbon $hl_datereceive
 * 
 * @property \App\Models\TblHearing $tbl_hearing
 * @property \App\Models\TblPersoninvolve $tbl_personinvolve
 *
 * @package App\Models
 */
class TblHearingletter extends Eloquent
{
	protected $table = 'tbl_hearingletter';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'hl_hearing' => 'int',
		'hl_personinvolve' => 'int'
	];

	protected $dates = [
		'hl_datereceive'
	];

	protected $fillable = [
		'hl_hearing',
		'hl_personinvolve',
		'hl_lettertype',
		'hl_datereceive'
	];

	public function tbl_hearing()
	{
		return $this->belongsTo(\App\Models\TblHearing::class, 'hl_hearing');
	}

	public function tbl_personinvolve()
	{
		return $this->belongsTo(\App\Models\TblPersoninvolve::class, 'hl_personinvolve', 'personinvolve_resident');
	}
}
