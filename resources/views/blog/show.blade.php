@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    @if($post->image_url)
                    <div class="post-item-image">
                        <a href="#">
                            <img src="{{$post->image_url}}" alt="">
                        </a>
                    </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{$post->title}}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('author',$post->author->slug)}}"> {{$post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->created_at->diffForHumans()}}</time></li>
                                    <li><i class="fa fa-tags"></i><a href="{{route('category',$post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-tag"></i>{!! $post->tags_html !!}</li>
                                    <li><i class="fa fa-comments"></i><a href="#post-comments">{{$post->commentsNumber('Comment')}}</a></li>
                                </ul>
                            </div>
                            {!! $post->body !!}
                           {{-- create시 tinymce를 쓰지 않고 simplemde를 쓴경우.  {!! $post->body_html !!} --}}
                           
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img alt="{{$post->author->name}}" src="{{$post->author->gravatar()}}" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="{{route('author',$post->author->slug)}}">{{$post->author->name}}</a></h4>
                        <div class="post-author-count">
                          <a href="{{route('author',$post->author->slug)}}">
                              <i class="fa fa-clone"></i>
                              @php
                                $postCount = $post->author->posts()->published()->count();
                              @endphp
                              {{$post->author->posts()->published()->count()}}  {{str_plural('post',$postCount)}}
                          </a>
                        </div>
                        {!! $post->author->bio_html !!}
                      </div>
                    </div>
                </article>

                @include('layouts.comments')
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection


@section('scripts')
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

  