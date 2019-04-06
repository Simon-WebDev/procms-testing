@extends('layouts.backend.main')

@section('title')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-comments"></i> 게시판<small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.board.index')}}"><i class="fa fa-comments"></i>게시판</a></li>
      <li class="active">게시판수정</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <div class="box-body ">
               {!! Form::model($board,['method'=>'patch','action'=>['Backend\BoardController@update',$board->id],'files'=>true]) !!}
                  <div class="form-group {{$errors->has('group_id') ? 'has-error' : ''}}">
                    {!!  Form::label('group_id','게시판 선택')  !!}
                    {!!  Form::select('group_id',App\Group::pluck('title','id'),null, ['class'=>'form-control','placeholder'=>'게시판을 선택해 주세요'])  !!}
                    @if($errors->has('group_id'))
                    <span class="help-block">{{$errors->first('group_id')}}</span>
                    @endif
                  </div>
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                  {!!  Form::label('title',' 제목')  !!}
                  {!!  Form::text('title', null, ['class'=>'form-control','placeholder'=>'제목을 입력해 주세요'])  !!}
                  @if($errors->has('title'))
                  <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" id="slug-form-group">
                  {!!  Form::label('slug',' 슬러그')  !!}
                  {!!  Form::text('slug', null, ['class'=>'form-control'])  !!}
                </div>
                <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                  {!!  Form::label('body',' 내용')  !!}
                  {!!  Form::textarea('body', null, ['class'=>'form-control','placeholder'=>'내용을 입력해 주세요','rows'=>10])  !!}
                  @if($errors->has('body'))
                  <span class="help-block">{{$errors->first('body')}}</span>
                  @endif
                </div>
              
                  <div class="form-group {{$errors->has('image1') ? 'has-error' : ''}}">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{($board->image1_url) ? $board->image1_url : 'http://placehold.it/200x150&text=Image+File'}}" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">파일 선택</span><span class="fileinput-exists">파일 변경</span> 

                        {!! Form::file('image1')!!}</span>
                        {{-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">삭제</a> --}}
                      </div>
                    </div>
                   
                    @if($errors->has('image1'))
                    <span class="help-block">{{$errors->first('image1')}}</span>
                    @endif
                  </div>
                  
                  <div class="form-group {{$errors->has('image2') ? 'has-error' : ''}}">
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{($board->image2_url) ? $board->image2_url : 'http://placehold.it/200x150&text=Image+File'}}" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">파일 선택</span><span class="fileinput-exists">파일 변경</span> 
                         
                         {!! Form::file('image2')!!}</span>
                        
                        {{-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> --}}
                      </div>
                    </div>
                   
                    @if($errors->has('image2'))
                    <span class="help-block">{{$errors->first('image2')}}</span>
                    @endif
                  </div>
                 
                
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                  <a href="{{URL::previous()}}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>뒤로</a>
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

  //make slug title the same automatically
  $('#title').on('blur', function(){
    var theTitle = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        /*my custom*/
        // theSlug = theTitle.replace(/&/g,'-그리고-')
        //           .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
        //           .replace(/\-\-+/g, '-')
        //           .replace(/^-+|-+$/g,'');
        // console.log(theTitle);
        /*end my custom*/
        /*speakingurl add korean js*/
        theSlug = getSlug(theTitle);
        /*end speaking url add korean*/
    slugInput.val(theSlug);
  });
  //make slug disappeared
   $('#slug-form-group').css('display','none');

  //make textarea simplemde
  // var simplemde = new SimpleMDE({ element: document.getElementById("body") });

 
</script>
@endsection


