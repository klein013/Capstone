<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 17 Aug 2017 13:05:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCaseskp
 * 
 * @property int $caseskp_id
 * @property string $caseskp_name
 * @property string $caseskp_desc
 * @property bool $caseskp_exists
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_cases
 *
 * @package App\Models
 */
class TblCaseskp extends Eloquent
{
	protected $table = 'tbl_caseskp';
	protected $primaryKey = 'caseskp_id';
	public $timestamps = false;

	protected $casts = [
		'caseskp_exists' => 'bool'
	];

	protected $fillable = [
		'caseskp_name',
		'caseskp_desc',
		'caseskp_exists'
	];

	public function tbl_cases()
	{
		return $this->hasMany(\App\Models\TblCase::class, 'case_caseskp');
	}
}
