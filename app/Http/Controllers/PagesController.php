<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Chapter;

class PagesController extends Controller
{
	private $limit =  9;

    public function index(Request $request)
    {
        $chapters = Chapter::with('pages')->orderBy('title','asc')->get();
    	$pages = Page::where(function($query) use($request){
            if ($keyword = $request->get('term')) {
                
                $query->orwhere('title','LIKE','%'.$keyword.'%')->orWhere('body','LIKE','%'.$keyword.'%');
            }
        })->where('is_active',1)->latest()->paginate($this->limit);

    	return view('pages.index', compact('pages','chapters'));
    }

    public function chapter($id)
    {
        $chapters = Chapter::with('pages')->orderBy('title','asc')->get();
        $pages = Page::where('is_active',1)->where('chapter_id',$id)->latest()->paginate($this->limit);
        return view('pages.index', compact('pages','chapters'));
    }

    public function show($id)
    {
    	$page =Page::findOrFail($id);
        $page->increment('view_count');
	    $next_id = Page::where('chapter_id',$page->chapter->id)->where('is_active',1)->where('id','>',$page->id)->min('id');
	    $prev_id = Page::where('chapter_id',$page->chapter->id)->where('is_active',1)->where('id','<',$page->id)->max('id');
	    $next_page = Page::find($next_id);
	    $prev_page = Page::find($prev_id);

        $chapters = Chapter::with('pages')->orderBy('title','asc')->get();

        

		return view('pages.show', compact('page','next_page','prev_page','chapters'));
    }

   
}
