<?php
namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentStoreRequest;
use App\Notifications\CommentNotification;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth',['except' => ['index']]);
	    
	}
	
    public function store(Post $post, CommentStoreRequest $request)
    {
    	
        $post->createComment($request->all());
       
        return redirect()->back()->with('message', "작성되었습니다.");
    }

    
}
