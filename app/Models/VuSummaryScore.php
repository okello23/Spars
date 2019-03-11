<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class VuSummaryScore extends Model implements AuditableContract
{
    use Auditable;

	protected $table = "vu_summary_scores";


	/**
	* Relationship with districts
	*/
}
