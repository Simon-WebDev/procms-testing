@extends('layouts.main')


@section('mainnav')
  @include('layouts.mainnav')
@endsection


@section('content')

<div class="container">
	<div class="row">
		<div class="text-center"><h2>다음맵</h2></div>
	    <hr>
	    <div class="col-md-6">
	        <div id="map-daum" style="height:400px;"></div>
	    </div>
	    <div class="col-md-6">
	        <div id="roadview" style="height:400px;"></div>

	    </div>
	</div>
	<div class="row">
		<div class="text-center"><h2>네이버 맵</h2></div>
		<div class="col-md-6">
		    <div id="map-naver" style="height:400px;"></div>
		</div>
		<div class="col-md-6">
		    <div id="pano" style="width:100%;height:400px;"></div>
		</div>
	</div>
</div>

@endsection

@section('mainfooter')
    @include('layouts.mainfooter')
@endsection


@section('script')

{{-- 다음맵 코드 --}}

<script type="text/javascript" src="http://dapi.kakao.com/v2/maps/sdk.js?appkey=bb64c256012174960a67e1ca19b3a9eb"></script>

<script>
        var container = document.getElementById('map-daum');
        var options = {
            center: new daum.maps.LatLng(35.138853, 126.905130),
            level: 4
        };

        var map = new daum.maps.Map(container, options);

        // 마커가 표시될 위치입니다 
        var markerPosition  = new daum.maps.LatLng(35.138853, 126.905130); 

        // 마커를 생성합니다
        var marker = new daum.maps.Marker({
            position: markerPosition
        });

        // 마커가 지도 위에 표시되도록 설정합니다
        marker.setMap(map);


        // 마커를 클릭했을 때 마커 위에 표시할 인포윈도우를 생성합니다
        var iwContent = '<div style="padding:5px;">Hello World!</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
            iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시됩니다

        // 인포윈도우를 생성합니다
        var infowindow = new daum.maps.InfoWindow({
            content : iwContent,
            removable : iwRemoveable
        });

        // 마커에 클릭이벤트를 등록합니다
        daum.maps.event.addListener(marker, 'click', function() {
              // 마커 위에 인포윈도우를 표시합니다
              infowindow.open(map, marker);  
        });




       
        //로드뷰를 표시할 div
        var roadviewContainer = document.getElementById('roadview'); 

        // 로드뷰 위치
        // var rvPosition = new daum.maps.LatLng(35.138992, 126.906045);

        //로드뷰 객체를 생성한다
        var roadview = new daum.maps.Roadview(roadviewContainer, {
            panoId : 1078272757, // 로드뷰 시작 지역의 고유 아이디 값
            panoX : 126.97837, // panoId가 유효하지 않을 경우 지도좌표를 기반으로 데이터를 요청할 수평 좌표값
            panoY : 37.56613, // panoId가 유효하지 않을 경우 지도좌표를 기반으로 데이터를 요청할 수직 좌표값
            pan: 300, // 로드뷰 처음 실행시에 바라봐야 할 수평 각
            tilt: -18, // 로드뷰 처음 실행시에 바라봐야 할 수직 각
            zoom: 0 // 로드뷰 줌 초기값
        }); 
</script>


{{-- 네이버 맵 --}}

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=3WTGpD31BOhFeX1zbgA_&submodules=geocoder,panorama"></script>


<script>
  var map = new naver.maps.Map('map-naver');
  var myaddress = '광주광역시 남구 독립로 54번길 29';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
  naver.maps.Service.geocode({address: myaddress}, function(status, response) {
      if (status !== naver.maps.Service.Status.OK) {
          return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
      }
      var result = response.result;
      // 검색 결과 갯수: result.total
      // 첫번째 결과 결과 주소: result.items[0].address
      // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
      var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
      map.setCenter(myaddr); // 검색된 좌표로 지도 이동
      // 마커 표시
      var marker = new naver.maps.Marker({
        position: myaddr,
        map: map
      });
      // 마커 클릭 이벤트 처리
      naver.maps.Event.addListener(marker, "click", function(e) {
        if (infowindow.getMap()) {
            infowindow.close();
        } else {
            infowindow.open(map, marker);
        }
      });
      // 마크 클릭시 인포윈도우 오픈
      var infowindow = new naver.maps.InfoWindow({
          content: '<h4> [네이버 개발자센터]</h4><a href="https://developers.naver.com" target="_blank"><img src="https://developers.naver.com/inc/devcenter/images/nd_img.png"></a>'
      });
  });


  //panorama

  var pano = null;

  naver.maps.onJSContentLoaded = function() {
      // 아이디 혹은 지도좌표로 파노라마를 표시할 수 있습니다.
      pano = new naver.maps.Panorama("pano", {
          // panoId: "OregDk87L7tsQ35dcpp+Mg==",
          position: new naver.maps.LatLng(35.139098, 126.906033),
          pov: {
              pan: -95.71,
              tilt: 17.15,
              fov: 120
          }
      });
  };
  </script>

@endsection