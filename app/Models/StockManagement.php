<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class StockManagement extends Model implements AuditableContract
{
    use Auditable;
 
	protected $table = "stock_management";

	
	/**
	* Relationships
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