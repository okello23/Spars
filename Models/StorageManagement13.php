<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class StorageManagement13 extends Model implements AuditableContract
{
    use Auditable;
 
	protected $table = "spars_storage_management_13";

	
	/**
	* Relationship with districts
	*/

	public function Facility()
	{
		return $this->belongsTo('App\Models\HealthFacility');
	}

	public function SurveySummary()
	{
		return $this->belongsTo('App\Models\SurveySummary');
	}
		
}