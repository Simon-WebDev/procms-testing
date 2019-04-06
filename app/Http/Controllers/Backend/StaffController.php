<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;

class StaffController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs=Staff::latest()->paginate($this->limit);
        $staffsCount = Staff::count();
        return view('backend.staff.index', compact('staffs','staffsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.staff.create');
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
            'name' => 'required',
            'major' => 'required',
            'color' => 'required',
        ]);
        $input=$request->all();
        if (Staff::create($input)) {
            return redirect()->route('backend.staff.index')->with('success','새 스텝을 만들었습니다.');
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
        $staff= Staff::find($id);
        return view('backend.staff.edit', compact('staff'));
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
            'name' => 'required',
            'major' => 'required',
            'color' => 'required',
        ]);
        $input=$request->all();
        $staff = Staff::find($id);
        if ($staff->update($input)) {
            return redirect()->route('backend.staff.index')->with('success','스텝을 수정하였습니다.');
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
        $staff=Staff::findOrFail($id);
        if ($staff->delete()) {
            return redirect()->route('backend.staff.index')->with('success','스텝을 삭제하였습니다.');

        }
        return back();
    }
}
