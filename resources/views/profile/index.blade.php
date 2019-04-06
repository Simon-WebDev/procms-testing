@extends('layouts.main')




@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-sm-12">
			<div class="box box-widget widget-user" id="profile-index-box">
			            <!-- Add the bg color to the header using any of the bg-* classes -->
			            <div class="widget-user-header bg-aqua-active">
			              <h3 class="widget-user-username">{{$user->name}}</h3>
			              <h5 class="widget-user-desc">Since {{$user->created_at->format('Y/m')}}</h5>
			            </div>
			            <div class="widget-user-image">
			              <img class="img-circle" src="{{asset('images/customer.png')}}" alt="User Avatar">
			            </div>
			            <div class="box-footer">
			              <div class="row">
			                <div class="col-sm-4 border-right">
			                  <div class="description-block">
			                    <h5 class="description-header">{{$user->boards->count()}}</h5>
			                    <span class="description-text">게시판글</span>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-sm-4 border-right">
			                  <div class="description-block">
			                    <h5 class="description-header m-b-10">{{$user->name}}</h5>
			                    <span class="description-text"><a href="{{route('profile.edit',$user->slug)}}" class="btn bg-yellow btn-sm btn-labeled"><span class="btn-label"><i class="fa fa-address-card"></i></span>프로필수정</a></span>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-sm-4">
			                  <div class="description-block">
			                    <h5 class="description-header">{{$user->email}}</h5>
			                    <span class="description-text">이메일</span>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			              </div>
			              <!-- /.row -->
			            </div>
			            <div class="box-footer">
			            	<div class="row">
			            		<div class="col-xs-12">
			            			<div class="text-center m-b-20">
			            				<a href="/" class="btn btn-primary btn-sm m-r-5 btn-labeled"><span class="btn-label"><i class="fa fa-home"></i></span>홈페이지</a>
			            				<a href="{{URL::previous()}}" class="btn btn-default btn-sm btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
			            			</div>
			            		</div>
			            	</div>
			            </div>
			          </div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script>
	$('#mainFooter, #footer-bar').css('display','none');
</script>
@endsection