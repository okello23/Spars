<?php
namespace App\Models;

class Facility extends \Eloquent
{
	protected $table = "facilities";

	
	/**
	* Relationship with districts
	*/
	public function District()
	{
		return $this->belongsTo('App\Models\District');
	}


	/**
	* Relationship with subdistricts
	*/
	public function Subdistrict()
	{
		return $this->belongsTo('App\Models\Subdistrict');
	}

	/**
	* Relationship with ownership
	*/
	public function Ownership()
	{
		return $this->belongsTo('App\Models\Ownership');
	}

	/**
	* Relationship with levels
	*/
	public function Level()
	{
		return $this->belongsTo('App\Models\Level');
	}	
}