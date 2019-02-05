<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class General extends Model implements AuditableContract
{
    use Auditable;
 

	protected $table = "spars_general";

	
	/**
	* Relationship with districts
	*/

	public function Facility()
	{
		return $this->belongsTo('App\Models\HealthFacility');
	}

		
}