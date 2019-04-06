<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends BackendController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where(function($query) use($request){
            if ($keyword = $request->get('keyword')) {
               $query->where('name','LIKE','%'.$keyword.'%')
               ->orWhere('email','LIKE','%'.$keyword.'%');
            }
        })->orderBy('created_at','desc')->paginate($this->limit);
        $usersCount = User::count();

        return view("backend.users.index", compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view("backend.users.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
       
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $data['site_agree'] = 1;
        $data['privacy_agree'] = 1;
        $data['slug'] = time().'-'.str_random(20);

        $user = User::create($data);
        $user->attachRole($request->role);

        return redirect("/backend/users")->with("message", "새 회원이 생성되었습니다!");
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
        $user = User::findOrFail($id);

        return view("backend.users.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();

        if ($data['password'] == "") {
            $data=$request->except('password');
            $data['password'] = $user->password;
        }else{
            $data=$request->all();
            $data['password'] =bcrypt($request->password);
        }
       

        $user->update($data);

        $user->detachRoles();
        $user->attachRole($request->role);

        return redirect("/backend/users")->with("message", "수정되었습니다!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;

        if ($deleteOption == "delete") {
            // delete user posts
            $user->posts()->withTrashed()->forceDelete();
            $user->pages()->withTrashed()->forceDelete();
        }
        elseif ($deleteOption == "attribute") {
            $user->posts()->update(['author_id' => $selectedUser]);
            $user->pages()->update(['user_id' => $selectedUser]);
        }

        $user->delete();

        return redirect("/backend/users")->with("message", "회원을 삭제하였습니다!");
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        // $users = User::where('id', '!=', $user->id)->pluck('name', 'id');
        $users1 = User::whereRoleIs('admin')->get();
        $users2 = User::whereRoleIs('editor')->get();
        $users3 = User::whereRoleIs('author')->get();
        $staff_users = $users1->merge($users2)->merge($users3);
        $users = $staff_users->where('id', '!=', $user->id)->pluck('name', 'id');
        
        return view("backend.users.confirm", compact('user', 'users'));
    }
}
