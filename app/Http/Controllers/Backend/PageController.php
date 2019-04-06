<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PageController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        
        if ($status =='trash') {
          $pages = Page::onlyTrashed()->orderBy('deleted_at','desc')->paginate($this->limit);
          
          return view('backend.page.trash', compact('pages'));
        }else
        {
          $pages = Page::where(function($query) use($request){
               if ($chapter_id = ($request->get('chapter_id'))) {
                   $query->where('chapter_id', $chapter_id);
                   
               }
               if ($keyword = $request->get('keyword')) {
                   
                   $query->orwhere('title','LIKE','%'.$keyword.'%')->orWhere('body','LIKE','%'.$keyword.'%');
                   
               }
               
          })
          ->latest()
          ->paginate($this->limit);
          

          return view('backend.page.index', compact('pages'));
        }

       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'chapter_id' =>'required',
            'title' => 'required|max:150',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,bmp | max:6000'
        ];
        
        $this->validate($request,$rules);

        $input = $request->all();

        
        if ($file = $request->file('image')) {
               $file = $request->file('image');
               $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
               $file->move(config('cms.image.directory'),$name);
               $input['image'] = $name;  

               $ext = substr(strrchr($name, '.'), 1);
               $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $name);
               $destination = config('cms.image.directory');

               $width = config('cms.image.thumbnail.width');
               $height = config('cms.image.thumbnail.height');
              
               Image::make($destination. '/' . $name)
               ->resize($width,$height)
               ->save($destination. '/' . $thumbnail);
               
        }
        
         
        $input['user_id'] =Auth::user()->id;
        $input['view_count'] = 0;
        
        if (Page::create($input)) {
            Session::flash('success','작성되었습니다.');
            return redirect()->route('backend.page.index');
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
        $page = Page::findOrFail($id);
        return view('backend.page.edit', compact('page'));
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
       $this->validate($request, [
            'title' => 'required|max:150',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,bmp | max:6000'
            
        ]);
       $page = Page::findOrFail($id);
       $oldImage = $page->image;
       $input=$request->all();

       if ($file = $request->file('image')) {
           $name = time().'-'.str_random(6).'.'.$file->getClientOriginalExtension();
           $file->move(config('cms.image.directory'),$name);
           $input['image'] = $name;  

           $ext = substr(strrchr($name, '.'), 1);
           $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $name);
           $destination = config('cms.image.directory');

           $width = config('cms.image.thumbnail.width');
           $height = config('cms.image.thumbnail.height');
           
           Image::make($destination. '/' . $name)
           ->resize($width,$height)
           ->save($destination. '/' . $thumbnail); 
       }
       
       if ($page->update($input)) {
           Session::flash('success','수정되었습니다.');
           //이미지 업로드폴더가 포스트(블로그)폴더와 동일 굳이 파일삭제할 필요없다.
           // if ($oldImage !== $page->image) {
           //     $this->removeImage($oldImage);
           // }
           return redirect()->route('backend.page.index');
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
        $page=Page::findOrFail($id);
                
        //공지사항의 이미지는 포스트의 이미지 폴더로 설정되어 있고 그래서 파일 삭제 않하기로        
        
        //$this->removeImage($page->image);
        
        if ($page->delete()) {
            Session::flash('trash-message',['임시 삭제 되었습니다.',$id]);
            return redirect()->route('backend.page.index');

        }
        return back();
    }

    public function restore($id)
    {
        $page = Page::withTrashed()->findOrFail($id);
        $page->restore();

        return redirect()->back()->with('message','글이 임시삭제에서 정상적으로 복원되었습니다.');
    }

    public function forceDestroy($id)
    {   
        $page = Page::withTrashed()->findOrFail($id);
        $page->forceDelete();
        // $this->removeImage($page->image);
        return redirect('backend/page?status=trash')->with('message','영구삭제 되었습니다.');
    }

    public function activeManage(Request $request, $id)
    {
        if ( Page::findOrFail($id)->update($request->all())) {
                   return redirect()->back();
         }
    }

    private  function removeImage($image)
    {
        if (! empty($image)) {
            $imagePath = public_path(). '/' .config('cms.image.directory'). '/' . $image;
            $ext = substr(strrchr($imagePath, '.'), 1);
            $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $image);
            
            $thumbnailPath = public_path().'/'.config('cms.image.directory').'/'.$thumbnail;
           
            if(file_exists($imagePath)) {
                unlink($imagePath);
            }
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
            
        }
    }
}
