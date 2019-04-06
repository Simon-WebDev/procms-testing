<div class="col-xs-12">
  <div class="box">
    <div class="box-body ">
        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
          {!! Form::label('title','카테고리명') !!}
          {!! Form::text('title', null, ['class'=>'form-control'])!!}
          @if($errors->has('title'))
          <span class="help-block">{{$errors->first('title')}}</span>
          @endif
        </div>
        <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
          {!! Form::label('slug','슬러그') !!}
          {!! Form::text('slug', null, ['class'=>'form-control'])!!}
          @if($errors->has('slug'))
          <span class="help-block">{{$errors->first('slug')}}</span>
          @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>{{$category->exists ? "수정" : "저장"}}</button>
      <a href="{{route('backend.categories.index')}}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>취소</a>
    </div>
  </div>
  <!-- /.box -->
</div>
