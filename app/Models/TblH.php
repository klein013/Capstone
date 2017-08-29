<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblH
 * 
 * @property int $hs_id
 * @property string $hs_name
 * @property string $hs_desc
 * @property \Carbon\Carbon $hs_fromdate
 * @property \Carbon\Carbon $hs_todate
 * @property string $hs_suspendedwork
 * @property int $hs_office
 * 
 * @property \App\Models\TblOffice $tbl_office
 *
 * @package App\Models
 */
class TblH extends Eloquent
{
	protected $primaryKey = 'hs_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'hs_id' => 'int',
		'hs_office' => 'int'
	];

	protected $dates = [
		'hs_fromdate',
		'hs_todate'
	];

	protected $fillable = [
		'hs_name',
		'hs_desc',
		'hs_fromdate',
		'hs_todate',
		'hs_suspendedwork',
		'hs_office'
	];

	public function tbl_office()
	{
		return $this->belongsTo(\App\Models\TblOffice::class, 'hs_office');
	}
}
