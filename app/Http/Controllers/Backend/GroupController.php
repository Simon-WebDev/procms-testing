<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use Session;

class GroupController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::orderBy('title')->paginate($this->limit);
        $groupsCount = Group::count();
        return view('backend.group.index', compact('groups','groupsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.group.create');
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
             'title' => 'required',
             'slug'  => 'required|unique:groups',
             'is_open' => 'required'
        ]);
        $input = $request->all();
        
        if (Group::create($input)) {
            Session::flash('message','새로운 게시판분류를 만들었습니다.');
            return redirect()->route('backend.group.index');
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
        $group = Group::findOrFail($id);
        return view('backend.group.edit',compact('group'));
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
        $group = Group::findOrFail($id);
        $this->validate($request,[
             'title' => 'required',
             'slug'  => 'required|unique:groups,slug,'.$group->id,
             'is_open' => 'required'
        ]);
        $input = $request->all();

        if ($group->update($input)) {
            Session::flash('message','게시판분류를 수정하였습니다.');
            return redirect()->route('backend.group.index');
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
        //
    }
}
