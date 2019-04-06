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
        <li class="active">블로그 보기</li>
      </ol>
  </div>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-9">
        <article class="post-item post-detail">
            @if($post->image_url)
            <div class="post-item-image">
              <img src="{{$post->image_url}}" alt="{{$post->title}}">
            </div>
            @endif
            <div class="post-item-body">
                <div class="padding-10">
                    <h1>{{$post->title}}</h1>
                    <div class="post-meta no-border">
                        <ul class="post-meta-group">
                            <li><span><img src="{{$post->author->gravatar()}}" style="width:18px; height: 18px;" class="gravatar" alt="{{$post->author->name}}"></span><a href="{{route('author',$post->author->slug)}}"> {{$post->author->name}}</a></li>
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
                <a href="{{route('author',$post->author->slug)}}">
                  <img src="{{$post->author->gravatar()}}" class="media-object" width="100" alt="{{$post->author->name}}">
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
        <hr>
            <div class="page-indi clearfix">
                <div class="col-xs-6">
                  @if(!is_null($prev_post))
                    <a href="{{route('blog.show',$prev_post->slug)}}"><i class="fa fa-chevron-left 2x"></i> 이전글
                    <h4>{{str_limit($prev_post->title,30)}}</h4>
              </a>
              @else
              이전글이 없습니다.
                    @endif
                </div>
                <div class="col-xs-6">
                  @if(!is_null($next_post))
                    <a href="{{route('blog.show',$next_post->slug)}}"> <span>다음글 <i class="fa fa-chevron-right 2x"></i></span>
                    <h4>{{str_limit($next_post->title,30)}} </h4>
                    </a>
                    @else
                    다음글이 없습니다.
                    @endif
                </div>
            </div>
          <hr>
          <div class="box box-solid m-b-50 m-t-30">
            <div class="box-body">
              <a href="{{route('blog')}}" class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              <a href="" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>뒤로</a>
            </div>
          </div>
        @include('layouts.comments')
    </div>
     @include('layouts.sidebar')
  </div>
</div>
    {{-- comment form focused, modal fire --}}
    <div class="modal fade modal-info" id="modal1" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{$settings->site_name}}</h4>
          </div>
          <div class="modal-body text-center">
            <span class="m-r-10">로그인이 필요합니다.</span>
            <a href="{{route('login')}}" class="btn btn-outline blogLoginBtn"><i class="fa fa-sign-in"></i> 로그인</a>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-dismiss="modal">닫기</button>
            
          </div>
        </div>
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

        //make image responsive in post-show
        $('.post-item-body').find('img').addClass('img-responsive m-t-20 m-b-20 p-show-p');
        $('.post-item-body').find('img').first().addClass('m-t-20');
        //make gravatar img excluding above rules. make normal img.
        $('.gravatar').removeClass('img-responsive m-t-20 m-b-20 p-show-p');
    });
    
    //comment form focused, modal trigers
    @if(!Auth::check())
    $('#comment-form input, #comment-form textarea').click(function(){
        $('#modal1').modal();
    });
    @endif

    //comment form. if logged in. user name, user email, automatically inserted.
    @if(Auth::check())
      
      $('#comment-form #author_name').val("{{Auth::user()->name}}"); 
      $('#comment-form #author_email').val("{{Auth::user()->email}}");
     
    @endif
</script>

<!-- validation commment form -->
{{-- bootstrap validator --}}
<script src="{{asset('js/validator.min.js')}}"></script>
{{-- end bootstrap validator --}}
@endsection

  