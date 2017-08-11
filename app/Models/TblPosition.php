<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 Aug 2017 14:16:30 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPosition
 * 
 * @property int $position_id
 * @property string $position_name
 * @property string $position_desc
 * @property int $position_count
 * @property string $position_manage
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_officials
 *
 * @package App\Models
 */
class TblPosition extends Eloquent
{
	protected $table = 'tbl_position';
	protected $primaryKey = 'position_id';
	public $timestamps = false;

	protected $casts = [
		'position_count' => 'int'
	];

	protected $fillable = [
		'position_name',
		'position_desc',
		'position_count',
		'position_manage'
	];

	public function tbl_officials()
	{
		return $this->hasMany(\App\Models\TblOfficial::class, 'position_id');
	}
}
