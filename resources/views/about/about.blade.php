@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection


@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 hidden-xs">
			<img src="{{asset('images/notice3.jpg')}}" class="img-responsive">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<h3>Welcome To</h3>
			<h2>Medicative Hospital</h2>
			<p style="font-weight: bold;"  class="m-t-20">
				One of the world's leading hospitals providing safe & compassionate care at its best for everyone. Atque commodi molestiae consectetur.
			</p>
			<p  class="m-t-50">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque commodi molestiae autem fugit consectetur dolor ullam illo ipsa numquam, quod iusto enim ipsum amet iusto amet conse
			</p>
			
		</div>
		<div class="col-md-6">
			<img src="{{asset('images/doctor-png.png')}}" class="img-responsive">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<img src="{{asset('images/doctor01.jpg')}}" alt="" class="img-responsive">
		</div>
		<div class="col-md-6">
			<h2>Title comes here</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet aliquid illum consequatur dolores pariatur ad, suscipit quisquam debitis iste voluptatum, illo vitae voluptas exercitationem iure sed veniam porro minima, dicta? ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<hr>
			<p style="font-weight: bold;"  class="m-t-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<ul class="timeline">
			            <!-- timeline time label -->
			            <li class="time-label">
			                  <span class="bg-red">
			                    10 Feb. 2014
			                  </span>
			            </li>
			            <!-- /.timeline-label -->
			            <!-- timeline item -->
			            <li>
			              <i class="fa fa-envelope bg-blue"></i>

			              <div class="timeline-item">
			                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

			                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

			                <div class="timeline-body">
			                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
			                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
			                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
			                  quora plaxo ideeli hulu weebly balihoo...
			                </div>
			                <div class="timeline-footer">
			                  <a class="btn btn-primary btn-xs">Read more</a>
			                  <a class="btn btn-danger btn-xs">Delete</a>
			                </div>
			              </div>
			            </li>
			            <!-- END timeline item -->
			            <!-- timeline item -->
			            <li>
			              <i class="fa fa-user bg-aqua"></i>

			              <div class="timeline-item">
			                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

			                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
			              </div>
			            </li>
			            <!-- END timeline item -->
			            <!-- timeline item -->
			            <li>
			              <i class="fa fa-comments bg-yellow"></i>

			              <div class="timeline-item">
			                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

			                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

			                <div class="timeline-body">
			                  Take me to your leader!
			                  Switzerland is small and neutral!
			                  We are more like Germany, ambitious and misunderstood!
			                </div>
			                <div class="timeline-footer">
			                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
			                </div>
			              </div>
			            </li>
			            <!-- END timeline item -->
			            <!-- timeline time label -->
			            <li class="time-label">
			                  <span class="bg-green">
			                    3 Jan. 2014
			                  </span>
			            </li>
			            <!-- /.timeline-label -->
			            <!-- timeline item -->
			            <li>
			              <i class="fa fa-camera bg-purple"></i>

			              <div class="timeline-item">
			                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

			                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

			                <div class="timeline-body">
			                  <img src="http://placehold.it/150x100" alt="..." class="margin">
			                  <img src="http://placehold.it/150x100" alt="..." class="margin">
			                  <img src="http://placehold.it/150x100" alt="..." class="margin">
			                  <img src="http://placehold.it/150x100" alt="..." class="margin">
			                </div>
			              </div>
			            </li>
			            <!-- END timeline item -->
			            <!-- timeline item -->
			            <li>
			              <i class="fa fa-video-camera bg-maroon"></i>

			              <div class="timeline-item">
			                <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>

			                <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

			                <div class="timeline-body">
			                  <div class="embed-responsive embed-responsive-16by9">
			                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen=""></iframe>
			                  </div>
			                </div>
			                <div class="timeline-footer">
			                  <a href="#" class="btn btn-xs bg-maroon">See comments</a>
			                </div>
			              </div>
			            </li>
			            <!-- END timeline item -->
			            <li>
			              <i class="fa fa-clock-o bg-gray"></i>
			            </li>
			          </ul>
		</div>
	</div>
</div>
@endsection


@section('mainfooter')
    @include('layouts.mainfooter')
@endsection