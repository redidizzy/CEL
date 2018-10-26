<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Child;
use Carbon\Carbon;

class ChildController extends Controller
{
	public function __construct(){
		$this->middleware('is_a_parent');
	}
	public function addChild(Request $request){
		$parent = Auth::user()->userable;
		$child = Child::create([
			'parent_id' => $parent->id,
			'state' => 0,
			'last_connect' => Carbon::now(),
			'birthdate' => $request->birthdate,
			'timeout' => 60
		]);
		$user = User::create([
			'email' => $request->email,
            'password' => Hash::make($request->passwords]),
            'userable_type' => 'App\Child',
            'userable_id' => $child->id
		]);
		return view('welcome.blade.php');
	}
}
