<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Aug 2017 05:52:23 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblRequest
 * 
 * @property int $request_id
 * @property string $request_resident
 * @property int $request_clearance
 * @property string $request_purpose
 * @property \Carbon\Carbon $request_expiry
 * @property string $request_status
 * @property string $request_doc
 * @property int $request_transaction
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \App\Models\TblResident $tbl_resident
 * @property \App\Models\TblTran $tbl_tran
 * @property \App\Models\TblSubmittedrequirement $tbl_submittedrequirement
 *
 * @package App\Models
 */
class TblRequest extends Eloquent
{
	protected $table = 'tbl_request';
	protected $primaryKey = 'request_id';
	public $timestamps = false;

	protected $casts = [
		'request_clearance' => 'int',
		'request_transaction' => 'int'
	];

	protected $dates = [
		'request_expiry'
	];

	protected $fillable = [
		'request_resident',
		'request_clearance',
		'request_purpose',
		'request_expiry',
		'request_status',
		'request_doc',
		'request_transaction'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'request_clearance');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'request_resident');
	}

	public function tbl_tran()
	{
		return $this->belongsTo(\App\Models\TblTran::class, 'request_transaction');
	}

	public function tbl_submittedrequirement()
	{
		return $this->hasOne(\App\Models\TblSubmittedrequirement::class, 'sr_request');
	}
}
