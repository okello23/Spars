<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    //
	
	/**
	* Relationships
	*/

	public function User()
	{
		return $this->belongsTo('App\User');
	}

}
