@extends('layouts.backend.main')

@section('title')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-paint-brush"></i> 블로그댓글<small>수정</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.answer.index')}}"><i class="fa fa-paint-brush"></i>블로그댓글</a></li>
      <li class="active">블로그댓글 수정</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
      
          <div class="box">
            
            <div class="box-body ">
                  {!! Form::model($comment,['method'=>'patch','action'=>['Backend\CommentController@update',$comment->id]]) !!}
                    <div class="form-group">
                      {!!  Form::label('author_name','이름')  !!}
                      {!!  Form::text('author_name', null, ['class'=>'form-control'])  !!}
                    </div>
                    <div class="form-group">
                      {!!  Form::label('author_email','이메일')  !!}
                      {!!  Form::text('author_email', null, ['class'=>'form-control'])  !!}
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="board_id" value="{{$comment->post->id}}">
                      {!!  Form::label('body','내용')  !!}
                      {!!  Form::textarea('body', null, ['class'=>'form-control'])  !!}
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                      <a href="{{URL::previous()}}" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
                      <a href="{{route('backend.comment.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
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


