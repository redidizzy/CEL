<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parent;
use App\Child;
use App\Question;

class QuizController extends Controller
{
	public function __construct(){
		$this->middleware('is_a_parent');
	}
	public function create_question(Request $request){
		$child = Child::find($request->child_id);
		if($child->parent_id == Auth::user()->userable->id){
			Question::create([
				'question' => $request->question,
				'option1' => $request->option1,
				'option2' => $request->option2,
				'option3' => $request->option3,
				'option4' => $request->option4,
				'answer' => $answer,
				'child_id' => $request->child_id
			]);
		}
		return redirect()->route("babah.index")->withMessage("Vous avez crée la question avec succes");
	}
	public function delete_question(Request $request){
		$question = Question::find($request->question_id);
		if($question->child->parent->id == Auth::user()->userable->id){
			$question->delete();
		}
		return redirect()->route("babah.index")->withMessage("Vous avez supprimé la question avec succes");
	} 
	public function show_questions(Request $request){
		$questions = Child::find($request->child_id)->questions()->orderByRaw("RAND()")->limit(10)->get();

		return view("quiz", compact("questions"));
	}
    //
}
