@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection


@section('content')


<section class="inner-header" id="reser-header">
    <div class="inner-header-caption">
        <h1 class="text-center">
          게시판
          <small>small</small>
        </h1>
        <ol class="breadcrumb text-center">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="{{route('board.index')}}"><i class="fa fa-comments"></i> 게시판</a></li>
          <li class="active">게시판 쓰기</li>
        </ol>
    </div>
</section>
 


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pencil"></i> 게시판 글 쓰기</h3>
                </div>
                @if(session('message'))
                    <div class="alert alert-info alert-dismissible">
                    {{ session('message') }}
                    </div>
                @endif
                @include('includes.errors')
                <div class="box-body"> 
                {!! Form::open(['route' =>'board.store','data-toggle' => "validator",'role'=>'form','files'=>true]) !!}
                    <div class="form-group required has-feedback {{$errors->has('group_id') ? 'has-error' : ''}}">
                        {!!  Form::label('group_id','게시판 선택')  !!}
                        {!!  Form::select('group_id',App\Group::pluck('title','id'),null, ['class'=>'form-control','placeholder'=>'게시판을 선택해 주세요','required'])  !!}
                        @if($errors->has('group_id'))
                        <span class="help-block form-group-feedback" aria-hidden="true">
                        <strong>{{ $errors->first('group_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group required has-feedback{{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">제목</label>
                        {!! Form::text('title', null, ['class' => 'form-control','required','maxlength'=>'100','placeholder'=>'제목을 입력해 주세요']) !!}
                        @if($errors->has('title'))
                        <span class="help-block form-group-feedback" aria-hidden="true">
                        <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group" id="slug-form-group">
                        {!!  Form::label('slug',' 슬러그')  !!}
                        {!!  Form::text('slug', null, ['class'=>'form-control'])  !!}
                    </div>
                    <div class="form-group required has-feedback{{ $errors->has('body') ? 'has-error' : '' }}">
                        {!!  Form::label('body',' 내용')  !!}
                        {{-- <label for="body">내용</label> --}}
                        {!! Form::textarea('body', null, ['row' => 6, 'class' => 'form-control','required','placeholder'=>'내용을 입력해 주세요']) !!}
                        @if($errors->has('body'))
                        <span class="help-block  form-group-feedback" aria-hidden="true"">
                        <strong>{{ $errors->first('body') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('image1') ? 'has-error' : ''}}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://placehold.it/200x150&text=No+Image" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        
                                    </div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">파일 선택</span><span class="fileinput-exists">파일 변경</span> 

                                        {!! Form::file('image1')!!}</span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">삭제</a>
                                    </div>
                                </div>
                                @if($errors->has('image1'))
                                <span class="help-block">{{$errors->first('image1')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('image2') ? 'has-error' : ''}}">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://placehold.it/200x150&text=No+Image" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        
                                    </div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">파일 선택</span><span class="fileinput-exists">파일 변경</span> 

                                        {!! Form::file('image2')!!}</span>

                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                @if($errors->has('image2'))
                                <span class="help-block">{{$errors->first('image2')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    

                    


                    <div class="form-group m-t-20">
                        <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                        <a href="{{URL::previous()}}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>뒤로</a>
                        <a href="{{route('board.index')}}" class="btn btn-warning btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
                        <div class="pull-right">
                            <p class="text-muted">
                            <span class="required">*</span>
                            <em>필수 입력사항 입니다</em>
                            </p>
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div> 


        {{--   @include('layouts.comments') --}}
        </div>
   {{--  @include('board.sidebar') --}}
    </div>
</div>
@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection

@section('script')
{{-- bootstrap validator --}}
<script src="{{asset('js/validator.min.js')}}"></script>
{{-- end bootstrap validator --}}
<script>
$('#slug-form-group').css('display','none');
</script>
@endsection





  
