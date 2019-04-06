@extends('layouts.backend.main')
@section('title', '예약')

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('bootstrapdatetimepicker/jquery.datetimepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/reservation.css')}}">
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 323px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-calendar"></i> 예약
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('backend.staff.index')}}"><i class="fa fa-calendar"></i> 예약</a></li>
      <li class="active">예약</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="panel-body">
                
                {{ Form::open(['route' => 'backend.event.store', 'method' => 'post', 'role' => 'form']) }}
                <div id="responsive-modal" class="modal modal-success fade" tabindex="-1" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4>예약 입력</h4>
                            </div>
                            <div class="modal-body">
                                

                                <div class="form-group">
                                    {{ Form::label('date_start', '날짜') }}
                                    {{ Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('time_start', '시각') }}
                                    {{ Form::text('time_start', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    @php
                                      $staffs = App\Staff::pluck('name','id');
                                    @endphp 
                                   
                                       {!! Form::label('staff_id', '선택') !!}
                                      {!! Form::select('staff_id', $staffs, null, ['class'=>'form-control']) !!}
                                
                                </div>
                                <div class="form-group">
                                    {{ Form::label('title', '이름') }}
                                    {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('phone', '전화번호') }}
                                    {{ Form::text('phone', old('phone'), ['class' => 'form-control']) }}
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
                                {!! Form::submit('확인', ['class' => 'btn btn-outline']) !!}
                                <button type="button" class="btn btn-outline" data-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div id='calendar'>
                </div>
            
             </div>
             <div id="modal-event" class="modal modal-warning fade" tabindex="-1" data-backdrop="static">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>예약 수정</h4>
                         </div>
                         <div class="modal-body">
                            

                             <div class="form-group">
                                 {{ Form::label('_date_start', '시작일') }}
                                 {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control','id'=>'_date_start']) }}
                             </div>

                             <div class="form-group">
                                 {{ Form::label('_time_start', '시각') }}
                                 {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control','id'=>'_time_start']) }}
                             </div>
                             <div class="form-group">
                               
                                 {!! Form::label('_staff_id', '선택',['placeholder'=>'선택하세요']) !!}
                                {!! Form::select('_staff_id', $staffs, null, ['class'=>'form-control']) !!}
                                
                             </div>
                             <div class="form-group">
                                 {{ Form::label('_title', '이름') }}
                                 {{ Form::text('_title', old('_title'), ['class' => 'form-control']) }}
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
                             <a id="edit" data-href="{{ url('backend/reservation/event') }}" data-id="" class="btn btn-outline">수정</a>
                             <a id="delete" data-href="{{ url('backend/reservation/event') }}" data-id="" class="btn btn-outline">삭제</a>
                             <button type="button" class="btn btn-outline" data-dismiss="modal">취소</button>
                            {{--  <button type="submit" class="btn btn-dafault" data-dismiss="modal"> 확인</button> --}}
                         </div>
                     </div>
                 </div>
             </div>
          </div>
            <!-- /.box-body -->
        </div>
          <!-- /.box -->
      </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection



@section('script')

<script type="text/javascript" src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
<script type="text/javascript" src="{{asset('fullcalendar/locale/ko.js')}}"></script>
<script type="text/javascript" src="{{asset('bootstrapdatetimepicker/jquery.datetimepicker.full.min.js')}}"></script>


<script>
    var BASEURL = "{{ url('backend/reservation') }}";

    $(document).ready(function() {

        $('#calendar').fullCalendar({
            
            header: {
              left: 'prev,next today',
              center:'prev,title,next',
              right: 'month,agendaWeek,agendaDay'
            },
            defaultView:'agendaWeek',
            hiddenDays: [0],
            navLinks: true,
            contentHeight: 800,
            allDaySlot: false,
            minTime: "08:00:00",
            maxTime :"20:00:00",
            slotDuration : "00:20:00",
            firstDay :1,
            eventOverlap: false,
            eventDurationEditable : false,
            selectable: true,
            selectHelper: true,
            editable:true,
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
            day : "일별",

            },
            // theme : true,
            // themeSystem : 'bootstrap3',
            
            select: function(start){
                // start = moment(start.format());
               
                // $('#date_start').val(start.format('YYYY-MM-DD'));
                // $('#staff_id').val(event.staff_id);
                // $('#responsive-modal').modal('show');

                start = moment(start.format());
                
                $('#date_start').val(start.format('YYYY-MM-DD'));
                $('#time_start').val(start.format('H:mm'));
                $('#staff_id').val(event.staff_id);
                $('#phone').val(event.phone);
                $('#responsive-modal').modal('show');
            },
           
            events: BASEURL + '/event',

            eventClick: function(event, jsEvent, view){
                var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                var time_start = $.fullCalendar.moment(event.start).format('H:mm');
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
                $('#modal-event').modal('show');
            }
            
        });

    });

    
    // jQuery.datetimepicker.setLocale('en');
    $('#time_start').datetimepicker({
      datepicker: false, 
      minDate : 0, 
      format : 'H:i',
      minTime:'09:00',
      step: 20
    });

    $('#_time_start').datetimepicker({
        datepicker: false,  
        minDate : 0,
        format: 'H:i',
        minTime:'09:00',
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
        var allData = {'_title':_title, '_date_start': _date_start, '_time_start' : _time_start,'_staff_id':_staff_id,'_phone':_phone, _token: "{{csrf_token()}}"}
        
       
       
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