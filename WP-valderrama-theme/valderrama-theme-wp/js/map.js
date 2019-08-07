//!function ($) { $(function(){}) }(window.jQuery)

window.onload=function (){
    var settingsItemsMap = {
        zoom: 12,
        center: new google.maps.LatLng(40.768516981, -73.96927308),
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('mapa'), settingsItemsMap );

    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(40.768516981, -73.96927308),
        draggable: false
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);
}
