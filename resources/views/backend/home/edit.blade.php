@extends('layouts.backend.main')
@section('title', 'MyBlog | Edit Account')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Account
      <small>Edit Account</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li class="active">Edit Account</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
       @include('backend.partials.message')
        {!! Form::model($user, [
          'url' => 'edit-account',
          'method' => 'PUT'
          
        ]) !!}
        
        @include('backend.users.form',['hideRoleDropdown'=>true])

        {!! Form::close() !!}
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@include('backend.users.script')

