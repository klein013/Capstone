<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblClearancecontent
 * 
 * @property int $content_id
 * @property int $clearance_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\TblClearance $tbl_clearance
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblClearancecontent extends Eloquent
{
	protected $table = 'tbl_clearancecontent';
	protected $primaryKey = 'content_id';

	protected $casts = [
		'clearance_id' => 'int'
	];

	protected $fillable = [
		'clearance_id',
		'content'
	];

	public function tbl_clearance()
	{
		return $this->belongsTo(\App\Models\TblClearance::class, 'clearance_id');
	}

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_content');
	}
}
