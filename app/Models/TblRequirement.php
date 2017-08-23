<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Aug 2017 05:52:23 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblRequirement
 * 
 * @property int $requirement_id
 * @property string $requirement_name
 * @property string $requirement_desc
 * @property bool $requirement_exists
 * 
 * @property \App\Models\TblClearancerequirement $tbl_clearancerequirement
 *
 * @package App\Models
 */
class TblRequirement extends Eloquent
{
	protected $table = 'tbl_requirement';
	protected $primaryKey = 'requirement_id';
	public $timestamps = false;

	protected $casts = [
		'requirement_exists' => 'bool'
	];

	protected $fillable = [
		'requirement_name',
		'requirement_desc',
		'requirement_exists'
	];

	public function tbl_clearancerequirement()
	{
		return $this->hasOne(\App\Models\TblClearancerequirement::class, 'cr_requirement');
	}
}
