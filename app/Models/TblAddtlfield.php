<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:30 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblAddtlfield
 * 
 * @property int $field_id
 * @property string $field_label
 * @property string $field_type
 * @property string $field_name
 * @property int $clearance_id
 *
 * @package App\Models
 */
class TblAddtlfield extends Eloquent
{
	protected $table = 'tbl_addtlfield';
	protected $primaryKey = 'field_id';
	public $timestamps = false;

	protected $casts = [
		'clearance_id' => 'int'
	];

	protected $fillable = [
		'field_label',
		'field_type',
		'field_name',
		'clearance_id'
	];
}
