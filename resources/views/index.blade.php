<!DOCTYPE html>
<html class="height:100vh">
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

    <style>
        .nopadding {
            padding: 0px 0px 0px 0px !important;
        }
        .nomargin {
            margin: 0px 0px 0px 0px !important;
        }

        .noBottomMargin {
            margin-bottom: 0px !important;
        }
    </style>

    <script src='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.css' rel='stylesheet'/>

    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css' rel='stylesheet' />

    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-minimap/v1.0.0/Control.MiniMap.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-minimap/v1.0.0/Control.MiniMap.css' rel='stylesheet' />

    <script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body class="grey darken-3 white-text">
<nav id="navbar">
    <div class="nav-wrapper grey darken-4">
        <a href="#" class="brand-logo white-text">&nbsp;&nbsp;Meetploeg app</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Teams</a></li>
            <li><a href="#">Geschiedenis</a></li>
            <li><a href="#">Instellingen</a></li>
        </ul>
    </div>
</nav>
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
    <div id="enableMarkerDiv"><button id="enableMarker"></button></div>
    <div id="map" class="col s9 nopadding nomargin" style="height:93vh"></div>
</div>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

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

        // Once this layer loads, we set a timer to load it again in a few seconds.
        var featureLayer = L.mapbox.featureLayer().loadURL('/brandweer/randomadres').on('ready', runMap).addTo(map);

        function runMap() {
            featureLayer.eachLayer(function(l) {
                directions.setOrigin(L.latLng(53.218753,6.589532999999989));
                directions.setDestination(l.getLatLng());
                if (directions.queryable()) {
                    directions.query();
                }
                else {
                    console.log("directions not queryable");
                }
            });
            window.setTimeout(function() {
                featureLayer.loadURL('/brandweer/randomadres');
            }, 4000);
        }
    });

    // load roadBlocks
    var roadBlockLayer = L.mapbox.featureLayer().addTo(map);
    $.ajax({
        type: "POST",
        url: '/brandweer/api/roadblock/load',
        data: '',
        dataType: "html",
        success: function(data) {
            var i;
            var json = JSON.parse(data);
            for (i = 0; i < json.length; i++) {
                addMarker(json[i].lat, json[i].lon);
            }
        },
        error: function() {
            console.log('roadError occured');
        }
    });

    function addMarker(lat, lng) {
        var marker = L.marker([lat, lng], {
            icon: L.mapbox.marker.icon({
                'marker-color': '#AAAA00'
            }),
            title: 'Wegversperring',
            clickable: true,
            riseOnHover: true
        }).addTo(roadBlockLayer);
        var content = $('<div></div>');
        content.append($('<b></b></br>').text('Wegversperring'));
        content.append(
               $('<button></button>').text('Delete').click(function() {
                   deleteMarker(marker);
               })
        );
        marker.bindPopup(content[0],{
            closeButton: false,
            minWidth: 320
        });
        return marker;
    }
    function deleteMarker(marker) {
        // deleteMarker
        roadBlockLayer.removeLayer(marker);

        // API
        $.post( "/brandweer/api/roadblock/delete", { 'lat': marker.getLatLng().lat, 'lng': marker.getLatLng().lng });
    }

    $(window).resize(function()
    {
        var mapheight = $(window).height() - $("#navbar").height();
        $("#map").css("height", mapheight + "px")
    });

    var markerClickEnabled = true;
    map.on('click', function(e) {
        if(markerClickEnabled)
        {
            // addMarker
            addMarker(e.latlng.lat,  e.latlng.lng);
            // API
            $.post( "/brandweer/api/roadblock/new", { 'lat': e.latlng.lat, 'lng': e.latlng.lng });
        }
    });
    $( "#enableMarker" ).click(function() {
        markerClickEnabled = !markerClickEnabled;
        var tmp = $("#enableMarker");
        if(markerClickEnabled) {
            tmp.html('Wegversperring uitschakelen');
            tmp.css("background-color", "green")
        }
        else {
            tmp.html('Wegversperring inschakelen');
            tmp.css("background-color", "red")
        }
    });
    $( "#enableMarker").click();
    // https://www.mapbox.com/mapbox.js/example/v1.0.0/mouse-position/
</script>
</body>
</html>