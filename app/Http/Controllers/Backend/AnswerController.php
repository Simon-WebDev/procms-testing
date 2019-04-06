<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Board;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AnswerController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $answers = Answer::where(function($query) use($request){
            
             if ($keyword = $request->get('keyword')) {
                 
                 $query->orwhere('body','LIKE','%'.$keyword.'%');
             }

        })
        ->orderBy('id','desc')
        ->paginate($this->limit);
        $answersCount = Answer::count();
        return view('backend.answer.index', compact('answers','answersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createAnswer($id)
    {
        
        $board=Board::findOrFail($id);
        // dd(Auth::user()->unreadNotifications->filter(function ($item) use ($id) {
        //     return $item['data']['board_id'] == $id;
        //     })->all());
        $notif = Auth::user()->unreadNotifications->filter(function ($item) use ($id) {
            return $item['data']['board_id'] == $id;
            })->all();
        if (!empty($notif)) {
            $notif = array_first($notif);
            $notif->read_at = Carbon::now();
            $notif->save();
        }
        

        return view('backend.answer.create',compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
         'body' => 'required'
        ]);
        $input=$request->all();
        $input['user_id'] = Auth::user()->id;
        if (Answer::create($input)) {
            Session::flash('success','작성하였습니다.');
            return redirect()->route('backend.answer.index');
        }
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer=Answer::findOrFail($id);
        return view('backend.answer.edit',compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
         'body' => 'required'
        ]);
        $input=$request->all();
        $answer = Answer::findOrFail($id);
        
        if ($answer->update($input)) {
            Session::flash('success','수정하였습니다.');
            return redirect()->route('backend.answer.index');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        if ($answer->delete()) {
            Session::flash('success','삭제되었습니다.');
            return redirect()->route('backend.answer.index');
        }
        return back();
    }

    public function activeManage(Request $request, $id)
    {
        if ( Answer::findOrFail($id)->update($request->all())) {
                   return redirect()->back();
         }
    }
}
