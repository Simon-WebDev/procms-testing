@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      프로필
      <small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{route('edit-account')}}"><i class="fa fa-address-book-o"></i> 프로필</li></a>
      <li class="active">프로필 수정</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
       @include('backend.partials.message_posts')
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
{{-- @include('backend.users.script') --}}

