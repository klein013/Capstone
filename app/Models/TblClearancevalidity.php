<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblClearancevalidity
 * 
 * @property int $validity_id
 * @property int $clearance_id
 * @property int $validity_no
 * @property string $validity_unit
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblClearancevalidity extends Eloquent
{
	protected $table = 'tbl_clearancevalidity';
	protected $primaryKey = 'validity_id';

	protected $casts = [
		'clearance_id' => 'int',
		'validity_no' => 'int'
	];

	protected $fillable = [
		'clearance_id',
		'validity_no',
		'validity_unit'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'clearance_id');
	}

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_validity');
	}
}
