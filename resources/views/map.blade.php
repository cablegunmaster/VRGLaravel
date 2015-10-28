@extends('template')
@section('title', 'map')
@section('content')
<div class="row noBottomMargin">
    <div class="col s3 black-text">
        <div class="card-panel white-text blue darken-2" style="padding-top:5px;padding-bottom:5px">
            <small>12-09-2017 16:32</small>
            <i class="material-icons small right">info</i><br/>Team B Begonnen met meting
        </div>
        <div class="card-panel white-text blue darken-2" style="padding-top:5px;padding-bottom:5px">
            <small>12-09-2017 16:32</small>
            <i class="material-icons small right">info</i><br/>Team B op locatie
        </div>
        <div class="card-panel white-text orange">
            <i class="medium material-icons right" style="padding-top:5px;padding-bottom:5px">warning</i>
            <small>12-09-2017 16:31</small>
            <br/>
            Weg geblokkeerd bij : Reitdiepskade
        </div>
        <div class="card-panel white-text blue darken-2" style="padding-top:5px;padding-bottom:5px">
            <small>12-09-2017 16:32</small>
            <i class="material-icons small right">info</i><br/>Team B onderweg
        </div>
    </div>
    <div id="map" class="col s9 nopadding nomargin" style="height:93vh"></div>
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

</script>
@stop
