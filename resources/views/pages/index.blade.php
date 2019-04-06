@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('content')


<section class="inner-header" id="page-header">
	<div class="inner-header-caption">
		<h1 class="text-center">
		  공지사항
		  <small>small</small>
		</h1>
		<ol class="breadcrumb text-center">
		  <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
		  <li><a href="{{route('pages.index')}}"><i class="fa fa-microphone"></i> 공지사항</a></li>
		  <li class="active">공지사항</li>
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
				<div id="isotope">
					@foreach($pages as $page)	
					<div class="item col-md-4 col-sm-6">
						<div class="blog-grid-post">
							<div class="post-thumb">
								<a href="{{route('pages.show',$page->id)}}"><i class="fa fa-link"></i></a>
								@if($page->image_url)
								<img src="{{$page->image_url}}" class="img-responsive">
								@endif
							</div>
							
							<div class="post-excerpt">
								<strong class="date">{{$page->user->name}} / <span><i class="fa fa-calendar"></i> {{$page->created_at->format('Y-m-d')}}</span> / <span><i class="fa fa-eye"></i> {{$page->view_count}}</span></strong>
								<h4>
									<a href="{{route('pages.show',$page->id)}}">{{$page->title}}</a>
								</h4>
								<p class="page-excerpt">{!! str_limit($page->excerpt,100) !!}</p>
								<a href="{{route('pages.show',$page->id)}}" class="bd">자세히 <i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
					@endforeach

					
				</div>
				<nav class="text-center">
					{{$pages->appends(Request::query())->render()}}
				</nav>

				<div class="text-center m-b-20">
				    <form action="{{route('pages.index')}}" role="search" class="form-inline">
				        <div class="input-group">
				            <input type="text" name="term" value="{{Request::get('term')}}" class="form-control" placeholder="검색" required>
				            <span class="input-group-btn"><button class="btn btn-default" type="submit">
				                <i class="fa fa-search"></i>
				            </button>
				            </span>
				        </div>
				    </form>
				</div>
			</div>
	</div>
</div>	

@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection

@section('script')
<script>
	var $pages = $('#isotope').isotope({
	  itemSelector : '.item',
	  percentPostion: true,
	  // layoutMode : 'masonry'
	  masonry : {
	  	columnWidth : 1
	  }
	});
	$pages.imagesLoaded().progress( function() {
	    $pages.isotope('layout');
	});

	
	        //전체주소
	        //console.log("url : "+$(location).attr('href'));
	 
	        //http:, localhost:port번호, index.html ?test=tttt 순으로 나누어져 있습니다.
	        // console.log("url : "+$(location).attr('protocol')+"//"+$(location).attr('host')+""+$(location).attr('pathname')+""+$(location).attr('search'));

	        // console.log($('.iso-filter').attr('href'));

	
	$('.iso-filter').each(function(){
		var urlString = "{{url()->full()}}";
		urlString = urlString.split('?')[0];
		
		if ($(this).attr('href') == urlString) {
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