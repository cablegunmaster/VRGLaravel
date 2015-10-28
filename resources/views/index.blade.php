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
            <li><a class="modal-trigger waves-effect waves-light" href="#teamsModal" onclick="teamsModal_open();">Teams</a></li>
            <li><a href="#">Geschiedenis</a></li>
            <li><a href="#">Instellingen</a></li>
        </ul>
    </div>
</nav>

<!-- Modal Area -->

<div id="teamsModal" class="modal modal-fixed-footer">
    <div class="modal-content black-text" id="teamsModalContent">
        <p>Loading</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat center">Sluiten</a>
    </div>
</div>

<!-- Map Area -->

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

    function teamsModal_open(){
        $('#teamsModalContent').html('\
                <h5 class="center-align">Laden...</h5>\
                <div class="green lighten-3 progress">\
                <div class="green indeterminate"></div>\
                </div>');
        $('#teamsModal').openModal();
        $('#teamsModalContent').load('brandweer/team');
    };

</script>
</body>
</html>