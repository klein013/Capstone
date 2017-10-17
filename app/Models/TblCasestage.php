<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:30 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCasestage
 * 
 * @property int $casestage_id
 * @property string $casestage_name
 * @property int $casestage_no
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_hearings
 *
 * @package App\Models
 */
class TblCasestage extends Eloquent
{
	protected $table = 'tbl_casestage';
	protected $primaryKey = 'casestage_id';
	public $timestamps = false;

	protected $casts = [
		'casestage_no' => 'int'
	];

	protected $fillable = [
		'casestage_name',
		'casestage_no'
	];

	public function tbl_hearings()
	{
		return $this->hasMany(\App\Models\TblHearing::class, 'hearing_type');
	}
}
