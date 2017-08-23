<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Aug 2017 05:52:23 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblResidentuser
 * 
 * @property string $resident_username
 * @property string $resident_password
 * @property \Carbon\Carbon $resident_login
 * @property float $resident_long
 * @property float $resident_lat
 * @property string $resident_id
 * 
 * @property \App\Models\TblResident $tbl_resident
 *
 * @package App\Models
 */
class TblResidentuser extends Eloquent
{
	protected $table = 'tbl_residentuser';
	protected $primaryKey = 'resident_username';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resident_long' => 'float',
		'resident_lat' => 'float'
	];

	protected $dates = [
		'resident_login'
	];

	protected $hidden = [
		'resident_password'
	];

	protected $fillable = [
		'resident_password',
		'resident_login',
		'resident_long',
		'resident_lat',
		'resident_id'
	];

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'resident_id');
	}
}
