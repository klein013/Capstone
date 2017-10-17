<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Oct 2017 19:28:36 +0800.
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
