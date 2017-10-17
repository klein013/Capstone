<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblResidentreportedincident
 * 
 * @property string $resident_id
 * @property int $incident_id
 * 
 * @property \App\Models\TblIncident $tbl_incident
 * @property \App\Models\TblResident $tbl_resident
 *
 * @package App\Models
 */
class TblResidentreportedincident extends Eloquent
{
	protected $table = 'tbl_residentreportedincident';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'incident_id' => 'int'
	];

	protected $fillable = [
		'resident_id',
		'incident_id'
	];

	public function tbl_incident()
	{
		return $this->belongsTo(\App\Models\TblIncident::class, 'incident_id');
	}

	public function tbl_resident()
	{
		return $this->belongsTo(\App\Models\TblResident::class, 'resident_id');
	}
}
