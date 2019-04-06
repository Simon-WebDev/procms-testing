@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('content')

<section class="inner-header" id="reser-header">
    <div class="inner-header-caption">
        <h1 class="text-center">
          게시판
          <small>small</small>
        </h1>
        <ol class="breadcrumb text-center">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="{{route('board.index')}}"><i class="fa fa-comments"></i> 게시판</a></li>
          <li class="active">게시판 보기</li>
        </ol>
    </div>
</section>

<div class="container">
  <div class="row">
    @include('board.sidebar')
    <div class="col-md-9">
      <article class="post-item post-detail">
        <div class="post-item-body">
          <div class="padding-10">
            <h1>{{$board->title}}</h1>
            <div class="post-meta no-border">
                <ul class="post-meta-group">
                    <li><i class="fa fa-user"></i>@if( Auth::user()->hasRole(['admin','editor','author']))<a href="{{route('board.author',$board->user->slug)}}"> {{$board->user->name}}</a>@else <span>{{$board->user->name}}</span> @endif</li>
                    <li><i class="fa fa-clock-o"></i><time> {{$board->created_at->format('Y-m-d')}}</time></li>
                    <li><i class="fa fa-tasks"></i><a href="{{route('group',$board->group->slug)}}">{{$board->group->title}}</a></li>
                    <li><i class="fa fa-eye"></i>{{$board->view_count}}</li>
                </ul>
            </div>
            
             <div>
               {!! $board->body_html !!}
             </div>
            {{-- create시 tinymce를 쓰지 않고 simplemde를 쓴경우.  {!! $post->body_html !!} --}}
            <div class="m-b-20  m-t-20">
              @if($board->image1_url)
                <div class="post-item-image">
                    <img src="{{$board->image1_url}}" alt="">
                </div>
              @endif
              @if($board->image2_url)
                <div class="post-item-image m-t-10">
                    <img src="{{$board->image2_url}}" alt="">
                </div>
              @endif   
            </div>
            {{-- <article class="info-box">
              <span class="info-box-icon bg-aqua">
                @if( Auth::user()->hasRole(['admin','editor','author']))<a href="{{route('board.author',$board->user->slug)}}">@endif <i class="fa fa-user" style="color:#fff"></i>
                </a>
              </span>
                
              <div class="info-box-content">
                <span class="info-box-number">
                  @if( Auth::user()->hasRole(['admin','editor','author']))<a href="{{route('board.author',$board->user->slug)}} ">{{$board->user->name}}</a>@else <span>{{$board->user->name}}</span> @endif
                </span>
                <div class="progress-description">
                  @if( Auth::user()->hasRole(['admin','editor','author']))<a href="{{route('board.author',$board->user->slug)}}">@else <span>{{$board->user->name}}</span>@endif
                    <i class="fa fa-clone"></i>
                    @php
                      $boardCount = $board->user->boards()->count();
                    @endphp
                      {{$board->user->boards()->count()}}  {{str_plural('article',$boardCount)}}
                  </a>
                </div>
              </div>
           </article> --}}
           {{-- <div class="box box-widget widget-user-2">
             <div class="widget-user-header bg-warning">
                           <div class="widget-user-image">
                             <img class="img-circle" src="{{asset('images/icons8-customer-96.png')}}" alt="User Avatar">
                           </div>
                           
                           <h3 class="widget-user-username">
                             @if( Auth::user()->hasRole(['admin','editor','author']))<a href="{{route('board.author',$board->user->slug)}} ">{{$board->user->name}}</a>@else <span>{{$board->user->name}}</span> @endif
                           </h3>
                           <h5 class="widget-user-desc">
                            <i class="fa fa-clone"></i>
                            @php
                      $boardCount = $board->user->boards()->count();
                    @endphp
                      {{$board->user->boards()->count()}}  {{str_plural('article',$boardCount)}}</h5>
                         </div>
            </div> --}}
          <hr>
          <div class="m-t-10  m-b-10">
            <a href="{{route('board.index')}}" class="btn btn-warning m-r-10 btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
            <a href="{{URL::previous()}}" class="btn btn-default btn-labeled m-r-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>뒤로</a>
            @if(Auth::user()->slug == $board->user->slug || Auth::user()->hasRole(['admin','editor','author']))
            <a href="{{route('board.edit', $board->id)}}" class="btn btn-danger btn-labeled"><span class="btn-label"><i class="fa fa-pencil"></i></span>수정</a>
            @endif
            <a href="{{route('board.create')}}" class="btn btn-info btn-labeled"><span class="btn-label"><i class="fa fa-pencil"></i></span>새 글</a>
          </div>
        </div>
      </article>
      
      @if( Auth::user()->hasRole(['admin','editor','author']) || Auth::user()->id == $board->user_id || $board->group->is_open == 1)
        @include('board.answers')
      @endif  
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

        //make uploaded image responsive
        // $('.post-item-image img').addClass('img-responsive').css({
        //     'display' : 'block',
        //     'padding' : '10px',
        //     'border' : '1px solid #ccc'
        // })
    });
</script>
{{-- bootstrap validator --}}
<script src="{{asset('js/validator.min.js')}}"></script>
{{-- end bootstrap validator --}}
@endsection

  