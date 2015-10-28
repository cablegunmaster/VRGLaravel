<!DOCTYPE html>
<html class="height:100vh">
<head>
    <title>VRG - @yield('title')</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/css/materialize.min.css" media="screen,projection"/>

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
            <li><a href="#teamsModal">Teams</a></li>
            <li><a href="#">Geschiedenis</a></li>
            <li><a href="#">Instellingen</a></li>
        </ul>
    </div>
</nav>

<div id="teamsModal" class="modal modal-fixed-footer">
    <div class="modal-content black-text" id="teamsModalContent">
        <p>Loading</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat center">Sluiten</a>
    </div>
</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/materialize.min.js"></script>
<div class="content_container">
    @yield('content')
</div>
<script type="text/javascript">
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