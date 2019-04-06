@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-pencil"></i> 블로그
      <small>블로그글</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li><a href="{{route('backend.blog.index')}}"><i class="fa fa-pencil"></i>블로그</a></li>
      <li class="active">블로그글</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix">
          		<div class="pull-left">
                <a href="{{route('backend.blog.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
                <a href="{{route('backend.blog.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              </div>
              <div class="pull-right" style="padding: 10px;">
                @php $links = []; @endphp
                @foreach($statusList as $key => $value)
                  @if($value)
                    @php  
                    $selected = Request::get('status') == $key ? 'selected-status' : '';
                    $links[] = "<a class=\"{$selected}\" href=\"?status={$key}\">".ucwords($key)."({$value})</a>" ; 
                    @endphp
                  @endif
                @endforeach
                {!! implode(' | ', $links) !!}
              </div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
              @include('backend.partials.message_posts')
            	@if(!$postCount)
              	<div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<strong>데이터가 없습니다</strong>
              	</div>
            	@else
                  @if($onlyTrashed)
                   @include('backend.blog.table-trash')
                  @else
                   <div class="table-responsive">
                     @include('backend.blog.table')
                   </div>
                  @endif 
              @endif    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	<div class="pull-left">
            		{{$posts->appends(Request::query())->links()}}
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

@endsection
