<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
	protected $guarded = [];
	public function user(){
		$this->morphOne('App\User', 'userable');
	}
    //
}
