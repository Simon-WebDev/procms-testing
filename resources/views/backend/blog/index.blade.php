@extends('layouts.backend.main')
@section('title', 'MyBlog | Blog index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blog
      <small>Display All Blog Posts</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
      <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
      <li class="active">All Posts</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix">
          		<div class="pull-left">
                <a href="{{route('backend.blog.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
              </div>
              <div class="pull-right" style="padding: 10px;">
                <a href="?status=all">All</a> |
                <a href="?status=trash">Trash</a>
              </div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
              @include('backend.blog.message')
            	@if(!$postCount)
              	<div class="alert alert-danger">
              		<strong>Post Not Found</strong>
              	</div>
            	@else
                  @if($onlyTrashed)
                   @include('backend.blog.table-trash')
                  @else
                   @include('backend.blog.table')
                  @endif 
              @endif    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	<div class="pull-left">
            		{{$posts->links()}}
            	</div>
            	<div class="pull-right">
            		
            		<small>{{$postCount}} {{str_plural('item',$postCount)}}</small>
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
