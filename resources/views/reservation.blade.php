@extends('layouts.main')

@section('mainnav')
  @include('layouts.mainnav')
@endsection

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('bootstrapdatetimepicker/jquery.datetimepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/reservation.css')}}">
@endsection

@section('content')

<section class="inner-header" id="reser-header">
    <div class="inner-header-caption">
        <h1 class="text-center">
          예약
          <small>small</small>
        </h1>
        <ol class="breadcrumb text-center">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="{{route('reservation.view')}}"><i class="fa fa-calendar"></i> 예약</a></li>
          <li class="active">예약</li>
        </ol>
    </div>
</section>
 

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			{{ Form::open(['route' => 'events.store', 'method' => 'post', 'role' => 'form','id'=>'reser-create']) }}
			<div id="responsive-modal" class="modal modal-default fade" tabindex="-1" data-backdrop="static">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="text-center">예 약</h4>
			            </div>
			            <div class="modal-body">

			                <div class="form-group required">
			                    {{ Form::label('date_start', '날짜') }}
			                    {{ Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true','required']) }}
			                </div>

			                <div class="form-group  required">
			                    {{ Form::label('time_start', '시간') }}
			                    {{ Form::text('time_start', null, ['class' => 'form-control']) }}
			                </div>
			                <div class="form-group  required">
			                    <label for="staff_id">선택</label>
			                    <select class="form-control" id="staff_id" name="staff_id" placeholder="선택하세요">
			                        @php
			                        $staffs=App\Staff::select('name','id')->get();
			                        @endphp
                                    <option value="" disabled selected>선택하세요</option>
			                        @foreach($staffs as $staff)
			                        <option value="{{$staff->id}}">{{$staff->name}}</option>
			                       
			                        @endforeach
			                    </select>
			                   {{--  {!! Form::label('staff_id','선택') !!}
			                    {!! Form::select('staff_id', $staffs,null,['class'=>'form-control','placeholder'=>'선택']) !!} --}}
			                </div>
			                <div class="form-group  required">
			                    {{ Form::label('phone', '전화번호') }}
			                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
			                </div>

			                {{-- <div class="form-group">
			                    {{ Form::label('date_end', '종료일과 시각') }}
			                    {{ Form::text('date_end', old('date_end'), ['class' => 'form-control']) }}
			                </div> --}}

			                {{-- <div class="form-group">
			                    {{ Form::label('color', 'COLOR') }}
			                    <div class="input-group colorpicker">
			                        {{ Form::text('color', old('color'), ['class' => 'form-control']) }}
			                        <span class="input-group-addon">
			                            <i></i>
			                        </span>
			                    </div>
			                </div> --}}
			            </div>
			            <div class="modal-footer">
			                {!! Form::submit('확인', ['class' => 'btn btn-success']) !!}
			                <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
			            </div>
			        </div>
			    </div>
			</div>
			{{ Form::close() }}
			<div id="reserPanel" class="box">
                <div class="panel-body">
    			    <div class="text-center"><h4><strong><i class="fa fa-calendar"></i> {{$settings->site_name}} 예약</strong> </h4></div>
    			    <div>
    			        @include('includes.messages')
    			        <hr>
    			        <div id="cal-box">
    			            <div id='calendar'>
    			            </div>
    			        </div>
    			     
    			        <hr>
    			    </div>
                </div>
			</div>
			<div id="modal-event" class="modal modal-default fade" tabindex="-1" data-backdrop="static">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="text-center">예약 수정</h4>
			            </div>
			            <div class="modal-body">
			               

			                <div class="form-group">
			                    {{ Form::label('_date_start', '날짜') }}
			                    {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control','id'=>'_date_start']) }}
			                </div>

			                <div class="form-group">
			                    {{ Form::label('_time_start', '시간') }}
			                    {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control','id'=>'_time_start']) }}
			                </div>
			                <div class="form-group">
			                    <label for="_staff_id">선택</label>
			                    <select class="form-control" id="_staff_id" name="_staff_id" placeholder="선택하세요">
			                       @foreach($staffs as $staff)
			                       
			              
			                      <option value="{{ $staff->id }}">{{ $staff->name }}</option>
			                      
			                       {{-- <option value="{{$staff->id}}">{{$staff->name}}</option> --}}
			                      
			                       @endforeach
			                    </select>
			                </div>
			               <div class="form-group">
			                   {{ Form::label('_phone', '전화번호') }}
			                   {{ Form::text('_phone', old('_phone'), ['class' => 'form-control']) }}
			               </div>
			                

			                {{-- <div class="form-group">
			                    {{ Form::label('_date_end', 'FECHA HORA FIN') }}
			                    {{ Form::text('_date_end', old('_date_end'), ['class' => 'form-control']) }}
			                </div> --}}

			                {{-- <div class="form-group">
			                    {{ Form::label('_color', 'COLOR') }}
			                    <div class="input-group colorpicker">
			                        {{ Form::text('_color', old('_color'), ['class' => 'form-control']) }}
			                        <span class="input-group-addon">
			                            <i></i>
			                        </span>
			                    </div>
			                </div> --}}
			            </div>
			            <div class="modal-footer">
			                <a id="edit" data-href="{{ url('reservation/events') }}" data-id="" class="btn btn-success">수정</a>
			                <a id="delete" data-href="{{ url('reservation/events') }}" data-id="" class="btn btn-danger">삭제</a>
			                <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
			               {{--  <button type="submit" class="btn btn-dafault" data-dismiss="modal"> 확인</button> --}}
			            </div>
			        </div>
			    </div>
			</div>
			{{-- need to login modal --}}
			<div class="modal modal-info fade needToLoginModal" tabindex="-1" role="dialog" aria-labelledby="">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">예약엔 로그인이 필요합니다.</h4>
                    </div>
                    <div class="modal-body">
                        <a href="{{route('login')}}" class="reserLogin"><i class="fa fa-sign-in"></i> 로그인</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-dismiss="modal">닫기</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
			     {{--  <h4 class="text-center modal-header" style="margin:0; font-weight: bold;">예약엔 로그인이 필요합니다. <br>
			       </h4>
			       <p><a href="{{route('login')}}" class="reserLogin"><i class="fa fa-sign-in"></i> 로그인</a></p> --}}

			    </div>
			  </div>
			</div>
		</div>{{-- end col-xs-12 --}}
	</div>{{-- end row --}}
</div>{{-- end container --}}
@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection


@section('script')
<script type="text/javascript" src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
<script type="text/javascript" src="{{asset('fullcalendar/locale/ko.js')}}"></script>
<script type="text/javascript" src="{{asset('bootstrapdatetimepicker/jquery.datetimepicker.full.min.js')}}"></script>


<script type="text/javascript">
    document.addEventListener('touchmove', this._preventDefault, { passive: false });
    var BASEURL = "{{ url('reservation') }}";
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
              left: 'prev,next,today',
              center: 'prev,title,next',
              right: 'month,agendaWeek,agendaDay'
            },
            defaultView:'agendaWeek',
            hiddenDays: [0],
            navLinks: true,
            contentHeight: 800,
            allDaySlot: false,
            minTime: "09:00:00",
            maxTime :"20:00:00",
            slotDuration : "00:20:00",
            firstDay :1,
            eventDurationEditable : false,
            selectable: true,
            selectHelper: true,
            locale: 'ko',
            longPressDelay: 0,
            async: true,
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow',
            buttonText: {
            today : "오늘",
            month : "월별",
            week : "주별",
            day : "일별"
            },
            @if(!Auth::check())
            // eventRender: function(event, element) {
            //     var limit = 1;
            //     if (event.title.length > limit) {
            //         element.find('.fc-title').text(event.title.substr(0,limit)+'**').parent().attr('title', event.title);
            //     }
            // },
            @endif
            @if(Auth::check())
            select: function(start){
                
                start = moment(start.format());
                
                $('#date_start').val(start.format('YYYY-MM-DD'));
                $('#time_start').val(start.format('H:mm'));
                $('#staff_id').val(event.staff_id);
                $('#phone').val(event.phone);
                $('#responsive-modal').modal('show');
            },
            @else
            select:function () {
                $('.needToLoginModal').modal();
            },
            @endif
            events: BASEURL + '/events',
            @if(Auth::check())
            eventClick: function(event, jsEvent, view){
                var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                var time_start = $.fullCalendar.moment(event.start).format('H:mm');
                var user_id = event.user_id;

                // var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD hh:mm:ss');
                $('#modal-event #delete').attr('data-id', event.id);
                $('#modal-event #edit').attr('data-id', event.id);
                $('#modal-event #_title').val(event.title);
                $('#modal-event #_date_start').val(date_start);
                $('#modal-event #_time_start').val(time_start);
                $('#modal-event #_staff_id').val(event.staff_id);
                $('#modal-event #_phone').val(event.phone);
                
                // $('#modal-event #_date_end').val(date_end);
                // $('#modal-event #_color').val(event.color);
                if (user_id == {{Auth::user()->id}} ) {
                $('#modal-event').modal('show');
                }
                
            },
            @else
            eventClick:function () {
                $('.needToLoginModal').modal();
            }
            @endif
           
        });

        
        $.datetimepicker.setLocale('en');
        $('#time_start').datetimepicker({
          datepicker: false, 
          format : 'H:i',
          step: 20
        });

        $('#_time_start').datetimepicker({
            datepicker: false,  
            minDate : 0,
            format: 'H:i',
            step: 20
        });
        $('#_date_start').datetimepicker({
          timepicker: false,  
          format : 'Y-m-d'
          
          
        });
        
        $('#date_end').datetimepicker({
            minDate : 0,
            format: 'Y-m-d H:i',
            step: 20
        });
        $('#_date_end').datetimepicker({
            minDate : 0,
            format: 'Y-m-d H:i',
            step: 20
        });

        // $('.fc-event').hover(function(){
        //     $(this).css('cursor','pointer');
        // })


        $('#delete').on('click', function(){
            
            var x = $(this);
            var delete_url = x.attr('data-href')+'/'+x.attr('data-id');
            if(confirm('삭제하시겠습니까?')){
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(result){
                        $('#modal-event').modal('hide');
                        location.href=BASEURL;
                    },
                    error: function(result){
                        $('#modal-event').modal('hide');
                        
                    }
                });
            }
        });


        $('#edit').on('click', function(){
                    

            var  y = $(this);

            var edit_url = y.attr('data-href')+'/'+y.attr('data-id');
            var _title = $('#_title').val();
            var _date_start = $('#_date_start').val();
            var _time_start = $('#_time_start').val();
            var _staff_id = $('#_staff_id').val();
            var _phone = $('#_phone').val();
            // var _date_end = $('#_date_end').val();
            // var _color = $('#_color').val();
            var allData = {'_title':_title, '_date_start': _date_start, '_time_start' : _time_start,'_staff_id':_staff_id,  '_phone':_phone, _token: "{{csrf_token()}}"}
            
           
           
            $.ajax({
                url: edit_url,
                type: 'PATCH',
                data : allData,
                dataType : 'JSON',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                
                success: function(result){
                    $('#modal-event').modal('hide');
                    location.href=BASEURL;
                    
                },
                error: function(result){
                    $('#modal-event').modal('hide');
                    
                    
                    
                    
                }

            });


        });
    });
</script>
<script type="text/javascript">
    {{-- bootstrap theme 적용후 아이콘 불작동 --}}
    $(document).ready(function() {
        $('span.ui-icon.ui-icon-circle-triangle-w').addClass('fa').addClass('fa-chevron-left');
        $('span.ui-icon.ui-icon-circle-triangle-e').addClass('fa').addClass('fa-chevron-right');
        $('.fc-center h2').css('color','#0C2461');
        $('.fc-today').css('backgroundColor','#F8EFBA');

        /*make .fc-center margin-top*/
        /* custom  */
        $('.fc-toolbar .fc-center').css(
            'margin' , '20px');

        
        
    });
    
    
</script>
{{-- bootstrap validator --}}
<script src="{{asset('js/validator.min.js')}}"></script>
{{-- end bootstrap validator --}}

@endsection

{{-- 

jquery datatime picker date disabled method

var array = ["2013-03-14","2013-03-15","2013-03-16"]


$('input').datepicker({
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
arrary의 결과가 제외된 즉 데이터베이스에서 불려줘온  값은 제외된 결과를
jquery datatime picker에서 반환되게 하는 방법.

 --}}