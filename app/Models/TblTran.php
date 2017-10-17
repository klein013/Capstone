<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblTran
 * 
 * @property int $trans_id
 * @property string $trans_resident
 * @property \Carbon\Carbon $trans_date
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_requests
 *
 * @package App\Models
 */
class TblTran extends Eloquent
{
	protected $primaryKey = 'trans_id';
	public $timestamps = false;

	protected $dates = [
		'trans_date'
	];

	protected $fillable = [
		'trans_resident',
		'trans_date'
	];

	public function tbl_requests()
	{
		return $this->hasMany(\App\Models\TblRequest::class, 'request_transaction');
	}
}
