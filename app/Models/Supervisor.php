<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Supervisor extends Model implements AuditableContract
{
    use Auditable;

	protected $table = "spars_supervisors";

	
	/**
	* Relationship with districts
	*/

	public function Facility()
	{
		return $this->belongsTo('App\Models\HealthFacility');
	}

	public function Person()
	{
		return $this->belongsTo('App\Models\Personnel');
	}
		
}