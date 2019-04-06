@extends('layouts.main')


@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-12">
				<div class="error-box">
					<div class="error-image">
						<img src="{{asset('images/ban.png')}}" class="img-responsive">
					</div>
					<div class="error-message">
						<h5>권한이 없으십니다.!</h5>
						<h6>죄송합니다.</h6>
						<div class="text-center m-b-50">
							<a href="{{URL::previous()}}" class="btn btn-info"><i class="fa fa-rotate-left"></i> 이전으로</a>
							<a href="/" class="btn bg-navy"><i class="fa fa-home"></i> Home</a>
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