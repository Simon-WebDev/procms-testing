@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> 회원관리
      <small>모든회원</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="{{route('backend.users.index')}}"><i class="fa fa-users"></i>회원관리</a>
      </li>
      <li class="active">모든 회원</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header clearfix">
          		<div class="pull-left">
                <a href="{{route('backend.users.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
                <a href="{{route('backend.users.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
              </div>
              <div class="pull-right">
                <form action="{{route('backend.users.index')}}" role="search" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control input-sm" placeholder="검색" requried>
                        <span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                </form>
              </div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body ">
              @include('backend.partials.message_posts')
            	@if(!$users->count())
              	<div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
            	@else
                   <div class="table-responsive">
                   @include('backend.users.table')
                   </div>
              @endif    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            	<div class="pull-left">
            		{{$users->appends(Request::query())->links()}}
            	</div>
            	<div class="pull-right">
            		
            		<small>{{$usersCount}} {{str_plural('User',$usersCount)}}</small>
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



