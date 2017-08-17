<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 17 Aug 2017 13:05:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCase
 * 
 * @property int $case_id
 * @property \Carbon\Carbon $case_filed
 * @property int $case_caseskp
 * @property string $case_statement
 * @property string $case_status
 * @property bool $case_exists
 * 
 * @property \App\Models\TblCaseskp $tbl_caseskp
 * @property \App\Models\TblCaseallocation $tbl_caseallocation
 * @property \Illuminate\Database\Eloquent\Collection $tbl_hearings
 * @property \App\Models\TblPersoninvolve $tbl_personinvolve
 *
 * @package App\Models
 */
class TblCase extends Eloquent
{
	protected $table = 'tbl_case';
	protected $primaryKey = 'case_id';
	public $timestamps = false;

	protected $casts = [
		'case_caseskp' => 'int',
		'case_exists' => 'bool'
	];

	protected $dates = [
		'case_filed'
	];

	protected $fillable = [
		'case_filed',
		'case_caseskp',
		'case_statement',
		'case_status',
		'case_exists'
	];

	public function tbl_caseskp()
	{
		return $this->belongsTo(\App\Models\TblCaseskp::class, 'case_caseskp');
	}

	public function tbl_caseallocation()
	{
		return $this->hasOne(\App\Models\TblCaseallocation::class, 'caseallocation_case');
	}

	public function tbl_hearings()
	{
		return $this->hasMany(\App\Models\TblHearing::class, 'hearing_case');
	}

	public function tbl_personinvolve()
	{
		return $this->hasOne(\App\Models\TblPersoninvolve::class, 'personinvolve_case');
	}
}
