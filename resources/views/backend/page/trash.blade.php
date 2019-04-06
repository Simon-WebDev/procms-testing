@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-microphone"></i> 공지사항<small>모든 공지사항</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.page.index')}}"><i class="fa fa-microphone"></i>공지사항</a></li>
      <li class="active">모든 공지사항</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
              <div class="pull-left">
                <a href="{{route('backend.page.create')}}" class="btn btn-success btn-labeled"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New</a>
                <a href="{{route('backend.page.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
                <a href="?status=trash" class="btn btn-danger btn-labeled"><span class="btn-label"><i class="fa fa-trash"></i></span>임시삭제</a>
              </div>
              <div class="pull-right">
                <form action="{{route('backend.page.index')}}" role="search" class="form-inline">
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
            <div class="box-body ">
              @include('backend.partials.message_pages')
              @if(!$pages->count() > 0)
              <div class="alert alert-danger text-center">
                <strong>데이터가 없습니다.</strong> <a href="{{URL::previous()}}" class="btn btn-sm bg-navy m-l-20" style="display: inline-block;"><i class="fa fa-rotate-left"></i> 뒤로</a>
              </div>
              @endif
              @if(count($pages)>0)
               <div class="table-responsive">
               	<table class="table table-bordered table-hover">
               		<tbody>
               			<tr>
                      <th>분류</th>
               				<th>제목</th>
               				<th>날짜</th>
               				<th>관리</th>
               			</tr>
               		</tbody>
               		<tbody>
               			@foreach($pages as $page)
               			<tr>
                      <td style="width:100px">{{$page->chapter->title}}</td>
               				<td>{{str_limit($page->title,30)}}</td>
               				<td style="width:100px">
                        <abbr title="{{$page->dateFormatted(true)}}">{{$page->dateFormatted(false)}}</abbr>
                      </td>
                     
               				<td style="width:200px">
       					        {!! Form::open(['style'=>'display:inline-block','method' => 'PUT', 'route'=>['backend.page.restore',$page->id]]) !!}
                            <button title="복원" type="submit" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i> 복원</button>
                        {!! Form::close() !!} 
               				
               				  {!! Form::open(['method'=>'DELETE','action'=>['Backend\PageController@forceDestroy',$page->id],'style'=>'display:inline']) !!}
               						<button type="submit" class="btn btn-danger btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))" title="영구삭제"><i class="fa fa-trash"></i>영구삭제</button>
               				  {!! Form::close() !!} 
               				</td>
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
                @endif
               </div>   
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pull-left">
                {{$pages->appends(Request::query())->render()}}
              </div>
              <div class="pull-right">
                {{-- <small>{{$pagesCount}} {{str_plural('Item',$pagesCount)}}</small> --}}
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





