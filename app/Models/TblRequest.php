<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblRequest
 * 
 * @property int $request_id
 * @property string $request_resident
 * @property string $request_purpose
 * @property string $request_status
 * @property \Carbon\Carbon $request_paymentdate
 * @property int $request_transaction
 * @property int $request_validity
 * @property int $request_content
 * @property int $request_price
 * @property \Carbon\Carbon $request_issuedate
 * @property int $request_captain
 * 
 * @property \App\Models\TblOfficial $tbl_official
 * @property \App\Models\TblClearancecontent $tbl_clearancecontent
 * @property \App\Models\TblPrice $tbl_price
 * @property \App\Models\TblResident $tbl_resident
 * @property \App\Models\TblTran $tbl_tran
 * @property \App\Models\TblClearancevalidity $tbl_clearancevalidity
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
		'request_transaction' => 'int',
		'request_validity' => 'int',
		'request_content' => 'int',
		'request_price' => 'int',
		'request_captain' => 'int'
	];

	protected $dates = [
		'request_paymentdate',
		'request_issuedate'
	];

	protected $fillable = [
		'request_resident',
		'request_purpose',
		'request_status',
		'request_paymentdate',
		'request_transaction',
		'request_validity',
		'request_content',
		'request_price',
		'request_issuedate',
		'request_captain'
	];

	public function tbl_official()
	{
		return $this->belongsTo(\App\Models\TblOfficial::class, 'request_captain');
	}

	public function tbl_clearancecontent()
	{
		return $this->belongsTo(\App\Models\TblClearancecontent::class, 'request_content');
	}

	public function tbl_price()
	{
		return $this->belongsTo(\App\Models\TblPrice::class, 'request_price');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'request_resident');
	}

	public function tbl_tran()
	{
		return $this->belongsTo(\App\Models\TblTran::class, 'request_transaction');
	}

	public function tbl_clearancevalidity()
	{
		return $this->belongsTo(\App\Models\TblClearancevalidity::class, 'request_validity');
	}

	public function tbl_submittedrequirement()
	{
		return $this->hasOne(\App\Models\TblSubmittedrequirement::class, 'sr_request');
	}
}
