<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPangkat
 * 
 * @property int $pangkat_id
 * @property int $pangkat_president
 * @property int $pangkat_secretary
 * @property int $pangkat_member
 * 
 * @property \App\Models\TblCaseallocation $tbl_caseallocation
 *
 * @package App\Models
 */
class TblPangkat extends Eloquent
{
	protected $table = 'tbl_pangkat';
	protected $primaryKey = 'pangkat_id';
	public $timestamps = false;

	protected $casts = [
		'pangkat_president' => 'int',
		'pangkat_secretary' => 'int',
		'pangkat_member' => 'int'
	];

	protected $hidden = [
		'pangkat_secretary'
	];

	protected $fillable = [
		'pangkat_president',
		'pangkat_secretary',
		'pangkat_member'
	];

	public function tbl_caseallocation()
	{
		return $this->hasOne(\App\Models\TblCaseallocation::class, 'caseallocation_pangkat');
	}
}
