@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('style')
<style type="text/css">


</style>
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
        <li class="active">게시판</li>
      </ol>
  </div>
</section>
<div class="container">
  <div class="row">
    @include('board.sidebar')
    <div class="col-md-9">
      <div class="clearfix">
          <a @if(Auth::check())href="{{route('board.create')}}" @else href="#" @endif class="btn btn-info pull-right m-b-20 btn-labeled" id="boardCreate"><span class="btn-label"><i class="fa fa-pencil"></i></span>글쓰기</a>
          <a href="{{route('board.index')}}" class="btn btn-warning pull-right m-b-20 m-r-10 btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>전체목록</a>
      </div>
      @include('board.alert')
      @include('includes.messages')
      @if( $boards->count())  
      <div class="box">   
      <div class="table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th></th>
              <th>제목</th>
              <th style="width:80px">작성자</th>
              <th style="width:80px">작성일</th>
              <th class="hidden-md">조회</th>
            </tr>
          </thead>
          <span style="display: none">{{($tn = $boards->total()-(($boards->currentPage() - 1) * $boards->perPage()))}}</span>
          <tbody>
            @foreach($boards as $board)
            <tr>
              <td>{{$tn--}}</td>
                <td>
                  <a 
                   @if(Auth::check())
                      @if(Auth::user()->slug == $board->user->slug || $board->group->is_open == 1 || Auth::user()->hasRole(['admin','editor','author'])) href="{{route('board.show',$board->id)}}"  
                      @else 
                      href="#"  
                      @endif
                  @else
                    href="#"    
                  @endif class="board-title">

                  @if(Carbon\Carbon::now() < $board->created_at->addDay()) 
                    <span class="label label-danger">new</span> 
                  @endif
                  {{str_limit($board->title,30)}}
                  @if($board->answers->count() > 0 && $board->group->is_open != 1)
                    <span class="label label-info">
                       상담완료
                    </span>
                  @endif
                  </a>
                </td>
                <td>
                  @if( Auth::user() && Auth::user()->hasRole(['admin','editor','author']))
                    <a href="{{route('board.author',$board->user->slug)}}">{{$board->nameFormated()}}</a>
                  @else <span>{{$board->nameFormated()}}</span> 
                  @endif
                </td>
                <td>{{$board->created_at->format('Y/m/d')}}</td>
                <td>{{$board->view_count}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      </div> 
      @endif
        <nav class="text-center">
          {!! $boards->appends(Request::query())->render()  !!}
        </nav>
        <hr>
        <div class="text-center m-b-20">
            <form action="{{route('board.index')}}" role="search" class="form-inline">
                <div class="input-group">
                    <input type="text" name="term" value="{{Request::get('term')}}" class="form-control" placeholder="게시판 검색" required>
                    <span class="input-group-btn"><button class="btn btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
    <div class="modal fade modal-info" tabindex="-1" role="dialog" id="loginmodal">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{$settings->site_name}}</h4>
          </div>
          <div class="modal-body text-center">
            @if(Auth::guest())
             로그인이 필요합니다 
            <a href="{{route('login')}}" class="btn btn-outline"><i class="fa fa-sign-in"></i></a>
            @else
                <p><i class="fa fa-warning"></i> 본인 글만 열람 가능합니다.</p>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline btn-sm" data-dismiss="modal">닫기</button>
           
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade modal-info" tabindex="-1" role="dialog" id="board_cr_modal">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{$settings->site_name}}</h4>
          </div>
          <div class="modal-body text-center">
            로그인이 필요합니다
            <a href="{{route('login')}}" class="btn btn-outline"><i class="fa fa-sign-in"></i></a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline btn-sm" data-dismiss="modal">닫기</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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

        //login or not modal
        $('.board-title').click(function() {
            if ($(this).attr('href')=='#') {
                $('#loginmodal').modal();
            }
        });

        $('#boardCreate').click(function() {
            if ($(this).attr('href') == '#') {
                $('#board_cr_modal').modal();
            }
        });
    });
</script>
@endsection


