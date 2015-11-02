<!DOCTYPE html>
<html class="height:100vh">
<head>
	<title>VRG - @yield('title')</title>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->

	@if($_SERVER['SERVER_NAME'] == 'scrumbag.nl')
		<link type="text/css" rel="stylesheet" href="{{ asset('/brandweer/css/materialize.min.css') }}" media="screen,projection"/>
	@else
		<link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}" media="screen,projection"/>
	@endif

	<style>
		.nopadding {
			padding: 0px 0px 0px 0px !important;
		}
		.nomargin {
			margin: 0px 0px 0px 0px !important;
		}

		.lowverticalpadding{
			padding-top: 5px;
			padding-bottom: 5px;
		}

		.noBottomMargin {
			margin-bottom: 0px !important;
		}

		.fixedAddButton {
			position: absolute;
			bottom:2vh;
			right:2vh;
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
			<a href="#" id="navbar-title-text" class="brand-logo white-text">&nbsp;&nbsp;Meetploeg app</a>
			
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a class="modal-trigger waves-effect waves-light" href="#LargeModal" onclick="LargeModal_open_teams();">Teams</a></li>
				<li><a href="#">Geschiedenis</a></li>
				<li><a href="#">Instellingen</a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a class="modal-trigger waves-effect waves-light" href="#LargeModal" onclick="LargeModal_open_teams();">Teams</a></li>
				<li><a href="#">Geschiedenis</a></li>
				<li><a href="#">Instellingen</a></li>
			</ul>
		</div>
	</nav>

	<div id="LargeModal" class="modal modal-fixed-footer">
		<div class="modal-content black-text" id="LargeModalContent">
			<p>Loading</p>
		</div>
		<div class="modal-footer" id="LargeModalFooter">
			<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat center">Sluiten</a>
		</div>
	</div>

	<div id="BottomSheetModal" class="modal bottom-sheet">
		<div class="modal-content black-text" id="BottomSheetModalContent">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer" id="BottomSheetModalFooter">
			<a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Sluiten</a>
		</div>
	</div>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	@if($_SERVER['SERVER_NAME'] == 'scrumbag.nl')
	<script type="text/javascript" src="{{ asset('/brandweer/js/materialize.min.js') }}"></script>
	@else
	<script type="text/javascript" src="{{ asset('/js/materialize.min.js') }}"></script>
	@endif
	<div class="content_container">
		@yield('content')
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".button-collapse").sideNav();
			$('select').material_select();
		})

		function LargeModal_open_teams(){
			$('#LargeModalContent').html('\
				<h5 class="center-align">Laden...</h5>\
				<div class="blue lighten-3 progress">\
					<div class="blue indeterminate"></div>\
				</div>');
			$('#LargeModal').openModal();
			$('#LargeModalContent').load('/brandweer/team', function()
			{

				var links = $('#LargeModalContent').find("a")

				links.click(function(){
					$('#BottomSheetModalContent').html('\
						<h5 class="center-align">Laden...</h5>\
						<div class="blue lighten-3 progress">\
							<div class="blue indeterminate"></div>\
						</div>');
					$('#BottomSheetModal').openModal();
					$('#BottomSheetModalContent').load($(this).attr('href'));
					return false;
				});

			});
		};	
	</script>
</body>
</html>