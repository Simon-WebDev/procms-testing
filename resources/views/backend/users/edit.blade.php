@extends('layouts.backend.main')
@section('title', 'MyBlog | Edit User')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User
      <small>Edit User</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.users.index')}}">Users</a></li>
      <li class="active">Edit User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        {!! Form::model($user, [
          'route' => ['backend.users.update',$user->id],
          'method' => 'PUT',
          'files'  => TRUE,
          'id' =>'user-form'
        ]) !!}
        
        @include('backend.users.form')

        {!! Form::close() !!}
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@include('backend.users.script')

