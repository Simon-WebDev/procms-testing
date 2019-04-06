<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use Auth;
use App\Comment;

class ProfilesController extends Controller
{
   public function index(Request $request, $slug)
   {
   	   
       $user=User::where('slug','=',$slug)->firstOrFail();
       if (!($user->slug == Auth::user()->slug)) {
          Session::flash('warning','접근할 수 없습니다');
          return redirect()->back();
       }
       return view('profile.index', compact('user'));
   }

   
   public function edit($slug)
   {
       $user=User::where('slug','=',$slug)->firstOrFail();

       if (!($user->id == Auth::user()->id)) {
          Session::flash('warning','접근할 수 없습니다');
          return redirect()->back();
       }
       return view('profile.edit', compact('user'));
   }

   public function update(Request $request, $id)
   {
       $this->validate($request,[
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255 |unique:users,email,'.$id,
           'password' => 'required_with:password_confirmation|confirmed',

       ]);
       $input = $request->all();
       $user = User::findOrFail($id);
       if (!($user->id == Auth::user()->id)) {
          Session::flash('warning','접근할 수 없습니다');
          return redirect()->back();
       }
       if ($request->password=='') {
           $input=$request->except('password');
           $input['password'] = $user->password;
       }else{
           $input=$request->all();
           $input['password'] =bcrypt($request->password);
       }
       
       if ($user->update($input)) {
           return redirect('/')->with('success','수정되었습니다.');
       }
       return back()->withInput();
   }

   public function destroy($id)
   {
       $user=User::findOrFail($id);

       if (!($user->id == Auth::user()->id)) {
          Session::flash('warning','접근할 수 없습니다');
          return redirect()->back();
       }

       foreach ($user->boards as $board) {
           $board->destroy($board->id);
       }
       foreach ($user->reservations as $reservation) {
           $reservation->destroy($reservation->id);
       }
      
       // comments는 기본적으로 user_id가 입력되지 않게, 즉 원래 구조는 회원가입을 전제로 하는 구조가 아니기 때문에 삭제되기 어렵다. user_id column 이 없다. 고로, 이메일기준으로 삭제하기로 한다.
       $comments = Comment::where('author_email',$user->email)->get();
       
       foreach ($comments as $comment) {
         $comment->delete();
       }

       if ($user->delete()) {
           return redirect('/')->with('success','회원탈퇴 되었습니다.');

       }
       return back();
   }
}
