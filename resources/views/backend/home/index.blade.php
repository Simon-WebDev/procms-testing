@extends('layouts.backend.main')
@section('title')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-dashboard"></i> Dasbhboard
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\User::count()}}</h3>

              <p>회원관리</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('backend.users.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\Post::count()}}</h3>

              <p>블로그</p>
            </div>
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <a href="{{route('backend.blog.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{App\Page::count()}}</h3>

              <p>공지사항</p>
            </div>
            <div class="icon">
              <i class="fa fa-microphone"></i>
            </div>
            <a href="{{route('backend.page.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{App\Board::count()}}</h3>

              <p>게시판</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments"></i>
            </div>
            <a href="{{route('backend.board.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    <!-- ./row -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{App\Answer::count()}}</h3>

              <p>게시판답글</p>
            </div>
            <div class="icon">
              <i class="fa fa-bullhorn"></i>
            </div>
            <a href="{{route('backend.answer.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{App\Reservation::count()}}</h3>

              <p>예약</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="{{route('backend.reservation')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\Staff::count()}}</h3>

              <p>스텝</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <a href="{{route('backend.staff.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>파일</h3>

              <p>파일관리</p>
            </div>
            <div class="icon">
              <i class="fa fa-image"></i>
            </div>
            <a href="{{route('backend.media.index')}}" class="small-box-footer">자세히 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- ./row -->
      <div class="row">
        <div class="col-xs-12">

         
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">게시판 새 글</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  @php
                  $new_boards = [];
                  @endphp

                  @foreach(Auth::user()->unreadNotifications as $unreadNotification)
                    @php
                      if ($unreadNotification->type =="App\\Notifications\\NewWriteNotification") {
                        $new_boards[] = $unreadNotification;
                      }
                      
                    @endphp
                  @endforeach

                  @if( count($new_boards) > 0)    
                    @foreach($new_boards as $new_board)
                      
                   <a href="{{route('backend.answer.create',$new_board['data']['board_id'])}}" class="btn btn-info btn-block"><span>{{$new_board['created_at']}}</span>, "<span>{{str_limit($new_board['data']['new_board_title'],40)}}</span>" 라는 제목으로 "<span>{{$new_board['data']['user']['name']}}</span>"님이 새 게시판글을 작성하셨읍니다</a>





                    @endforeach
                  @else
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-ban"></i>
                    게시판에 새 글이 없습니다
                  </div>
                  @endif

                </div>
                <!-- /.box-body -->
              </div>
         

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">월별회원가입</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                <div class="morris-hover morris-default-style" style="left: 17.5156px; top: 160px; display: none;">
                  <div class="morris-hover-row-label">2011 Q1</div>
                  <div class="morris-hover-point" style="color: #3c8dbc">
                    Item 1:
                    2,666
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        
        <div class="col-xs-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">최근 1개월 게시판, 댓글</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body chart-responsive">
                  {!! $chart->container() !!}
              </div>
              <!-- /.box-body -->
            </div>
        </div>


        
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection




@section('script')
<script src="{{asset('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/plugins/morris.js/morris.min.js')}}"></script>
<script>
   
      Morris.Line({
      // ID of the element in which to draw the chart.
       element: 'line-chart',
   
      //Chart data records -- each entry in this array corresponds to a point
      //on the chart.
    
      data:{!! $morris_users !!},

     
      //The name of the data record attribute that contains x-values.
      xkey: 'month',
   
      //A list of names of data record attributes that contain y-values.
      ykeys: ['date'],
   
      //Labels for the ykeys -- will be displayed when you hover over the
      //chart.
      labels: ['Count'],
   
      lineColors: ['#0b62a4'],
      xLabels: 'month',
   
      //Disables line smoothing
      smooth: true,
      resize: true,
  }); 


    
</script>

{!! $chart->script() !!}   

@endsection
 