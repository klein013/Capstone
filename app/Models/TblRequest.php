<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 15 Aug 2017 14:52:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblRequest
 * 
 * @property int $request_id
 * @property int $request_resident
 * @property int $request_clearance
 * @property string $request_purpose
 * @property \Carbon\Carbon $request_date
 * @property \Carbon\Carbon $request_expiry
 * @property string $request_status
 * @property string $request_doc
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \App\Models\TblResident $tbl_resident
 *
 * @package App\Models
 */
class TblRequest extends Eloquent
{
	protected $table = 'tbl_request';
	protected $primaryKey = 'request_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'request_id' => 'int',
		'request_resident' => 'int',
		'request_clearance' => 'int'
	];

	protected $dates = [
		'request_date',
		'request_expiry'
	];

	protected $fillable = [
		'request_resident',
		'request_clearance',
		'request_purpose',
		'request_date',
		'request_expiry',
		'request_status',
		'request_doc'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'request_clearance');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'request_resident');
	}
}
