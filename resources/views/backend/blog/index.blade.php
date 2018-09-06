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
          	<div class="box-header">
          		<div class="pull-left"><a href="{{route('backend.blog.create')}}" class="btn btn-success">Add New</a></div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
            	@if(!$postCount)
            	<div class="alert alert-danger">
            		<strong>Post Not Found</strong>
            	</div>
            	@else
                  <table class="table table-bordered">
                  	<thead>
                  		<tr>
                  			<th width="80">Auction</th>
                  			<th>Title</th>
                  			<th width="120">Author</th>
                  			<th width="150">Category</th>
                  			<th width="170">Date</th>
                  		</tr>
                  	</thead>
                  	<tbody>
                  		@foreach($posts as $post)
                  		<tr>
                  			<td>
                  				<a href="{{route('backend.blog.edit', $post->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                  				<a href="{{route('backend.blog.destroy', $post->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                  			</td>
                  			<td>{{$post->title}}</td>
                  			<td>{{$post->author->name}}</td>
                  			<td>{{$post->category->title}}</td>
                  			<td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;&nbsp;{!! $post->publicationLabel() !!}</td>
                  		</tr>
                  		@endforeach
                  	</tbody>
                  </table>
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
            @endif
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
