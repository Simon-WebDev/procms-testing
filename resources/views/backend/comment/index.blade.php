@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-paint-brush"></i> 블로그댓글
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.comment.index')}}"><i class="fa fa-paint-brush"></i> 블로그댓글</a></li>
      <li class="active">블로그댓글</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
              <div class="pull-left">
                <a href="{{route('backend.comment.index')}}" class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              </div>
              <div class="pull-right">
                  <form action="{{route('backend.comment.index')}}" role="search" class="form-inline">
                      <div class="input-group">
                          <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control input-sm" placeholder="내용검색">
                          <span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit">
                              <i class="fa fa-search"></i>
                          </button>
                          </span>
                      </div>
                  </form>
              </div>
            </div>  
            <div class="box-body ">
              @if(!$commentsCount)
                <div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong><a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;text-decoration: none;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>블로그제목</th>
                      <th>내용</th>
                      <th width="80px">작성자</th>
                      <th width="80px">날짜</th>
                      <th width="80px">승인</th>
                      <th width="150px">관리</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($comments)>0)
                    @foreach($comments as $comment)
                    <tr>
                      <td>{{str_limit($comment->post->title,14)}}</td>
                      <td>{{str_limit($comment->body,40)}}</td>
                      <td>{{$comment->author_name}}</td>
                      <td><abbr title="{{$comment->dateFormatted(true)}}">{{$comment->dateFormatted(false)}}</abbr></td>
                      <td>
                        @if($comment->is_active == 1)
                          {!! Form::open(['method'=>'post','action'=>['Backend\CommentController@activeManage',$comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;승인&nbsp;&nbsp;</button>
                          {!! Form::close() !!} 
                        @else
                        {!! Form::open(['method'=>'post','action'=>['Backend\CommentController@activeManage',$comment->id]]) !!}
                          <input type="hidden" name="is_active" value="1">  
                          <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-eye-slash"></i>비승인</button>  
                        {!! Form::close() !!} 
                        @endif
                      </td>
                      <td>
                        <a href="{{route('backend.comment.edit', $comment->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 수정</a>
                        {!! Form::open(['method'=>'delete','action'=>['Backend\CommentController@destroy',$comment->id],'style'=>'display:inline']) !!}
                             <button type="submit" class="btn btn-danger btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))"><i class="fa fa-trash"></i> 삭제</button>
                        {!! Form::close() !!} 
                      </td>
                    </tr>
                   @endforeach
                   @endif 
                  </tbody>
                </table>
              </div>   {{-- end .table-responsive   --}}
                
               
            </div> <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-left">
                {{$comments->appends(Request::query())->render()}}
              </div>
              <div class="pull-right">
                <small>{{$commentsCount}} {{str_plural('item',$commentsCount)}}</small>
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
