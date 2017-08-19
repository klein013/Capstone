<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 Aug 2017 06:24:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblResidentSeq
 * 
 * @property int $id
 *
 * @package App\Models
 */
class TblResidentSeq extends Eloquent
{
	protected $table = 'tbl_resident_seq';
	public $timestamps = false;
}
