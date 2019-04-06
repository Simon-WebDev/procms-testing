@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tasks"></i> 게시판 분류
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.group.index')}}"><i class="fa fa-tasks"></i> 게시판 분류</a></li>
      <li class="active">모든 게시판분류</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            <div class="pull-left">
              <a href="{{route('backend.group.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
              <a href="{{route('backend.group.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
            </div>
            </div>  
            <div class="alert alert-danger">
              분류 삭제할때 게시판글의 삭제처리문제로 아직 삭제 기능 정하지 않음.게시판분류 slug는 speaking url로 처리함. 
            </div>
            <div class="box-body ">
              @if(!$groupsCount)
               <div class="alert alert-danger text-center">
                 <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
               </div>
              @endif 
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>게시판 제목</th>
                      <th width="100">공개</th>
                      <th width="100">날짜</th>
                      <th width="150">관리</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($groups)>0)
                    @foreach($groups as $group)
                    <tr>
                      <td>{{$group->title}}</td>
                      <td>@if($group->is_open)  공개 @else 비공개@endif</td>
                      <td><abbr title="{{$group->dateFormatted(true)}}">{{$group->dateFormatted(false)}}</abbr></td>
                      <td>
                        <a href="{{route('backend.group.edit', $group->id)}}" class="btn btn-info btn-sm" style="color:#fff;"><i class="fa fa-edit"></i> 수정</a>
                        {!! Form::open(['method'=>'delete','action'=>['Backend\GroupController@destroy',$group->id],'style'=>'display:inline']) !!}
                             <button type="submit" class="btn btn-danger btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))"><i class="fa fa-times"></i> 삭제</button>
                        {!! Form::close() !!} 
                      </td>
                    </tr>
                   @endforeach
                   @endif 
                  </tbody>
                </table>
              </div>   
            </div>
            <div class="box-footer clearfix">
              <div class="pull-left">
                  {{$groups->appends(Request::query())->render()}}
              </div>
              <div class="pull-right">
                
                <small>{{$groupsCount}} {{str_plural('item',$groupsCount)}}</small>
              </div>
              
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
