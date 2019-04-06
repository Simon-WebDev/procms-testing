
@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-microphone"></i> 공지사항<small>작성</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.page.index')}}"><i class="fa fa-microphone"></i> 공지사항</a></li>
      <li class="active">공지사항 작성</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            <div class="pull-left">
              {{-- <a href="{{route('backend.board.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a> --}}
            </div>
            </div>  
            <div class="box-body ">
                {!! Form::open(['method'=>'post','action'=>'Backend\PageController@store','files'=>true]) !!}
                  <div class="form-group {{$errors->has('chapter_id') ? 'has-error' : ''}}">
                    {!!  Form::label('chapter_id','분류')  !!}
                    {!! Form::select('chapter_id',App\Chapter::pluck('title','id'),null, ['class'=>'form-control','placeholder'=>'분류중 하나를 선택해 주십시요'])!!}
                    @if($errors->has('chapter_id'))
                    <span class="help-block">{{$errors->first('chapter_id')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                    {!!  Form::label('title','제목')  !!}
                    {!!  Form::text('title', null, ['class'=>'form-control'])  !!}
                    @if($errors->has('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                    {!!  Form::label('excerpt','서문')  !!}
                    {!!  Form::textarea('excerpt', null, ['class'=>'form-control','rows'=>8])  !!}
                    @if($errors->has('excerpt'))
                    <span class="help-block">{{$errors->first('excerpt')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                    {!!  Form::label('body','본문')  !!}
                    {!!  Form::textarea('body', null, ['class'=>'form-control','rows'=>40])  !!}
                    @if($errors->has('body'))
                    <span class="help-block">{{$errors->first('body')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://placehold.it/200x150&text=Image+File" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">파일 선택</span><span class="fileinput-exists">파일 변경</span> 

                        {!! Form::file('image')!!}</span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">삭제</a>
                      </div>
                    </div>
                   
                    @if($errors->has('image'))
                    <span class="help-block">{{$errors->first('image')}}</span>
                    @endif
                  </div>
                  
                  <div class="form-group">
                    <label for="is_active">승인</label>
                    <select id="is_active" name="is_notice" class="form-control">
                      <option value="1">승인</option>
                      <option value="0">비승인</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                    <a href="{{URL::previous()}}" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
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


@section('script')
   
  
   <script>
  
   
   </script>
   <!-- tinymce -->
   <script src="/admin/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
   <script src="/admin/plugins/tinymce/langs/ko_KR.js"></script>

   @include('backend.partials.tinymce')
@endsection

