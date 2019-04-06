@extends('layouts.backend.main')

@section('title')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      답글 글쓰기
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.answer.index')}}"><i class="fa fa-comments"></i> 답글</a></li>
      <li class="active">답글 글쓰기</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-comments"></i>

              <h3 class="box-title">게시판 내용</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>작성자</dt>
                <dd>{{$board->user->name}}</dd>
                <dt>날짜</dt>
                <dd>{{$board->created_at->format('Y/m/d')}}</dd>
                <dt>제목</dt>
                <dd>{{$board->title}}</dd>
                <dt>내용</dt>
                <dd>{!!$board->body_html!!}</dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">답글쓰기</h3>
            </div>
            <div class="box-body ">
                 {!! Form::open(['method'=>'post','action'=>'Backend\AnswerController@store']) !!}
                  <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                    <input type="hidden" name="board_id" value="{{$board->id}}">
                    {!!  Form::label('body','내용')  !!}
                    {!!  Form::textarea('body', null, ['class'=>'form-control'])  !!}
                  </div>
                  @if($errors->has('body'))
                  <span class="help-block">{{$errors->first('body')}}</span>
                  @endif
                  <div class="form-group">
                    {!!  Form::submit('확인',['class'=>'btn btn-primary'])  !!}
                    <a href="{{URL::previous()}}" class="btn btn-default" style="color:#333;">뒤로</a>
                  </div>
                 {!! Form::close() !!} 
            </div>
            <!-- /.box-body -->
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



