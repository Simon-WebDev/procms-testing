@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> 회원정보
      <small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.users.index')}}"><i class="fa fa-users"></i>회원관리</a></li>
      <li class="active">회원정보수정</li>
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


