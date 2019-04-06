@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      공지사항분류
      <small>작성</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.chapter.index')}}"><i class="fa fa-bell"></i>공지사항분류</a></li>
      <li class="active">공지사항분류 작성</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        {!! Form::model($chapter, [
          'route' => 'backend.chapter.store',
          'method' => 'POST',
          'files'  => TRUE,
          'id' =>'chapter-form'
        ]) !!}
        
        @include('backend.chapters.form')

        {!! Form::close() !!}
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@include('backend.chapters.script')