@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{route('blog')}}">블로그</a></h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed table-hover">
                        <tbody>
                            <tr>
                                <th>이페이지 콘트롤러에서 post는 published된것만 보여줘야 </th>
                                <th>날짜</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                               <td><a href="{{route('blog.show',$post->slug)}}">{{str_limit($post->title,24)}}</a></td>
                                <td>{{$post->created_at->format('Y/m/d')}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{route('board.index')}}">게시판</a></h3>
                </div>
                role, permission등 문제로 바로 show route로 링크 못건다.
                <div class="box-body">
                    <table class="table table-condensed table-hover">
                        <tbody>
                            <tr>
                                <th>제목</th>
                                <th>날짜</th>
                            </tr>
                            @foreach($boards as $board)
                            <tr>
                               <td><a href="{{route('board.index')}}">{{str_limit($board->title,24)}}</a></td>
                                <td>{{$board->created_at->format('Y/m/d')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{route('pages.index')}}">공지사항</a></h3>
                </div>
                
                <div class="box-body">
                    <table class="table table-condensed table-hover">
                        <tbody>
                            <tr>
                                <th>제목</th>
                                <th>날짜</th>
                            </tr>
                            @foreach($pages as $page)
                            <tr>
                               <td><a href="{{route('pages.show',$page->id)}}">{{str_limit($page->title,24)}}</a></td>
                                <td>{{$page->created_at->format('Y/m/d')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  {{-- end row --}}

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{route('reservation.view')}}">예약</a></h3>
                </div>
                
                <div class="box-body">
                    <table class="table table-condensed table-hover">
                        <tbody>
                            <tr>
                                <th width="50%">이름</th>
                                <th width="50%">날짜</th>
                            </tr>
                            @foreach($reservations as $reservation)
                            <tr>
                               <td><a href="{{route('reservation.view')}}">{{str_limit($reservation->title,24)}}</a></td>
                                <td>{{str_limit($reservation->start,16)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  {{-- end row --}}
</div>   {{-- end container --}}




@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection