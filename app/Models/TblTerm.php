<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Oct 2017 07:02:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblTerm
 * 
 * @property int $id
 * @property \Carbon\Carbon $startofterm
 * @property \Carbon\Carbon $endofterm
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_officials
 *
 * @package App\Models
 */
class TblTerm extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'startofterm',
		'endofterm'
	];

	protected $fillable = [
		'startofterm',
		'endofterm'
	];

	public function tbl_officials()
	{
		return $this->hasMany(\App\Models\TblOfficial::class, 'term_id');
	}
}
