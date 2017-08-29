<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblOfficial
 * 
 * @property int $official_id
 * @property string $resident_id
 * @property int $position_id
 * @property bool $official_exists
 * 
 * @property \App\Models\TblPosition $tbl_position
 * @property \App\Models\TblResident $tbl_resident
 * @property \App\Models\TblCaseallocation $tbl_caseallocation
 * @property \Illuminate\Database\Eloquent\Collection $tbl_officialusers
 *
 * @package App\Models
 */
class TblOfficial extends Eloquent
{
	protected $table = 'tbl_official';
	protected $primaryKey = 'official_id';
	public $timestamps = false;

	protected $casts = [
		'position_id' => 'int',
		'official_exists' => 'bool'
	];

	protected $fillable = [
		'resident_id',
		'position_id',
		'official_exists'
	];

	public function tbl_position()
	{
		return $this->belongsTo(\App\Models\TblPosition::class, 'position_id');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'resident_id');
	}

	public function tbl_caseallocation()
	{
		return $this->hasOne(\App\Models\TblCaseallocation::class, 'caseallocation_official');
	}

	public function tbl_officialusers()
	{
		return $this->hasMany(\App\Models\TblOfficialuser::class, 'official_id');
	}
}
