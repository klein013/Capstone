<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Aug 2017 05:52:22 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblBrgyinfo
 * 
 * @property string $brgyinfo_name
 * @property string $brgyinfo_website
 * @property string $brgyinfo_email
 * @property string $brgyinfo_fb
 * @property string $brgyinfo_logo
 * @property string $brgyinfo_case
 * @property \Carbon\Carbon $brgyinfo_opening
 * @property \Carbon\Carbon $brgyinfo_closing
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_offices
 *
 * @package App\Models
 */
class TblBrgyinfo extends Eloquent
{
	protected $table = 'tbl_brgyinfo';
	protected $primaryKey = 'brgyinfo_name';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'brgyinfo_opening',
		'brgyinfo_closing'
	];

	protected $fillable = [
		'brgyinfo_website',
		'brgyinfo_email',
		'brgyinfo_fb',
		'brgyinfo_logo',
		'brgyinfo_case',
		'brgyinfo_opening',
		'brgyinfo_closing'
	];

	public function tbl_offices()
	{
		return $this->hasMany(\App\Models\TblOffice::class, 'office_brgy');
	}
}
