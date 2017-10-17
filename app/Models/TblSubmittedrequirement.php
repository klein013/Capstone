<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblSubmittedrequirement
 * 
 * @property int $sr_request
 * @property int $sr_cr
 * @property bool $sr_stat
 * 
 * @property \App\Models\TblClearancerequirement $tbl_clearancerequirement
 * @property \App\Models\TblRequest $tbl_request
 *
 * @package App\Models
 */
class TblSubmittedrequirement extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'sr_request' => 'int',
		'sr_cr' => 'int',
		'sr_stat' => 'bool'
	];

	protected $fillable = [
		'sr_request',
		'sr_cr',
		'sr_stat'
	];

	public function tbl_clearancerequirement()
	{
		return $this->belongsTo(\App\Models\TblClearancerequirement::class, 'sr_cr', 'cr_requirement');
	}

	public function tbl_request()
	{
		return $this->belongsTo(\App\Models\TblRequest::class, 'sr_request');
	}
}
