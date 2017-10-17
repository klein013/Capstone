<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:30 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblBrgyinfo
 * 
 * @property string $brgyinfo_name
 * @property string $brgyinfo_city
 * @property string $brgyinfo_region
 * @property string $brgyinfo_website
 * @property string $brgyinfo_email
 * @property string $brgyinfo_fb
 * @property string $brgyinfo_logo
 * @property string $brgyinfo_citylogo
 * @property string $brgyinfo_case
 * @property \Carbon\Carbon $brgyinfo_opening
 * @property \Carbon\Carbon $brgyinfo_closing
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
		'brgyinfo_city',
		'brgyinfo_region',
		'brgyinfo_website',
		'brgyinfo_email',
		'brgyinfo_fb',
		'brgyinfo_logo',
		'brgyinfo_citylogo',
		'brgyinfo_case',
		'brgyinfo_opening',
		'brgyinfo_closing'
	];
}
