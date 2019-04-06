<?php

namespace App\Http\Controllers;

use App\Board;
use App\Group;
use App\Notifications\NewWriteNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BoardRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    protected $limit=16;

    protected $uploadFolder = 'upload';

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','author','group']]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $groups = Group::with('boards')->orderBy('title','asc')->get();
        $boards = Board::with('user')->where(function($query) use($request){
            //login된 유저가 본인글만 보이게 
            // if (Auth::check()) {
            //    $query->where('user_id',$request->user()->id);
            // }
            
             if ($group_id = ($request->get('group_id'))) {
                 $query->where('group_id', $group_id);
             }
             if ($keyword = $request->get('term')) {
                 
                 $query->orwhere('title','LIKE','%'.$keyword.'%')->orWhere('body','LIKE','%'.$keyword.'%');
             }
        })->where('is_active', 1)->latestFirst()->paginate($this->limit);
        return view('board.index', compact('boards','groups'));
    }

    public function group(Group $group)
    {
        $groupName = $group->title;
        $groups = Group::with('boards')->orderBy('title','asc')->get();
        
        $boards = $group->boards()->with('user')->where('is_active',1)->latestFirst()->paginate($this->limit);
        
        return view('board.index', compact('boards','groups','groupName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
        $groups = Group::with('boards')->orderBy('title','asc')->get();

        $boards = $author->boards()->with('group')->where('is_active',1)->latest()->Paginate($this->limit);
        
        return view('board.index', compact('boards','authorName','groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        $groups = Group::with('boards')->orderBy('title','asc')->get();
       return view('board.create', compact( 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardRequest $request)
    {
       // $rules = [
       //     'group_id' => 'required',
       //     'title' => 'required|max:100',
       //     'body' => 'required',
       //     'image1' => 'nullable|image|max:4000',
       //     'image2' => 'nullable|image|max:4000',
       // ];
       
       // $this->validate($request,$rules);
       $input=$request->all();

       if ($file = $request->file('image1')) {

            $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
            $file->move($this->uploadFolder,$name);
            $input['image1'] = $name;   
       }
       if ($file = $request->file('image2')) {
              $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
              $file->move($this->uploadFolder,$name);
              $input['image2'] = $name;   
       }
       $input['slug'] = md5(microtime());
       $input['user_id'] =Auth::user()->id;
       $input['is_active'] = 1;
       $input['view_count'] = 0;
       
       if ($board = Board::create($input)) {
           Auth::user()->notify(new NewWriteNotification($board));
           Session::flash('success','작성되었습니다.');
           return redirect()->route('board.index');
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
        $board = Board::findOrFail($id);
        if ( !(Auth::user()->slug == $board->user->slug) && $board->group->is_open != 1 && Auth::user()->hasRole('subscriber')) {
            Session::flash('warning','접근할 수 없습니다.');
            return redirect()->back();
        }

        $groups = Group::with('boards')->orderBy('title','asc')->get();
        $board->increment('view_count');
       
        
        return view('board.show', compact('board','groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = Board::findOrFail($id);
        $groups = Group::with('boards')->orderBy('title','asc')->get();
        return view('board.edit', compact('board','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardRequest $request, $id)
    {
        $board = Board::findOrFail($id);
        // $rules = [
        //     'group_id' => 'required',
        //     'title' => 'required|max:100',
        //     'body' => 'required',
        //     'image1' => 'nullable|image|max:4000',
        //     'image2' => 'nullable|image|max:4000',
        // ];
        
        // $this->validate($request,$rules);
        $input=$request->all();

        if ($file = $request->file('image1')) {
              if(!is_null($board->image1)){
                  unlink(public_path().'\\'.$this->uploadFolder.'\\'.$board->image1);
              }
              $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
              $file->move($this->uploadFolder,$name);
              $input['image1'] = $name;   
        }
        if ($file = $request->file('image2')) {
              if(!is_null($board->image2)){
                  unlink(public_path().'\\'.$this->uploadFolder.'\\'.$board->image2);
              }
              $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
              $file->move($this->uploadFolder,$name);
              $input['image2'] = $name;   
        }
        $input['slug'] = md5(microtime());
        $input['user_id'] =Auth::user()->id;
        $input['is_active'] = 1;
        $input['view_count'] = 0;
        
        if ($board->update($input)) {
            Session::flash('success','수정되었습니다.');
            return redirect()->route('board.index');
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
        $board=Board::findOrFail($id);
                
        if(!is_null($board->image1)){
            unlink(public_path()."/$this->uploadFolder/".$board->image1);
        }
        if(!is_null($board->image2)){
            unlink(public_path()."/$this->uploadFolder/".$board->image2);
        }

        if ($board->delete()) {
            Session::flash('success','삭제 되었습니다.');
            return redirect()->route('board.index');

        }
        return back();
    }

   

}
