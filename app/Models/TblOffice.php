<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 Aug 2017 14:16:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblOffice
 * 
 * @property int $office_id
 * @property int $office_name
 * @property int $office_hno
 * @property int $office_street
 * @property string $office_brgy
 * 
 * @property \App\Models\TblBrgyinfo $tbl_brgyinfo
 * @property \App\Models\TblStreet $tbl_street
 * @property \Illuminate\Database\Eloquent\Collection $tbl_hs
 *
 * @package App\Models
 */
class TblOffice extends Eloquent
{
	protected $table = 'tbl_office';
	protected $primaryKey = 'office_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'office_id' => 'int',
		'office_name' => 'int',
		'office_hno' => 'int',
		'office_street' => 'int'
	];

	protected $fillable = [
		'office_name',
		'office_hno',
		'office_street',
		'office_brgy'
	];

	public function tbl_brgyinfo()
	{
		return $this->belongsTo(\App\Models\TblBrgyinfo::class, 'office_brgy');
	}

	public function tbl_street()
	{
		return $this->belongsTo(\App\Models\TblStreet::class, 'office_street');
	}

	public function tbl_hs()
	{
		return $this->hasMany(\App\Models\TblH::class, 'hs_office');
	}
}
