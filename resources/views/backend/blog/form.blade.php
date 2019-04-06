<div class="col-md-9">
  <div class="box">
    <div class="box-body ">
      <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title','제목') !!}
        {!! Form::text('title', null, ['class'=>'form-control','required'])!!}
        @if($errors->has('title'))
        <span class="help-block">{{$errors->first('title')}}</span>
        @endif
      </div>
      <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
        {!! Form::label('slug','슬러그') !!}
        {!! Form::text('slug', null, ['class'=>'form-control','required'])!!}
        @if($errors->has('slug'))
        <span class="help-block">{{$errors->first('slug')}}</span>
        @endif
      </div>
      <div class="form-group  excerpt">
        {!! Form::label('excerpt','개요') !!}
        {!! Form::textarea('excerpt', null, ['class'=>'form-control','rows'=>10])!!}
      </div>
      <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}  body">
        {!! Form::label('body','내용') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>30])!!}
        @if($errors->has('body'))
        <span class="help-block">{{$errors->first('body')}}</span>
        @endif
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<div class="col-md-3">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">발행</h3>
    </div>

    <div class="box-body">
      <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
        {!! Form::label('published_at','발행일선택') !!}
       
        <div class='input-group date' id='datetimepicker1'>
          {!! Form::text('published_at', null, ['class'=>'form-control','placeholder'=>'Y-m-d H:i:s'])!!}                 
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>                    
        @if($errors->has('published_at'))
        <span class="help-block">{{$errors->first('published_at')}}</span>
        @endif
      </div>
    </div>

    <div class="box-footer clearfix">
      <div class="pull-left">
        <a id="draft-btn" class="btn btn-default btn-labeled"><span class="btn-label"><i class="fa fa-hourglass-start"></i></span>Draft</a>
      </div>
      <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>Publish</button>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">카테고리</h3>
    </div>
    <div class="box-body">
      <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
        {!! Form::select('category_id',App\Category::pluck('title','id'),null, ['class'=>'form-control','placeholder'=>'카테고리 선택'])!!}
        @if($errors->has('category_id'))
        <span class="help-block">{{$errors->first('category_id')}}</span>
        @endif
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">이미지</h3>
    </div>
    <div class="box-body text-center">
      <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
        
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="{{($post->image_url) ? $post->image_url : 'http://placehold.it/200x150&text=No+Image'}}" alt="...">
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">파일선택</span><span class="fileinput-exists">변경</span> {!! Form::file('image')!!}</span>
            @if(Route::currentRouteName() == "backend.blog.create")
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">삭제</a>
            @endif
          </div>
        </div>
       
        @if($errors->has('image'))
        <span class="help-block">{{$errors->first('image')}}</span>
        @endif
      </div>
    </div>
  </div>
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Tags</h3>
      </div>
      <div class="box-body">
          <div class="form-group">
             {!! Form::text('post_tags', null, ['class' => 'form-control']) !!}                
          </div>
      </div>
  </div>
</div>