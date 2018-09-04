@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if(isset($categoryName))
                    <div class="alert alert-info">
                        <p>카테고리: <strong>{{$categoryName}}</strong></p>
                    </div>
                @endif
                @if(isset($authorName))
                    <div class="alert alert-info">
                        <p>작성자: <strong>{{$authorName}}</strong></p>
                    </div>
                @endif
                @if(! $posts->count())
                    <div class="alert alert-default">
                        <p>포스트가 존재하지 않습니다.</p>
                    </div>
                @endif
                @foreach($posts as $post)
                <article class="post-item">
                    @if($post->image_url)
                    <div class="post-item-image">
                        <a href="{{route('blog.show', $post->slug)}}">
                            <img src="{{$post->image_url}}" alt="">
                        </a>
                    </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{route('blog.show', $post->slug)}}">{{$post->title}}</a></h2>
                            <p>{!!  $post->excerpt_html !!}</p>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('author', $post->author->slug)}}"> {{$post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="{{route('category',$post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="post.html">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                

                <nav>
                  {!! $posts->links()  !!}
                </nav>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection