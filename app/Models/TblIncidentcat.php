<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Oct 2017 21:39:31 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblIncidentcat
 * 
 * @property int $incidentcat_id
 * @property string $incidentcat_name
 * @property string $incidentcat_desc
 * @property bool $incidentcat_exists
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_incidents
 *
 * @package App\Models
 */
class TblIncidentcat extends Eloquent
{
	protected $table = 'tbl_incidentcat';
	protected $primaryKey = 'incidentcat_id';
	public $timestamps = false;

	protected $casts = [
		'incidentcat_exists' => 'bool'
	];

	protected $fillable = [
		'incidentcat_name',
		'incidentcat_desc',
		'incidentcat_exists'
	];

	public function tbl_incidents()
	{
		return $this->hasMany(\App\Models\TblIncident::class, 'incident_cat');
	}
}
