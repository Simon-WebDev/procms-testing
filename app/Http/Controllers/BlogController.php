<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BlogController extends Controller
{
	protected $limit = 3;
    public function index()
    {
    	
    	$posts = Post::with('author')->latest()->published()->SimplePaginate($this->limit);
    	$categories = Category::with('posts')->orderBy('title','asc')->get();

    	

    	return view('blog.index', compact('posts','categories'));
    	
    }

    public function show($slug)
    {
    	$post = Post::where('slug',$slug)->published()->first();
    	return view('blog.show', compact('post'));
    }

    public function category($id)
    {
    	$category = Category::findOrFail($id);
    	$posts = Post::with('author')->latest()->where('category_id',$category->id)->published()->SimplePaginate($this->limit);
    	$categories = Category::with(['posts'=> function($query){
    		$query->published();
    	}])->orderBy('title','asc')->get();

    	return view('blog.index', compact('posts','categories'));
    }
}
