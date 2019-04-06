@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-bullhorn"></i> 답글<small>모든 글</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.answer.index')}}"><i class="fa fa-bullhorn"></i> 답글</a></li>
      <li class="active">답글 모든글</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
              <div class="pull-left">
                <a href="{{route('backend.answer.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              </div>
              <div class="pull-right">
                <form action="{{route('backend.answer.index')}}" role="search" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control input-sm" placeholder="게시판 검색">
                        <span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                </form>
              </div>
            </div>  
            <div class="box-body ">
              @if(!$answersCount)
                <div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>게시판</th>
                      <th>제목</th>
                      <th>작성자</th>
                      <th>날짜</th>
                      <th>승인</th>
                      <th>관리</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    @if(count($answers)>0)
                    @foreach($answers as $answer)
                     
                    <tr>
                      <td>{{$answer->board->group->title}}</td>
                      
                      <td style="width:40%">{{$answer->board->title}}</td>
                      <td>{{$answer->user->name}}</td>
                      <td style="width:100px"><abbr title="{{$answer->dateFormatted(true)}}">{{$answer->dateFormatted(false)}}</abbr></td>
                     
                      <td style="width:100px">
                        @if($answer->is_active == 1)
                          {!! Form::open(['method'=>'post','action'=>['Backend\AnswerController@activeManage',$answer->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> &nbsp;&nbsp;승인&nbsp;&nbsp;</button>  
                          {!! Form::close() !!} 
                                  
                        @else
                        {!! Form::open(['method'=>'post','action'=>['Backend\AnswerController@activeManage',$answer->id]]) !!}
                          <input type="hidden" name="is_active" value="1"> 
                          <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-eye-slash"></i> 비승인</button>  
                          
                            
                        {!! Form::close() !!} 
                        @endif
                      </td>
                      <td style="width:200px">
                        <a href="{{route('backend.answer.edit', $answer->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 수정</a>
                        {!! Form::open(['method'=>'delete','action'=>['Backend\AnswerController@destroy',$answer->id],'style'=>'display:inline']) !!}
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
                {{$answers->appends(Request::query())->render()}}
              </div>
              <div class="pull-right">
                <small>{{$answersCount}} {{str_plural('Item',$answersCount)}}</small>
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
