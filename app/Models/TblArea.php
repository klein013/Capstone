<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 Aug 2017 14:16:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblArea
 * 
 * @property int $area_id
 * @property string $area_name
 * @property bool $area_exists
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_streets
 *
 * @package App\Models
 */
class TblArea extends Eloquent
{
	protected $table = 'tbl_area';
	protected $primaryKey = 'area_id';
	public $timestamps = false;

	protected $casts = [
		'area_exists' => 'bool'
	];

	protected $fillable = [
		'area_name',
		'area_exists'
	];

	public function tbl_streets()
	{
		return $this->hasMany(\App\Models\TblStreet::class, 'street_area');
	}
}
