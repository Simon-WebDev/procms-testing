<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Session;


class CommentController extends BackendController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::where(function($query) use($request){
            
             if ($keyword = $request->get('keyword')) {
                 
                 $query->orwhere('body','LIKE','%'.$keyword.'%');
             }

        })
        ->orderBy('id','desc')
        ->paginate($this->limit);
        $commentsCount = Comment::count();
        return view('backend.comment.index', compact('comments','commentsCount'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $comment=Comment::findOrFail($id);
        return view('backend.comment.edit',compact('comment'));
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
        $comment = Comment::findOrFail($id);
        
        if ($comment->update($input)) {
            Session::flash('success','수정하였습니다.');
            return redirect()->route('backend.comment.index');
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
        $comment = Comment::findOrFail($id);
        if ($comment->delete()) {
            Session::flash('success','삭제되었습니다.');
            return redirect()->route('backend.comment.index');
        }
        return back();
    }

    public function activeManage(Request $request, $id)
    {
        if ( Comment::findOrFail($id)->update($request->all())) {
                   return redirect()->back();
         }
    }
}
