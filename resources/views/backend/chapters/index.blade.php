@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-bell"></i> 공지사항분류
      <small>공지사항분류</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="{{route('backend.chapter.index')}}"><i class="fa fa-bell"></i>공지사항분류</a>
      </li>
      <li class="active">공지사항분류</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix">
          		<div class="pull-left">
                <a href="{{route('backend.chapter.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
                
              </div>
              <div class="pull-right">
               
              </div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
              @include('backend.partials.message_posts')
            	@if(!$chapters->count())
              	<div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
            	@else
                <div class="table-responsive">
                   @include('backend.chapters.table')
                </div>   
              @endif    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	<div class="pull-left">
            		{{$chapters->appends(Request::query())->links()}}
            	</div>
            	<div class="pull-right">
            		
            		<small>{{$chaptersCount}} {{str_plural('item',$chaptersCount)}}</small>
            	</div>
            	
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


@section('script')
<script>
	$('ul.pagination').addClass('no-margin pagination-sm');
</script>
@endsection
