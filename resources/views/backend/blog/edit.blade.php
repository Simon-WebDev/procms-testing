@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-pencil"></i> 블로그
      <small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.blog.index')}}"><i class="fa fa-pencil"></i>블로그</a></li>
      <li class="active">블로그 수정</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        {!! Form::model($post, [
          'route' => ['backend.blog.update',$post->id],
          'method' => 'PUT',
          'files'  => TRUE,
          'id' =>'post-form'
        ]) !!}
        
        @include('backend.blog.form')

        {!! Form::close() !!}
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@include('backend.blog.script')