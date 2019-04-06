@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tasks"></i> 게시판 분류<small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.group.index')}}"><i class="fa fa-tasks"></i> 게시판 분류</a></li>
      <li class="active">게시판분류 수정</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            
            </div>  
            <div class="box-body ">
              {!! Form::model($group,['method'=>'patch','action'=>['Backend\GroupController@update',$group->id]]) !!}
              <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title','제목') !!}
                {!! Form::text('title', null, ['class'=>'form-control'])!!}
                @if($errors->has('title'))
                <span class="help-block">{{$errors->first('title')}}</span>
                @endif
              </div>
              <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                {!! Form::label('slug','슬러그') !!}
                {!! Form::text('slug', null, ['class'=>'form-control'])!!}
                @if($errors->has('slug'))
                <span class="help-block">{{$errors->first('slug')}}</span>
                @endif
              </div>
              <div class="form-group {{$errors->has('is_open') ? 'has-error' : ''}}">
                {!! Form::label('is_open','공개 여부') !!}
                {!! Form::select('is_open',[0 => '비공개', 1 => '공개'],null,['class'=>'form-control','placeholder'=>'선택하세요']) !!}
                @if($errors->has('is_open'))
                <span class="help-block">{{$errors->first('is_open')}}</span>
                @endif
              </div> 
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                <a href="{{route('backend.group.index')}}" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>취소</a>
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
  //make slug title the same automatically
  $('#title').on('blur', function(){
    var theTitle = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        /*my custom*/
        // theSlug = theTitle.replace(/&/g,'-그리고-')
        //           .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
        //           .replace(/\-\-+/g, '-')
        //           .replace(/^-+|-+$/g,'');
        // console.log(theTitle);
        /*end mycustom*/
        /*speakingurl add korean js*/
        theSlug = getSlug(theTitle);
        /*end speaking url add korean*/
    slugInput.val(theSlug);
  });
</script>
@endsection
