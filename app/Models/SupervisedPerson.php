<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SupervisedPerson extends Model implements AuditableContract
{
    use Auditable;
 
	protected $table = "spars_supervised";

	
	/**
	* Relationship with districts
	*/

	public function Facility()
	{
		return $this->belongsTo('App\Models\HealthFacility');
	}

	public function Cadre()
	{
		return $this->belongsTo('App\Models\Cadre');
	}
		
}