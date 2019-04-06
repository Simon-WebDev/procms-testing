<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
        
    }
    
    public function store(Request $request)
    {
    	$this->validate($request,[
    	 'body' => 'required'
    	]);
    	$input=$request->all();
    	$input['user_id'] = Auth::user()->id;
    	if (Answer::create($input)) {
    	    Session::flash('success','작성하였습니다.');
    	    return redirect()->back();
    	}
    	return back()->withInput();
    }

    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        if ($answer->delete()) {
            Session::flash('success','삭제되었습니다.');
            return back();
        }
        return back();
    }
}
