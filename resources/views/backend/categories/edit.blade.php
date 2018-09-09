@extends('layouts.backend.main')
@section('title', 'MyBlog | Edit Category')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Category
      <small>Edit Category</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.categories.index')}}">Categories</a></li>
      <li class="active">Edit Category</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        {!! Form::model($category, [
          'route' => ['backend.categories.update',$category->id],
          'method' => 'PUT',
          'files'  => TRUE,
          'id' =>'post-form'
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