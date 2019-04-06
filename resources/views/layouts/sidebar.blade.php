<div class="col-md-3">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="{{route('blog')}}">
                <div class="input-group">
                  <input type="text" class="form-control input-lg" name="term" value="{{request('term')}}" placeholder="검색">
                  <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4 class="text-center">카테고리</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    
                    @foreach($categories as $category)
                    <li>
                        <a href="{{route('category', $category->slug)}}"><i class="fa fa-angle-right"></i> {{$category->title}}</a>
                        <span class="badge pull-right">{{$category->posts->count()}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4 class="text-center">인기 글</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">

                    @foreach($popularPosts as $post)
                    <li>
                        @if($post->image_thumb_url)
                        <div class="post-image">
                            <a href="{{route('blog.show',$post->slug)}}">
                                <img src="{{$post->image_thumb_url}}" />
                            </a>
                        </div>
                        @endif
                        <div class="post-body">
                            <h6><a href="{{route('blog.show',$post->slug)}}">{{str_limit($post->title,50)}}</a></h6>
                            <div class="post-meta">
                                <span>{{$post->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                   
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4 class="text-center">Archives</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    
                    @foreach($archives as $archive)
                    <li>
                        <a href="{{route('blog', ['month' => $archive->month, 'year'=>$archive->year])}}"><i class="fa fa-angle-right"></i> {{$archive->year}}/{{$archive->month}}
                        <span class="badge pull-right">{{$archive->post_count}}</span>
                    </a>

                        
                    </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4 class="text-center">태그</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach($tags as $tag)
                    @if(!empty($tag->name))
                    <li><a href="{{route('tag',$tag->slug)}}">{{$tag->name}}</a></li>
                    @endif
                    @endforeach

                </ul>
            </div>
        </div>
    </aside>
</div>