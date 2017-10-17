<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblH
 * 
 * @property int $hs_id
 * @property string $hs_name
 * @property string $hs_desc
 * @property \Carbon\Carbon $created_at
 *
 * @package App\Models
 */
class TblH extends Eloquent
{
	protected $primaryKey = 'hs_id';
	public $timestamps = false;

	protected $fillable = [
		'hs_name',
		'hs_desc'
	];
}
