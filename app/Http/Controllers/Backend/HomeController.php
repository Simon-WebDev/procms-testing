<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class HomeController extends BackendController
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.home.index');
    }

    public function edit(Request $request)
    {
    	$user = $request->user();
    	return view('backend.home.edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
    	$user = $request->user();
    	$data = $request->all();

    	if ($data['password'] == "") {
    	    $data=$request->except('password');
    	    $data['password'] = $user->password;
    	}else{
    	    $data=$request->all();
    	    $data['password'] =bcrypt($request->password);
    	}
    	$user->update($data);


    	return redirect()->back()->with('message','프로필을 수정하셨습니다.');
    }
}
