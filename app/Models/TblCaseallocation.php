<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:35 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCaseallocation
 * 
 * @property int $caseallocation_case
 * @property int $caseallocation_official
 * @property int $caseallocation_pangkat
 * 
 * @property \App\Models\TblCase $tbl_case
 * @property \App\Models\TblOfficial $tbl_official
 * @property \App\Models\TblPangkat $tbl_pangkat
 *
 * @package App\Models
 */
class TblCaseallocation extends Eloquent
{
	protected $table = 'tbl_caseallocation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'caseallocation_case' => 'int',
		'caseallocation_official' => 'int',
		'caseallocation_pangkat' => 'int'
	];

	protected $fillable = [
		'caseallocation_case',
		'caseallocation_official',
		'caseallocation_pangkat'
	];

	public function tbl_case()
	{
		return $this->belongsTo(\App\Models\TblCase::class, 'caseallocation_case');
	}

	public function tbl_official()
	{
		return $this->belongsTo(\App\Models\TblOfficial::class, 'caseallocation_official');
	}

	public function tbl_pangkat()
	{
		return $this->belongsTo(\App\Models\TblPangkat::class, 'caseallocation_pangkat');
	}
}
