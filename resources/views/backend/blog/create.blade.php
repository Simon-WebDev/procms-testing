@extends('layouts.backend.main')
@section('title', 'MyBlog | Blog create')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blog
      <small>Add New Post</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
      <li class="active">New Post</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body ">
                    @if(session('message'))
                      <div class="alert alert-info">
                        {{session('message')}}
                      </div>
                    @endif
                    {!! Form::model($post, [
                      'route' => 'backend.blog.store',
                      'method' => 'POST',
                      'files'  => TRUE
                    ]) !!}
                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                      {!! Form::label('title') !!}
                      {!! Form::text('title', null, ['class'=>'form-control'])!!}
                      @if($errors->has('title'))
                      <span class="help-block">{{$errors->first('title')}}</span>
                      @endif
                    </div>
                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                      {!! Form::label('slug') !!}
                      {!! Form::text('slug', null, ['class'=>'form-control'])!!}
                      @if($errors->has('slug'))
                      <span class="help-block">{{$errors->first('slug')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      {!! Form::label('excerpt') !!}
                      {!! Form::textarea('excerpt', null, ['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                      {!! Form::label('body') !!}
                      {!! Form::textarea('body', null, ['class'=>'form-control'])!!}
                      @if($errors->has('body'))
                      <span class="help-block">{{$errors->first('body')}}</span>
                      @endif
                    </div>
                    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                      {!! Form::label('published_at','Publised Date') !!}
                      {!! Form::text('published_at', null, ['class'=>'form-control','placeholder'=>'Y-m-d H:i:s'])!!}
                      @if($errors->has('published_at'))
                      <span class="help-block">{{$errors->first('published_at')}}</span>
                      @endif
                    </div>
                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                      {!! Form::label('category_id','Category') !!}
                      {!! Form::select('category_id',App\Category::pluck('title','id'),null, ['class'=>'form-control','placeholder'=>'카테고리 선택'])!!}
                      @if($errors->has('category_id'))
                      <span class="help-block">{{$errors->first('category_id')}}</span>
                      @endif
                    </div>
                    <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                      {!! Form::label('image','파일 업로드') !!}
                      {!! Form::file('image')!!}
                      @if($errors->has('image'))
                      <span class="help-block">{{$errors->first('image')}}</span>
                      @endif
                    </div>
                    <hr>
                    <div class="form-group">
                      {!! Form::submit('확인', ['class'=>'btn btn-info']) !!}
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
	$('ul.pagination').addClass('no-margin pagination-sm');
</script>
@endsection
