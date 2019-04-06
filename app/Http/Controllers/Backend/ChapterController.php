<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chapter;
use App\Page;

class ChapterController extends BackendController
{

    public function index()
    {
    	$chapters = Chapter::with('pages')->orderBy('title')->paginate($this->limit);
        $chaptersCount = Chapter::count();
        
        return view('backend.chapters.index', compact('chapters','chaptersCount'));
    }

    public function create()
    {
        $chapter = new Chapter();
        return view('backend.chapters.create', compact('chapter'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'title' => 'required|unique:chapters|max:255',
    		'slug' => 'required|unique:chapters|max:255'
    	]);
    	Chapter::create($request->all());
    	return redirect('backend/chapter')->with('message','새 분류가 생성되었습니다.');
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        return view('backend.chapters.edit', compact('chapter'));
    }

    public function update(Request $request, $id)
    {
    	$chapter = Chapter::findOrFail($id);
    	$this->validate($request,[
    		'title' => 'required|max:255|unique:chapters,title,'.$chapter->id,
    		'slug' => 'required|max:255|unique:chapters,slug,'.$chapter->id,
    	]);
    	if ($chapter->update($request->all())) {
    		return redirect('backend/chapter')->with('message','분류를 수정하셨습니다.');
    	}
        
        
    }

    public function destroy($id)
    {
        Page::withTrashed()->where('chapter_id',$id)->update(['chapter_id' =>config('cms.default_chapter_id')]);

        $chapter = Chapter::findOrFail($id);
        if (!($chapter->id == config('cms.default_chapter_id') )) {
            $chapter->delete();
        }
        return redirect('backend/chapter')->with('message','삭제하셨습니다.');
    }
}
