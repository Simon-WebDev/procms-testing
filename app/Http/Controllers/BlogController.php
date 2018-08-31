<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
	protected $limit = 3;
    public function index()
    {
    	
    	$posts = Post::latest()->published()->SimplePaginate($this->limit);

    	return view('blog.index', compact('posts'));
    	
    }
}
