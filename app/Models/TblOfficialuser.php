<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblOfficialuser
 * 
 * @property int $official_id
 * @property string $official_username
 * @property string $official_password
 * @property bool $official_admin
 * @property \Carbon\Carbon $last_log
 * 
 * @property \App\Models\TblOfficial $tbl_official
 *
 * @package App\Models
 */
class TblOfficialuser extends Eloquent
{
	protected $table = 'tbl_officialuser';
	protected $primaryKey = 'official_username';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'official_id' => 'int',
		'official_admin' => 'bool'
	];

	protected $dates = [
		'last_log'
	];

	protected $hidden = [
		'official_password'
	];

	protected $fillable = [
		'official_id',
		'official_password',
		'official_admin',
		'last_log'
	];

	public function tbl_official()
	{
		return $this->belongsTo(\App\Models\TblOfficial::class, 'official_id');
	}
}
