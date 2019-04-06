@extends('layouts.backend.main')
@section('title', '카테고리 | 관리')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-folder-open"></i> 카테고리
      <small>모든 카테고리</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="{{route('backend.categories.index')}}"><i class="fa fa-folder-open"></i>카테고리</a>
      </li>
      <li class="active">모든 카테고리</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix">
          		<div class="pull-left">
                <a href="{{route('backend.categories.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
                <a href="{{route('backend.categories.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              </div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
              @include('backend.partials.message_posts')
            	@if(!$categories->count())
              	<div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
            	@else
                <div class="table-responsive">
                   @include('backend.categories.table')
                </div>   
              @endif    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	<div class="pull-left">
            		{{$categories->appends(Request::query())->links()}}
            	</div>
            	<div class="pull-right">
            		<small>{{$categoriesCount}} {{str_plural('item',$categoriesCount)}}</small>
            	</div>
            </div>
            
          </div>
          <div class="box box-success box-solid collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-info"></i> Tips</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
              
                <p>카테고리 삭제시, 관련 글은 디폴트 카테고리로 전환되어 존속합니다. 디폴트 카테고리는 삭제할 수 없도록 처리 되었습니다. </p>
              
            </div>
            <!-- /.box-body -->
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
