<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
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
