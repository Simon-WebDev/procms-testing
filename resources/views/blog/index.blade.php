@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('content')

<section class="inner-header" id="reser-header">
    <div class="inner-header-caption">
        <h1 class="text-center">
          블로그
          <small>small</small>
        </h1>
        <ol class="breadcrumb text-center">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="{{route('blog')}}"><i class="fa fa-pencil"></i> 블로그</a></li>
          <li class="active">블로그</li>
        </ol>
    </div>
</section>



    <div class="container">
        <div class="row">
           
            <div class="col-md-9">
                
                @include('blog.alert')

                @foreach($posts as $post)
                <article class="post-item">
                    @if($post->image_url)
                    <div class="post-item-image">
                        <a href="{{route('blog.show', $post->slug)}}" class="blog-thumb blog-cycle">
                            <img src="{{$post->image_url}}" alt="{{$post->title}}">
                        </a>
                    </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{route('blog.show', $post->slug)}}">{{$post->title}}</a></h2>
                            <div>
                                {!! $post->excerpt !!}
                                {{--create시 tinymce를 쓰지 않는경우 Markdown사용. {!!  $post->excerpt_html !!} --}}
                                
                            </div>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><span><img src="{{$post->author->gravatar()}}" style="width:18px; height: 18px;" alt="{{$post->author->name}}"></span><a href="{{route('author', $post->author->slug)}}"> {{$post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="{{route('category',$post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-tag"></i>{!! $post->tags_html !!}</li>

                                    <li><i class="fa fa-comments"></i><a href="{{route('blog.show',$post->slug)}}#post-comments">{{$post->commentsNumber()}}</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('blog.show',$post->slug)}}">자세히 <span><i class="fa fa-angle-double-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                

                <nav class="text-center">
                  {!! $posts->appends(request()->only(['term', 'month', 'year']))->links()  !!}
                </nav>
            </div>
            @include('layouts.sidebar')
            
        </div>
    </div>

@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        //change pagination link icon
        $('.pagination>li:first a').html('<i class="fa fa-chevron-left"></i>');
        $('.pagination>li:first span').html('<i class="fa fa-chevron-left"></i>');
        $('.pagination>li:last a').html('<i class="fa fa-chevron-right"></i>');
        $('.pagination>li:last span').html('<i class="fa fa-chevron-right"></i>');
    });
</script>
@endsection