<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
	protected $guarded = [];
	public function user(){
		$this->morphOne('App\User', 'userable');
	}
	public function questions(){
		return $this->hasMany("App\Question");
	}
	public getEmail(){
		return $this->user->email;
	}
    //
}
