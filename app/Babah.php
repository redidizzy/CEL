<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Babah extends Model
{
	protected $table = "parents";
	public function children(){
		return $this->hasMany('App\Child');
	}
	public function user(){
		return $this->morphOne('App\User', 'userable');
	}
    //
}
