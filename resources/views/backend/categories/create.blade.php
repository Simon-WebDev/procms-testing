@extends('layouts.backend.main')
@section('title', 'MyBlog | Category Create')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Category
      <small>Add New Category</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.categories.index')}}">Category</a></li>
      <li class="active">New Category</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        {!! Form::model($category, [
          'route' => 'backend.categories.store',
          'method' => 'POST',
          'files'  => TRUE,
          'id' =>'category-form'
        ]) !!}
        
        @include('backend.categories.form')

        {!! Form::close() !!}
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@include('backend.categories.script')