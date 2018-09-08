<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class BlogController extends BackendController
{
    private $limit = 5;
    private $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category','author')->latest()->paginate($this->limit);
        $postCount = Post::count();
        return view('backend.blog.index', compact('posts','postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);
        
        $request->user()->posts()->create($data);
        return redirect('backend/blog/')->with('message','새 블로그 글을 작성하셨습니다.');
    }

    public function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = str_random(6).time().'.'.$image->getClientOriginalExtension();

            $ext = substr(strrchr($fileName, '.'), 1);
            $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $fileName);

            $destination = $this->uploadPath;

            $width = config('cms.image.thumbnail.width');
            $height = config('cms.image.thumbnail.height');
            $successUploaded = $image->move($destination, $fileName);
            if ($successUploaded) {
                Image::make($destination. '/' . $fileName)
                ->resize($width,$height)
                ->save($destination. '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }
        return $data;
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
        $post = Post::findOrFail($id);
        return view('backend.blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->handleRequest($request);
        $post->update($data);
        return redirect('backend/blog/')->with('message','블로그 글을 수정하셨습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect('backend/blog')->with('trash-message',['임시삭제 되었습니다.',$id]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('backend/blog')->with('message','글이 임시삭제에서 정상적으로 복원되었습니다.');
    }
}
