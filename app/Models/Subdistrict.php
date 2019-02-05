<?php
namespace App\Models;

class Subdistrict extends \Eloquent
{
	protected $table = "subdistricts";

	
	/**
	* Relationship with districts
	*/
	public function District()
	{
		return $this->belongsTo('App\Models\District');
	}
}