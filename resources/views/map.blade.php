@extends('template')
@section('title', 'map')
@section('content')
<div class="row noBottomMargin">
    <div class="col s3 black-text" id="eventList">
        <a class="waves-effect waves-light btn modal-trigger" href="#OpdrachtModal" onclick="$('#OpdrachtModal').openModal();">Nieuwe Opdracht</a>
    </div>
    <div id="map" class="col s9 nopadding nomargin" style="height:93vh"></div>
</div>

<div id="OpdrachtModal" class="modal bottom-sheet">
    <div class="modal-content black-text lighten-1">
      <div class="row">
        <a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" onclick="LargeModal_open_meetopdracht();">
         <i class="material-icons large">message</i>
         <h4>Tekstbericht</h4>
     </a>
     <a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" onclick="">
         <i class="material-icons large">explore</i>
         <h4>Rijopdracht</h4>
     </a>
     <a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" onclick="LargeModal_open_textmessage();">
         <i class="material-icons large">cloud</i>
         <h4>Meetopdracht</h4>
     </a>
 </div>
</div>
<div class="modal-footer">
  <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
</div>
</div>

<script type="text/javascript">
    'use strict';
    L.mapbox.accessToken = 'pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ';

    var map = L.mapbox.map('map', 'davidvisscher.nom58j6h').on('ready',function(){
        L.control.fullscreen().addTo(map);

        new L.Control.MiniMap(L.mapbox.tileLayer('davidvisscher.nom58j6h')).addTo(map);

        var directions = L.mapbox.directions({units:"metric"});
        var directionsLayer = L.mapbox.directions.layer(directions).addTo(map);
        var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions).addTo(map);
        var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions).addTo(map);
        var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions).addTo(map);
        var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions).addTo(map);

        var featureLayer = L.mapbox.featureLayer()
        .loadURL('/brandweer/randomadres')
        // Once this layer loads, we set a timer to load it again in a few seconds.
        .on('ready', runMap)
        .addTo(map);

        function runMap() {
            featureLayer.eachLayer(function(l) {
            //map.panTo(l.getLatLng());
            var temp1 = l.getLatLng();
            directions.setOrigin(L.latLng(53.218753,6.589532999999989));
            directions.setDestination(temp1);
            if (directions.queryable()) {
                directions.query();
            }
            else
            {
                console.log("directions not queryable");
            }

            //console.log('https://api.mapbox.com/v4/directions/mapbox.driving/'+ temp1.lat+','+ temp1.lng +';6.5306433920317,53.247911358103.json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ');

            //featureLayer.loadURL('https://api.mapbox.com/v4/directions/mapbox.driving/'+ temp1.lat+','+ temp1.lng +';6.5306433920317,53.247911358103.json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ');
        });
            window.setTimeout(function() {
                featureLayer.loadURL('/brandweer/randomadres');
            }, 4000);
        }
    });

$(window).resize(function()
{
    var mapheight = $(window).height() - $("#navbar").height();
    $("#map").css("height", mapheight + "px")
});

$(document).ready(function()
{
    var mapheight = $(window).height() - $("#navbar").height();
    $("#map").css("height", mapheight + "px")
});


function LargeModal_open_meetopdracht(){
    $('#LargeModalContent').html('\
        <h5 class="center-align">Laden...</h5>\
        <div class="green lighten-3 progress">\
            <div class="green indeterminate"></div>\
        </div>');
    $('#LargeModal').openModal();
    $('#LargeModalContent').load('/brandweer/instructions/create', function()
    {

        var links = $('#LargeModalContent').find("a")

        links.click(function(){
            $('#BottomSheetModalContent').html('\
                <h5 class="center-align">Laden...</h5>\
                <div class="green lighten-3 progress">\
                    <div class="green indeterminate"></div>\
                </div>');
            $('#BottomSheetModal').openModal();
            $('#BottomSheetModalContent').load($(this).attr('href'));
            return false;
        });

        $('select').material_select();

    });
};

function LargeModal_open_textmessage(){
    $('#LargeModalContent').html('\
        <h5 class="center-align">Laden...</h5>\
        <div class="green lighten-3 progress">\
            <div class="green indeterminate"></div>\
        </div>');
    $('#LargeModal').openModal();
    $('#LargeModalContent').load('/brandweer/meetinstructie/create', function()
    {

        var links = $('#LargeModalContent').find("a")

        links.click(function(){
            $('#BottomSheetModalContent').html('\
                <h5 class="center-align">Laden...</h5>\
                <div class="green lighten-3 progress">\
                    <div class="green indeterminate"></div>\
                </div>');
            $('#BottomSheetModal').openModal();
            $('#BottomSheetModalContent').load($(this).attr('href'));
            return false;
        });

        $('select').material_select();

    });
};  

</script>
@stop
