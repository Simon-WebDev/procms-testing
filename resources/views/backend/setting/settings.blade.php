  @extends('layouts.backend.main')
  @section('title')
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 323px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-wrench"></i> 설정
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('backend.setting.index')}}"><i class="fa fa-wrench"></i>설정</a></li>
        <li class="active">설정</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header clearfix">
              {{-- <div class="pull-left">
                <a href="{{route('backend.setting.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
              </div> --}}
              </div>  
              <div class="box-body ">
	             {!! Form::model($setting,['method'=>'post','action'=>'Backend\SettingController@update']) !!}
	           		<div class="form-group">
	           			{!!  Form::label('site_name','회사명')  !!}
	           			{!!  Form::text('site_name', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		<div class="form-group">
	           			{!!  Form::label('site_email','이메일')  !!}
	           			{!!  Form::text('site_email', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		<div class="form-group">
	           			{!!  Form::label('site_phone','전화번호')  !!}
	           			{!!  Form::text('site_phone', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		<div class="form-group">
	           			{!!  Form::label('site_address','주소')  !!}
	           			{!!  Form::text('site_address', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		<div class="form-group">
	           			{!!  Form::label('site_agreement','회원약관')  !!}
	           			{!!  Form::textarea('site_agreement', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		<div class="form-group">
	           			{!!  Form::label('site_privacy','개인정보취급방침')  !!}
	           			{!!  Form::textarea('site_privacy', null, ['class'=>'form-control'])  !!}
	           		</div>
	           		
	           		<div class="form-group">
	           			<button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                  <a href="{{URL::previous()}}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
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
<!-- tinymce -->
<script src="/admin/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin/plugins/tinymce/langs/ko_KR.js"></script>
<script>
  tinymce.init({
    selector: '#site_agreement',
    'plugins' : 'link'
    // language : 'ko',
  });
  tinymce.init({
    selector: '#site_privacy',
    'plugins' : 'link'
    // language : 'ko',
  });
</script>
@endsection







 