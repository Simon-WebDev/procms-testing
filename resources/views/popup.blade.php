@extends('layouts.main')


@section('style')
<style type="text/css">
#popupDiv {
    display: none;
    position: relative;
    width:76%;
    left:12%;
    top:-6000px;
    margin-top: 4em;
    height: auto;
    padding: 3em 0em 2em 2em;
    border:1px solid #ccc;
    transition: all .6s;
    -webkit-transition: all .6s;
    background-color: #2f3640;
    
}
@media (max-width:700px){
	#popupDiv 
	{
		width:90%;
		left:5%;
		padding: 1.5em 0em 1em 1em;
	}
	
}
#popupDiv #closeBox {
  position: absolute;
  right: 0;
  top:-51px;
  border:1px solid #2f3640;
  padding: 10px;
  cursor:pointer;
  background-color: #2f3640;
}
#popupDiv #closeBox:focus, #popupDiv #closeBox:hover {
  color:#e84118;
}
#popupDiv #close {
  display: block;
  font-size: 14px; 
  color:#fff; 
  text-decoration: none;
}
#popupDiv #close:hover, #popupDiv #close:focus {
  color:#0097e6;
}
.popup-each {
  width:50%;
  float: left;

  padding:0 30px 30px 0px;
}

@media (max-width: 1000px){
	.popup-each {
		width:100%;
		padding:0 30px 30px 0px;
	}
}
@media (max-width: 700px) {
	.popup-each
	{
		padding:0 14px 30px 0px;
	}
}
.popup-each img {
  vertical-align: middle;
}
#popupDiv #close.input-close
{
	color:#fff;
	position: relative;
	right:2em;
}
</style>
@endsection

@section('content')

<div id="popupDiv" class="clearfix">
        <span id="closeBox"><i class="fa fa-close fa-2x"></i></span>
        <div class="popup-each"><img src="../upload/Post_Image_1.jpg" alt="" class="img-responsive"></div>
        <div class="popup-each"><img src="../upload/Post_Image_2.jpg" alt="" class="img-responsive"></div>
        <div class="popup-each"><img src="../upload/Post_Image_3.jpg" alt="" class="img-responsive"></div>
        <div class="popup-each"><img src="../upload/Post_Image_4.jpg" alt="" class="img-responsive"></div>
        <div class="clearfix">
          <a href="JavaScript:void(0)" id="close" class="pull-right input-close"><span class="fa fa-square-o "></span> 오늘 하루 보지 않기</a>
        </div>
       
</div>




@php
//$value = Request::cookie();
//var_dump($_COOKIE['div_laypopup']); setcookie('div_laypopup','');
@endphp
{{-- cookie:{{dd(Request::cookie())}} --}}
@endsection

@section('script')
<script>
	$(document).ready(function() {

	  // If the 'hide cookie is not set we show the message
	  if (!readCookie('hide')) {
	    $('#popupDiv').show();
	  }

	  // Add the event that closes the popup and sets the cookie that tells us to
	  // not show it again until one day has passed.
	  $('#close').click(function() {
	    $('#popupDiv').hide();
	    createCookie('hide', true, 1)
	    return false;
	  });

	});

	// ---
	// And some generic cookie logic
	// ---
	function createCookie(name,value,days) {
	  if (days) {
	    var date = new Date();
	    date.setTime(date.getTime()+(days*24*60*60*1000));
	    var expires = "; expires="+date.toGMTString();
	  }
	  else var expires = "";
	  document.cookie = name+"="+value+expires+"; path=/";
	}

	function readCookie(name) {
	  var nameEQ = name + "=";
	  var ca = document.cookie.split(';');
	  for(var i=0;i < ca.length;i++) {
	    var c = ca[i];
	    while (c.charAt(0)==' ') c = c.substring(1,c.length);
	    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	  }
	  return null;
	}

	function eraseCookie(name) {
	  createCookie(name,"",-1);
	}
	
	$(window).on('load', function(){
	 $('#popupDiv').css('top','0');
	});
	$(' #popupDiv #closeBox').click(function(){
	    $('#popupDiv').css('display','none');
	});

	 
	  
</script>
@endsection	
