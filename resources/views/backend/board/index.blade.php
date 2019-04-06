@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-comments"></i> 게시판<small>모든글</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.board.index')}}"><i class="fa fa-comments"></i> 게시판</a></li>
      <li class="active">게시판 모든글</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            <div class="pull-left">
              <a href="{{route('backend.board.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
              <a href="{{route('backend.board.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
            </div>

            <div class="pull-right">
              <form action="{{route('backend.board.index')}}" role="search" class="form-inline">
                  <div class="input-group">
                      <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control input-sm" placeholder="검색" requried>
                      <span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit">
                          <i class="fa fa-search"></i>
                      </button>
                      </span>
                  </div>
              </form>
            </div>
            
            </div>  
            <div class="box-body ">
              @if(!$boardsCount)
                <div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="hidden-md hidden-sm hidden-xs" width="100px">분류</th>
                      <th>제목</th>
                      <th class="hidden-md hidden-sm hidden-xs" width="100px">날짜</th>
                     {{--  <th>원글보기</th> --}}
                      <th width="100px">승인</th>
                      <th width="100px">답글</th>
                      <th width="150px">관리</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($boards)>0)
                    @foreach($boards as $board)
                    <tr>
                      <td class="hidden-md hidden-sm hidden-xs">{{$board->group->title}}</td>
                      
                      <td>{{str_limit($board->title,40)}}</td>
                      <td class="hidden-md hidden-sm hidden-xs"><abbr title="{{$board->dateFormatted(true)}}">{{$board->dateFormatted(false)}}</abbr></td>
                      {{-- <td style="width:10%">
                        <a href="{{route('admin.boards.edit', $board->id)}}" class="btn btn-warning btn-sm" style="color:#fff;"><i class="fa fa-eye"></i> 관리</a>
                      </td> --}}
                      <td>
                        @if($board->is_active == 1)
                          {!! Form::open(['method'=>'post','action'=>['Backend\BoardController@activeManage',$board->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;승인&nbsp;&nbsp;</button>  
                          {!! Form::close() !!} 
                                  
                        @else
                        {!! Form::open(['method'=>'post','action'=>['Backend\BoardController@activeManage',$board->id]]) !!}
                          <input type="hidden" name="is_active" value="1">  
                          <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-eye-slash"></i>비승인</button>  
                            
                        {!! Form::close() !!} 
                        @endif
                      </td>
                      <td>
                        {{-- @if(count($board->answers)>0)
                        <a href="#" class="btn bg-maroon btn-sm disabled""><i class="fa fa-check"></i> 답글완료</a>
                        @else --}}
                        <a href="{{route('backend.answer.create',$board->id)}}" class="btn {{ count($board->answers)>0 ? 'bg-navy':'btn-default'}} btn-sm"><i class="fa fa-edit"></i> 답글</a>
                        {{-- @endif --}}
                      </td>
                      <td>
                        <a href="{{route('backend.board.edit', $board->id)}}" class="btn btn-info btn-sm" style="color:#fff;"><i class="fa fa-edit"></i> 수정</a>
                        {!! Form::open(['method'=>'delete','action'=>['Backend\BoardController@destroy',$board->id],'style'=>'display:inline']) !!}
                             <button type="submit" class="btn btn-danger btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))"><i class="fa fa-trash"></i> 삭제</button>
                        {!! Form::close() !!} 
                      </td>
                    </tr>
                   @endforeach
                   @endif 
                  </tbody>
                </table>
              </div>   
              
                 
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pull-left">
                {{$boards->appends(Request::query())->render()}}
              </div>
              <div class="pull-right">
                <small>{{$boardsCount}} {{str_plural('Item',$boardsCount)}}</small>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
