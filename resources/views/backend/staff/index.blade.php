@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user-md"></i> 스텝<small>모든 스텝</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.staff.index')}}"><i class="fa fa-user-md"></i> 스텝</a></li>
      <li class="active">모든스텝</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            <div class="pull-left">
              <a href="{{route('backend.staff.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
            </div>
            </div>  
            <div class="box-body ">
              @if(!$staffsCount)
                <div class="alert alert-danger text-center">
                  <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
                </div>
              @endif
               <div class="table-responsive">
               	<table class="table table-hover table-bordered">
               		<tbody>
               			<tr>
               				<th>이름</th>
               				<th>전공</th>
               				<th>색상</th>
               				<th>관리</th>
               				
               			</tr>
               		</tbody>
               		<tbody>
               			@foreach($staffs as $staff)
               			<tr>
               				<td>{{$staff->name}}</td>
               				<td>{{$staff->major}}</td>
               				<td><span class="label" style="background-color: {{$staff->color}}; padding:5px 10px;">{!! $staff->color !!}</span></td>
               				<td>
               					<a href="{{route('backend.staff.edit', $staff->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 수정</a>
               				
               				  {!! Form::open(['method'=>'delete','action'=>['Backend\StaffController@destroy',$staff->id],'style'=>'display:inline']) !!}
               						<button type="submit" class="btn btn-danger btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))"><i class="fa fa-trash"></i> 삭제</button>
               				  {!! Form::close() !!} 
               				</td>
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
               
               </div>   
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pull-left">
                {{$staffs->links()}}
              </div>
              <div class="pull-right">
                <small>{{$staffsCount}} {{str_plural('item',$staffsCount)}}</small>
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





