<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblClearancerequirement
 * 
 * @property int $cr_requirement
 * @property int $cr_clearance
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \App\Models\TblRequirement $tbl_requirement
 * @property \App\Models\TblSubmittedrequirement $tbl_submittedrequirement
 *
 * @package App\Models
 */
class TblClearancerequirement extends Eloquent
{
	protected $table = 'tbl_clearancerequirement';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cr_requirement' => 'int',
		'cr_clearance' => 'int'
	];

	protected $fillable = [
		'cr_requirement',
		'cr_clearance'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'cr_clearance');
	}

	public function tbl_requirement()
	{
		return $this->belongsTo(\App\Models\TblRequirement::class, 'cr_requirement');
	}

	public function tbl_submittedrequirement()
	{
		return $this->hasOne(\App\Models\TblSubmittedrequirement::class, 'sr_cr', 'cr_requirement');
	}
}
