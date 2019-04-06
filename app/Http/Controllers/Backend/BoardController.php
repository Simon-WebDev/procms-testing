<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BoardController extends BackendController
{
    protected $uploadFolder = 'upload';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boards = Board::where(function($query) use($request){
             if ($group_id = ($request->get('group_id'))) {
                 $query->where('group_id', $group_id);
             }
             if ($keyword = $request->get('keyword')) {
                 
                 $query->orwhere('title','LIKE','%'.$keyword.'%')->orWhere('body','LIKE','%'.$keyword.'%');
             }
        })
        ->orderBy('id','desc')
        ->paginate($this->limit);
        $boardsCount = Board::count();
        
        return view('backend.board.index', compact('boards','boardsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'group_id' => 'required',
            'title' => 'required|max:150',
            'body' => 'required',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2000',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2000',
        ];
        
        $this->validate($request,$rules);
        $input=$request->all();

        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            $name = str_random(6).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move($this->uploadFolder,$name);
            $input['image1'] = $name;   
        }
        if ($request->hasFile('image2')) {
            $file = $request->file('image2');
            $name = str_random(6).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move($this->uploadFolder,$name);
            $input['image2'] = $name;   
        }
         
        $input['user_id'] =Auth::user()->id;
        $input['is_active'] = 1;
        $input['view_count'] = 0;
        
        if (Board::create($input)) {
            Session::flash('success','작성되었습니다.');
            return redirect()->route('backend.board.index');
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
        $board = Board::findOrFail($id);
        return view('backend.board.edit',compact('board'));
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

        $this->validate($request, [
             'group_id' => 'required',
             'title' => 'required|max:150',
             'body' => 'required',
             'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2000',
             'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2000',
             'slug'=>'required|unique:boards,slug,'.$id
         ]);
        $board = Board::findOrFail($id);
        $oldImage1 = $board->image1;
        $oldImage2 = $board->image2;
        $input=$request->all();

        if ($file = $request->file('image1')) {
            $name = str_random(6).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move($this->uploadFolder,$name);
            $input['image1'] = $name;   
        }
        if ($file = $request->file('image2')) {
            $name = str_random(6).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move($this->uploadFolder,$name);
            $input['image2'] = $name;   
        }
        
        if ($board->update($input)) {
            Session::flash('success','수정되었습니다.');
            if ($oldImage1 !== $board->image1) {
                $this->removeImage($oldImage1);
            }
            if ($oldImage2 !== $board->image2) {
                $this->removeImage($oldImage2);
            }
            return redirect()->route('backend.board.index');
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
            return redirect()->route('backend.board.index');

        }
        return back();
    }

    public function activeManage(Request $request, $id)
    {
        if ( Board::findOrFail($id)->update($request->all())) {
                   return redirect()->back();
         }
    }

    private  function removeImage($image)
    {
        if (! empty($image)) {
            $imagePath = public_path() . "/$this->uploadFolder/" . $image;
           
            if(file_exists($imagePath)) {
                unlink($imagePath);
            }
            
        }
    }
}
