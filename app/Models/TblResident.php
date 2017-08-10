<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Aug 2017 16:04:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblResident
 * 
 * @property int $resident_id
 * @property string $resident_fname
 * @property string $resident_mname
 * @property string $resident_lname
 * @property \Carbon\Carbon $resident_bdate
 * @property string $resident_gender
 * @property string $resident_contact
 * @property string $resident_hno
 * @property int $resident_street
 * @property int $resident_yearstayed
 * @property string $resident_image
 * @property bool $resident_exists
 * 
 * @property \App\Models\TblStreet $tbl_street
 * @property \Illuminate\Database\Eloquent\Collection $tbl_officials
 * @property \App\Models\TblPersoninvolve $tbl_personinvolve
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblResident extends Eloquent
{
	protected $table = 'tbl_resident';
	protected $primaryKey = 'resident_id';
	public $timestamps = false;

	protected $casts = [
		'resident_street' => 'int',
		'resident_yearstayed' => 'int',
		'resident_exists' => 'bool'
	];

	protected $dates = [
		'resident_bdate'
	];

	protected $fillable = [
		'resident_fname',
		'resident_mname',
		'resident_lname',
		'resident_bdate',
		'resident_gender',
		'resident_contact',
		'resident_hno',
		'resident_street',
		'resident_yearstayed',
		'resident_image',
		'resident_exists'
	];

	public function tbl_street()
	{
		return $this->belongsTo(\App\Models\TblStreet::class, 'resident_street');
	}

	public function tbl_officials()
	{
		return $this->hasMany(\App\Models\TblOfficial::class, 'resident_id');
	}

	public function tbl_personinvolve()
	{
		return $this->hasOne(\App\Models\TblPersoninvolve::class, 'personinvolve_resident');
	}

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_resident');
	}
}
