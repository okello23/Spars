<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SurveySummary extends \Eloquent implements AuditableContract
{
    use Auditable;

	protected $table = "survey_summary";

	
	/**
	* Relationship with districts
	*/

	public function Facility($id)
	{
		return HealthFacility::find($id);
	//	return $this->belongsTo('App\Models\HealthFacility');
	}


	public function Supervisors($id)
	{

		$supervisors = Supervisor::where('form_id','=',$id)->with('Person')->get();

		$supervisor_list = new \Illuminate\Support\Collection();

		foreach($supervisors as $supervisor)
		{

			$supervisor_list->push($supervisor->person->first_name. ' '.$supervisor->person->last_name.' ('.$supervisor->person->telephone.')' );

		}

		return $supervisor_list;

	//	return $this->belongsTo('App\Models\HealthFacility');
	}


	public function Supervisees($id)
	{

		$supervisees = SupervisedPerson::where('form_id','=',$id)->get();



		$supervisee_list = new \Illuminate\Support\Collection();

		foreach($supervisees as $supervisee)
		{

			$supervisee_list->push($supervisee->name. ' ('.$supervisee->phone_number.')' );

		}
		return $supervisee_list;

	}


}