<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Child;
use App\Site;
use Carbon\Carbon;

class ChildController extends Controller
{
	public function __construct(){
		$this->middleware('is_a_parent');
	}
	public function index(){
		$children = Child::all();
		return view("babah.index");
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
		return redirect()->route("babah.index")->withMessage("Votre enfant a été crée avec success");
	}
	public function changeChildTimeout(Request $request){
		if(isset($request->id)){
			$child = Child::find($request->id);
			if($child->parent_id == Auth::user()->userable->id){
				$child->timeout = $request->timeout;
				$child->save();
			}
			return redirect()->route("babah.index")->withMessage("Vous avez changé le delai de ".$child->email." a ".$request->timeout);
		}
	}
	public function addForbiddenSites(Request $request){
		if(isset(request)->id && isset(request->url))
		{
			$child= Child::find($request->id);
			$site= Site::create([
	            'url' => $request->url,
	            'child_id' => $child->id
			]);
		}
		return redirect()->route("babah.index")->withMessage("Vous avez ajouté le site ".$request->url." a la liste noir de ".$child->email);	
	}

}
