<?php
include_once('../../common.php');
$id = $_POST['id'];
$list=sql_fetch("select * from `franch_status` where id='".$id."'");
?>

<div class="status">
	<header class="msg_head"><?php echo $list['title'];?> </header>
	<div class="msg_con">
	    <div class="msg_map">
	        <div id="map"></div>
	    </div>
        <div class="msg_txt">
            <h2>주소 : <?php echo $list['addr2']; ?></h2>
	        <h2>TEL : <?php echo $list['tel']; ?></h2>
	        <h2>FAX : <?php echo $list['fax']; ?></h2>
	        <h2>영업시간 : <?php echo $list['opening']; ?></h2>
	        <h2>대표 : <?php echo $list['name']; ?></h2>
	        <h2>기타 : <?php echo $list['etc']; ?></h2>
        </div>
	    	<div class="msg_btn_group pa">
			<a href="javascript:msg_close();" class="btn bg_darkred color_white">닫기</a>
		</div>
	</div>
</div>
<script>
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 37.566535, lng: 126.97796}
        });
        var geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

function geocodeAddress(geocoder, resultsMap) {
var address = "<?php echo $list['addr2']; ?>";
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