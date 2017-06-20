<!DOCTYPE html>

<html lang="ko">

<head>

<title>Simple Map</title>

<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0PgkTu9n9pgKasFt_kE4lsiSimUcfTg0&libraries=places&callback=initAutocomplete"
        async defer></script>      

<style>


#map {

  height: 100%;

  width: 100%;

  border: 2px solid darkgrey;

}

.controls {

  margin-top: 10px;

  border: 1px solid transparent;

  border-radius: 2px 0 0 2px;

  box-sizing: border-box;

  -moz-box-sizing: border-box;

  height: 32px;

  outline: none;

  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);

}



#pac-input {

  background-color: #fff;

  font-family: Roboto;

  font-size: 15px;

  font-weight: 300;

  margin-left: 12px;

  padding: 0 11px 0 13px;

  text-overflow: ellipsis;

  width: 300px;

}



#pac-input:focus {

  border-color: #4d90fe;

}



.pac-container {

  font-family: Roboto;

}



#type-selector {

  color: #fff;

  background-color: #4d90fe;

  padding: 5px 11px 0px 11px;

}



#type-selector label {

  font-family: Roboto;

  font-size: 13px;

  font-weight: 300;

}

.pac-container {

    background-color: #FFF;

    z-index: 20;

    position: fixed;

    display: inline-block;

    float: left;

}

.modal{

    z-index: 20;   

}

.modal-backdrop{

    z-index: 10;        

}

</style>

</head>

<body>

<!-- 모달창을 띄울 버튼 -->

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onClick="resize()">주소검색</button>


<!-- 모달창 -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->

<div class="modal-content" style="width: 730px; height: 750px;">
<!-- 주소찾기 -->

<div class="modal-header" style="">
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body" style="height: 84%; padding: 10px;">
<!-- 구글 맵 검색input -->

<input id="pac-input" class="controls" type="text"

placeholder="주소 검색">

<!-- 구글 맵  -->

<div id="map"></div>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>

</div>

</div>

</div>

</div>


<script>

/***** Google Map Init *****/

function initAutocomplete() {

 var map = new google.maps.Map(document.getElementById('map'), {

   center: {lat: 37.946295, lng: 126.000023},

   zoom: 8,

   mapTypeId: google.maps.MapTypeId.ROADMAP

 });



 // Create the search box and link it to the UI element.

 var input = document.getElementById('pac-input');

 var searchBox = new google.maps.places.SearchBox(input);

 map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);



 // Bias the SearchBox results towards current map's viewport.

 map.addListener('bounds_changed', function() {

   searchBox.setBounds(map.getBounds());

 });



 var markers = [];

 // [START region_getplaces]

 // Listen for the event fired when the user selects a prediction and retrieve

 // more details for that place.

 searchBox.addListener('places_changed', function() {

   var places = searchBox.getPlaces();

   if (places.length == 0) {

     return;

   }



   // Clear out the old markers.

   markers.forEach(function(marker) {

     marker.setMap(null);

   });

   markers = [];



   // For each place, get the icon, name and location.

   var bounds = new google.maps.LatLngBounds();

   places.forEach(function(place) {

     var icon = {

       url: place.icon,

       size: new google.maps.Size(71, 71),

       origin: new google.maps.Point(0, 0),

       anchor: new google.maps.Point(17, 34),

       scaledSize: new google.maps.Size(25, 25)

     };



     // Create a marker for each place.

     markers.push(new google.maps.Marker({

       map: map,

       icon: icon,

       title: place.name,

       position: place.geometry.location

     }));



     if (place.geometry.viewport) {

       // Only geocodes have viewport.

       bounds.union(place.geometry.viewport);

     } else {

       bounds.extend(place.geometry.location);

     }

   });

   map.fitBounds(bounds);

 

 });

}

//모달창이 띄어질 경우 구글 맵 리사이즈

function resize(){

$('#myModal').on('shown.bs.modal', function () {

google.maps.event.trigger(map, "resize");

});

}

</script>

</body>

</html>



