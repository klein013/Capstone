<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblClearance
 * 
 * @property int $clearance_id
 * @property string $clearance_type
 * @property string $clearance_desc
 * @property string $clearance_content
 * @property int $clearance_price
 * @property bool $clearance_exists
 * 
 * @property \App\Models\TblPrice $tbl_price
 * @property \App\Models\TblClearancerequirement $tbl_clearancerequirement
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblClearance extends Eloquent
{
	protected $table = 'tbl_clearance';
	protected $primaryKey = 'clearance_id';
	public $timestamps = false;

	protected $casts = [
		'clearance_price' => 'int',
		'clearance_exists' => 'bool'
	];

	protected $fillable = [
		'clearance_type',
		'clearance_desc',
		'clearance_content',
		'clearance_price',
		'clearance_exists'
	];

	public function tbl_price()
	{
		return $this->belongsTo(\App\Models\TblPrice::class, 'clearance_price');
	}

	public function tbl_clearancerequirement()
	{
		return $this->hasOne(\App\Models\TblClearancerequirement::class, 'cr_clearance');
	}

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_clearance');
	}
}
