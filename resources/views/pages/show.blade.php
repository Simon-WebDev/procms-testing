@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('content')

<section class="inner-header">
	<div class="inner-header-caption">
		<h1 class="text-center">
		  공지사항
		  <small>small</small>
		</h1>
		<ol class="breadcrumb text-center">
		  <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
		  <li><a href="{{route('pages.index')}}"><i class="fa fa-microphone"></i> 공지사항</a></li>
		  <li class="active">공지사항 보기</li>
		</ol>
	</div>
</section>


<div class="container">
	<div class="row">
	    <div class="col-xs-12">
	    	<div class="filter-container btn-group">
	    	    <a href="{{route('pages.index')}}" class="active iso-filter btn btn-default">ALL</a>
		    	@foreach($chapters as $chapter)
	    	    <a href="{{route('chapter', $chapter->id)}}" class="iso-filter btn btn-default">{{$chapter->title}}</a>
		    	@endforeach
	    	</div>
	    </div>
		<div class="col-xs-12">
			<div class="page-show">
				@if($page->image_url)
				<div><img src="{{$page->image_url}}" class="img-responsive page-img"></div>
				@endif
				<h2>{{$page->title}}</h2>
				<hr>
				<p class="page-show-info">
					<span><i class="fa fa-calendar m-r-10"></i> {{$page->created_at->format('Y/m/d')}}</span> / <span><img src="{{$page->user->gravatar()}}" class="img-circle"> {{$page->user->name}}</span> / <span><i class="fa fa-eye"></i> {{$page->view_count}}</span>
				</p>
				<hr>
				<div class="post-show-content">
					{!! $page->body !!}
				</div>
				
			</div>
			
		</div>
		<div class="col-xs-12">
			<hr>
		    <div class="page-indi clearfix">
		        <div class="col-xs-6">
		        	@if(!is_null($prev_page))
		            <a href="{{route('pages.show',$prev_page->id)}}"><i class="fa fa-chevron-left 2x"></i> 이전글
		            <h4>{{str_limit($prev_page->title,30)}}</h4>
					</a>
					@else
					이전글이 없습니다.
		            @endif
		        </div>
		        <div class="col-xs-6">
		        	@if(!is_null($next_page))
		            <a href="{{route('pages.show',$next_page->id)}}"> <span>다음글 <i class="fa fa-chevron-right 2x"></i></span>
		            <h4>{{str_limit($next_page->title,30)}} </h4>
		            </a>
		            @else
		            다음글이 없습니다.
		            @endif
		        </div>
		    </div>
		    <hr>
		    <a href="{{route('pages.index')}}" class="btn btn-warning btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
		    <a href="{{URL::previous()}}" class="btn btn-labeled btn-default m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>뒤로</a>
		    <hr>	
		</div>
	</div>
</div>		

@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection


@section('script')
<script>
	// images in post content 
	$('.post-show-content img').addClass('img-responsive');


	//sidebar addclass active
	$('.iso-filter').each(function(){
		var chapterTitle = "{{$page->chapter->title}}";

		if ($(this).text().trim() == chapterTitle) {
			$('.iso-filter').removeClass('active');
			$(this).addClass('active');
		}
		
	});
	// console.log($(location).attr('href'));
	if ($(this).attr('href') == $(location).attr('href')) {
		$(this).addClass('active');
	}


</script>
@endsection