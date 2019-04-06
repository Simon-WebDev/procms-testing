@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user-md"></i> 스텝<small>작성</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.staff.index')}}"><i class="fa fa-user-md"></i>스텝</a></li>
      <li class="active">스텝 작성</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
            <div class="pull-left">
              {{-- <a href="{{route('backend.board.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a> --}}
            </div>
            </div>  
            <div class="box-body ">
                {!! Form::open(['method'=>'post','action'=>'Backend\StaffController@store']) !!}
                  <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                    {!!  Form::label('name','이름')  !!}
                    {!!  Form::text('name', null, ['class'=>'form-control'])  !!}
                    @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('major') ? 'has-error' : ''}}">
                    {!!  Form::label('major','전공')  !!}
                    {!!  Form::text('major', null, ['class'=>'form-control'])  !!}
                    @if($errors->has('major'))
                    <span class="help-block">{{$errors->first('major')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('color') ? 'has-error' : ''}}">
                        {{ Form::label('color', '색상') }}
                        <div class="input-group colorpicker">
                            {{ Form::text('color', old('color'), ['class' => 'form-control']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-eyedropper"></i>
                            </span>
                        </div>
                        @if($errors->has('color'))
                        <span class="help-block">{{$errors->first('color')}}</span>
                        @endif
                    </div>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                    <a href="{{URL::previous()}}" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
                  </div>
                  
                {!! Form::close() !!}    
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
  
      $('.colorpicker').colorpicker();
   
   </script>

@endsection


