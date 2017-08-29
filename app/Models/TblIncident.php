<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Aug 2017 07:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblIncident
 * 
 * @property int $incident_id
 * @property \Carbon\Carbon $incident_datetime
 * @property string $incident_statement
 * @property int $incident_street
 * @property float $incident_long
 * @property float $incident_lat
 * @property int $incident_cat
 * @property string $incident_status
 * @property string $incident_notes
 * @property \Carbon\Carbon $incident_filed
 * @property bool $incident_exists
 * 
 * @property \App\Models\TblIncidentcat $tbl_incidentcat
 * @property \App\Models\TblStreet $tbl_street
 * @property \App\Models\TblResidentreportedincident $tbl_residentreportedincident
 *
 * @package App\Models
 */
class TblIncident extends Eloquent
{
	protected $table = 'tbl_incident';
	protected $primaryKey = 'incident_id';
	public $timestamps = false;

	protected $casts = [
		'incident_street' => 'int',
		'incident_long' => 'float',
		'incident_lat' => 'float',
		'incident_cat' => 'int',
		'incident_exists' => 'bool'
	];

	protected $dates = [
		'incident_datetime',
		'incident_filed'
	];

	protected $fillable = [
		'incident_datetime',
		'incident_statement',
		'incident_street',
		'incident_long',
		'incident_lat',
		'incident_cat',
		'incident_status',
		'incident_notes',
		'incident_filed',
		'incident_exists'
	];

	public function tbl_incidentcat()
	{
		return $this->belongsTo(\App\Models\TblIncidentcat::class, 'incident_cat');
	}

	public function tbl_street()
	{
		return $this->belongsTo(\App\Models\TblStreet::class, 'incident_street');
	}

	public function tbl_residentreportedincident()
	{
		return $this->hasOne(\App\Models\TblResidentreportedincident::class, 'incident_id');
	}
}
