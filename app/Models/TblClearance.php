<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:30 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblClearance
 * 
 * @property int $clearance_id
 * @property string $clearance_name
 * @property string $clearance_desc
 * @property bool $clearance_exists
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_clearancecontents
 * @property \App\Models\TblClearancerequirement $tbl_clearancerequirement
 * @property \Illuminate\Database\Eloquent\Collection $tbl_clearancevalidities
 * @property \Illuminate\Database\Eloquent\Collection $tbl_prices
 *
 * @package App\Models
 */
class TblClearance extends Eloquent
{
	protected $table = 'tbl_clearance';
	protected $primaryKey = 'clearance_id';

	protected $casts = [
		'clearance_exists' => 'bool'
	];

	protected $fillable = [
		'clearance_name',
		'clearance_desc',
		'clearance_exists'
	];

	public function tbl_clearancecontents()
	{
		return $this->hasMany(\App\Models\TblClearancecontent::class, 'clearance_id');
	}

	public function tbl_clearancerequirement()
	{
		return $this->hasOne(\App\Models\TblClearancerequirement::class, 'cr_clearance');
	}

	public function tbl_clearancevalidities()
	{
		return $this->hasMany(\App\Models\TblClearancevalidity::class, 'clearance_id');
	}

	public function tbl_prices()
	{
		return $this->hasMany(\App\Models\TblPrice::class, 'clearance_id');
	}
}
