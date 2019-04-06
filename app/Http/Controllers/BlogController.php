<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
	protected $limit = 5;
    public function index()
    {
    	$posts = Post::with('author','tags','category','comments')
                        ->published()
                        ->filter(request()->only(['term', 'month', 'year']))
                        ->orderBy('published_at','desc')
                        ->simplePaginate($this->limit);

    	return view('blog.index', compact('posts')); 
    }

   

    public function show($slug)
    {

    	$categories = Category::with(['posts'=> function($query){
    		$query->published();
    	}])->orderBy('title','asc')->get();

    	$post = Post::where('slug',$slug)->published()->first();

        $next_id = Post::published()->where('id','>',$post->id)->min('id');
        $prev_id = Post::published()->where('id','<',$post->id)->max('id');
        $next_post = Post::find($next_id);
        $prev_post = Post::find($prev_id);

        //set view_count method 1
        // $viewCount = $post->view_count+1;
        // $post->update(['view_count' => $viewCount]);
        //set view_count method2
        $post->increment('view_count');
        //end view_count method2

        $postComments = $post->comments()->where('is_active',1)->simplePaginate(3);
    	return view('blog.show', compact('post','categories','postComments','next_post','prev_post'));
    }

    public function category(Category $category)
    {
    	$categoryName = $category->title;
    	//$category = Category::findOrFail($id);
    	$posts = $category->posts()->with('author','tags','comments')->latest()->published()->SimplePaginate($this->limit);
    	

    	return view('blog.index', compact('posts','categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->name;
        //$category = Category::findOrFail($id);
        $posts = $tag->posts()->with('author','category','comments')->latest()->published()->SimplePaginate($this->limit);
        
        return view('blog.index', compact('posts','tagName'));
    }
    
    public function author(User $author)
    {
        $authorName = $author->name;
        $posts = $author->posts()->with('category','tags','comments')->latest()->published()->simplePaginate($this->limit);
        return view('blog.index', compact('posts','authorName'));

    }
   
}
