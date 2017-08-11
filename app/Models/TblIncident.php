<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 Aug 2017 14:16:29 +0000.
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
 * 
 * @property \App\Models\TblIncidentcat $tbl_incidentcat
 * @property \App\Models\TblStreet $tbl_street
 *
 * @package App\Models
 */
class TblIncident extends Eloquent
{
	protected $table = 'tbl_incident';
	protected $primaryKey = 'incident_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'incident_id' => 'int',
		'incident_street' => 'int',
		'incident_long' => 'float',
		'incident_lat' => 'float',
		'incident_cat' => 'int'
	];

	protected $dates = [
		'incident_datetime'
	];

	protected $fillable = [
		'incident_datetime',
		'incident_statement',
		'incident_street',
		'incident_long',
		'incident_lat',
		'incident_cat',
		'incident_status'
	];

	public function tbl_incidentcat()
	{
		return $this->belongsTo(\App\Models\TblIncidentcat::class, 'incident_cat');
	}

	public function tbl_street()
	{
		return $this->belongsTo(\App\Models\TblStreet::class, 'incident_street');
	}
}
