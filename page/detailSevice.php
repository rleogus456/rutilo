<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="width-fixed">
	<section class="section03">	
		<header>		
			<h1><span class="bgRed">디테일링서비스 찾기</span> 찾으시는 국가의 디테일링서비스를 입력해주세요.</h1>
            <div>
<!--
                <select name="" id="">
                    <option value="지역">지역</option>
                </select>
                <select name="" id="">
                    <option value="시/군/구">시/군/구</option>
                </select>
                <input type="text" placeholder="센터명">
                <input type="submit" value="검색">
-->
            </div>         
        </header>		
		<article class="intro">
         <div id="floating-panel">
                <input id="address" class="input01" type="textbox" value="청주">
                <input id="submit" class="input01 btn" type="button" value="검색">
         </div>
        <div id="map"></div>
<!--
        <h4 class="intro">루틸로를 방문해주셔서 감사합니다.</h4>
        <p>루틸로는 세계 최초 하이브리드 코팅제로, 순수 국내 기술로 개발된 루틸로 코팅제는 우수한 방수/방오 성능으로 자동차 도장면은 물론 플라스틱과 고무, 유리, 가죽, 신발, 섬유 등 일상의 모든곳에 사용할 수 있습니다.</p>
-->
          
		</article>
	</section>	
</div>
<script>
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 37.566535, lng: 126.97796}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,
                
            });
//            var content = "한밭도서관<br/><br/>Tel: 042-580-4114"; // 말풍선 안에 들어갈 내용
            // 마커를 클릭했을 때의 이벤트. 말풍선
//            var infowindow = new google.maps.InfoWindow({ content: content});
//            google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      
      }

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0PgkTu9n9pgKasFt_kE4lsiSimUcfTg0&callback=initMap">
    </script>
<?php
include_once(G5_PATH.'/tail.php');
?>
