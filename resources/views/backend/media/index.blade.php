@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-image"></i> 파일관리
      <small>관리</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li><a href="{{route('backend.media.index')}}"><i class="fa fa-image"></i>파일관리</a></li>
      <li class="active">관리</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix"></div>
            <!-- /.box-header -->
            <div class="box-body ">
              <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	
            	
            </div>
           
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


