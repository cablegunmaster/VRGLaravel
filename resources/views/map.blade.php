@extends('template')
@section('title', 'map')
@section('content')
<div class="row noBottomMargin">
	<div class="col s3 black-text" id="eventList">
		<div class="row card-panel">
			<div class="input-field col s10">
				<i class="material-icons prefix">search</i>
				<input id="searchbox" type="text" required>
			</div>
			<div class="col s2">
				<a class="btn-floating btn-large waves-effect waves-light blue" id="searchbox_button"><i class="material-icons">search</i></a>
			</div>
		</div>
		<a class="waves-effect blue waves-light btn modal-trigger" href="#OpdrachtModal" style="width:100%; margin-top:0.5em" onclick="$('#OpdrachtModal').openModal();">Nieuw</a>
		<div id = "eventHolder">
			<h5 class="center-align white-text">Laden...</h5>
			<div class="blue lighten-3 progress">
				<div class="blue indeterminate"></div>
			</div>
		</div>
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
			<a class="col s12 m6 l3 card-panel grey-text" onclick="">
				<i class="material-icons large">explore</i>
				<h4>Rijopdracht</h4>
			</a>
			<a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" onclick="LargeModal_open_textmessage();">
				<i class="material-icons large">cloud</i>
				<h4>Meetopdracht</h4>
			</a>
			<a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" id="enableMarker">
				<i class="material-icons large">error</i>
				<h4>Wegversperring</h4>
			</a>
			<a class="col s12 m6 l3 card-panel waves-effect blue-text waves-blue" id="malButton">
				<i class="material-icons large">error</i>
				<h4>Mal</h4>
			</a>
		</div>
	</div>
</div>

<div id="MalModal" class="modal bottom-sheet">
	<div class="modal-content black-text lighten-1">
		<div class="row">
			<div class="col s12 m6 l3">
				Lengte: <input name="length" type="text"/>
			</div>
			<div class="col s12 m6 l3">
				Breedte: <input name="width" type="text"/>
			</div>
			<div class="col s12 m6 l3">
				Windrichting: <input name="bearing" type="text"/>
			</div>
			<div class="col s12 m6 l3">
				Windsnelheid (m/s): <input name="speed" type="text"/>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	currentdata = "";
	oldlocations = "";
	var mal = null;// {location: null, polygon: null};
	'use strict';
	L.mapbox.accessToken = 'pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ';
	<?php if(!isset($_GET['colour'])){$_GET['colour'] = "default";} ?>
	@if($_GET['colour'] == "light")
	var map = L.mapbox.map('map', 'mapbox.streets').on('ready',function(){
		@else
		var map = L.mapbox.map('map', 'davidvisscher.nom58j6h').on('ready',function(){
			@endif
			L.control.fullscreen().addTo(map);
			L.control.scale().addTo(map);
			map.setView([53.189,6.818],10);
			//var directions = L.mapbox.directions({units:"metric"});
			//var directionsLayer = L.mapbox.directions.layer(directions).addTo(map);
			//var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions).addTo(map);
			//var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions).addTo(map);
			//var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions).addTo(map);
			//var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions).addTo(map);

				// Once this layer loads, we set a timer to load it again in a few seconds.

				roadBlockLayer = L.mapbox.featureLayer().addTo(map);
				teamViewFeatureLayer = L.mapbox.featureLayer().addTo(map);
				searchFeatureLayer = L.mapbox.featureLayer().addTo(map).on('ready', runMap);

			var earthRadius = 6378140; //constant

			function runMap() {
				featureLayer.eachLayer(function(l) {
					//map.panTo(l.getLatLng());

					//console.log('https://api.mapbox.com/v4/directions/mapbox.driving/'+ temp1.lat+','+ temp1.lng +';6.5306433920317,53.247911358103.json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ');

					//featureLayer.loadURL('https://api.mapbox.com/v4/directions/mapbox.driving/'+ temp1.lat+','+ temp1.lng +';6.5306433920317,53.247911358103.json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ');
				});
				window.setTimeout(function() {
						//featureLayer.loadURL('/brandweer/randomadres');

						updateRoadBlocks();
						updateTeamView();
						
						getTaskData();
					}, 4000);
			}
		});

			$('#malButton').click(function() {
				malClickEnabled = true;
				$('#OpdrachtModal').closeModal();
				$('#navbar-title-text').html('&nbsp;&nbsp;Mal Plaatsen');
			});
			$('#MalModal').change(function() {

				if(mal != null) {
					var l = $(this).find('[name="length"]').val();
					var w = $(this).find('[name="width"]').val();
					var b = $(this).find('[name="bearing"]').val();
					var s = $(this).find('[name="speed"]').val();
					try {
						l = parseInt(l);
						w = parseInt(w);
						b = parseInt(b);
						s = parseInt(s);
						if(isNaN(l) || isNaN(w) || isNaN(b) || isNaN(s))
							return;
					}catch(err){
						return;
					}

					var polyUpdate = createMal(mal.location.lat, mal.location.lng, b, l, w, 'red');
					if(mal.polygon != null) {
						map.removeLayer(mal.polygon)
					}
					mal.polygon = polyUpdate;
					map.addLayer(mal.polygon);
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
	updateTeamView();
	updateRoadBlocks();
	getTaskData();
});

function updateTeamView()
{
	$.get('/brandweer/api/getlocations',function(result)
	{
		if(!(result == oldlocations))
		{
			teamViewFeatureLayer.loadURL('/brandweer/api/getlocations');
			oldlocations = result;
		}
	});
}

function getTaskData()
{
	$.get('/brandweer/task/preformatted', function(data){
		if(!(data == currentdata))
		{
			currentdata = data;
			$('#eventHolder').html(data)
			$('.collapsible').collapsible({
								accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion 	style
							});
			console.log('update')
		}
	});
}

function getDirections(originLat, originLong, destLat, destLong)
{
			directions.setOrigin(  L.latLng(originLat,originLong));//L.latLng(53.218753,6.589532999999989));
directions.setDestination(L.latLng(destLat,destLong));
if (directions.queryable()) {
	directions.query();
}
else
{
	console.log("directions not queryable");
}
}

function LargeModal_open_meetopdracht(){
	$('#LargeModalContent').html('\
		<h5 class="center-align">Laden...</h5>\
		<div class="blue lighten-3 progress">\
			<div class="blue indeterminate"></div>\
		</div>');
	$('#LargeModal').openModal();
	$('#LargeModalContent').load('/brandweer/instructions/create', function()
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

		$('select').material_select();

	});
};

function LargeModal_open_textmessage(){
	$('#LargeModalContent').html('\
		<h5 class="center-align">Laden...</h5>\
		<div class="blue lighten-3 progress">\
			<div class="blue indeterminate"></div>\
		</div>');
	$('#LargeModal').openModal();
	$('#LargeModalContent').load('/brandweer/meetinstructie/create', function()
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

		$('select').material_select();

	});
};

function updateRoadBlocks()
{
			// load roadBlocks
			$.ajax({
				type: "POST",
				url: '/brandweer/api/roadblock/load',
				data: '',
				dataType: "html",
				success: function(data) {
					roadBlockLayer.clearLayers();
					var i;
					var json = JSON.parse(data);
					for (i = 0; i < json.length; i++) {
						addMarker(json[i].lat, json[i].lon,json[i].id);
					}
				},
				error: function() {
					console.log('roadError occured');
				}
			});
		}

		function addMarker(lat, lng,id) {
			var marker = L.marker([lat, lng], {
				icon: L.mapbox.marker.icon({
					'marker-color': '#FFC107'
				}),
				title: 'Wegversperring',
				clickable: true,
				riseOnHover: true
			}).addTo(roadBlockLayer);
			marker.database_identifier = id;
			var content = $('<div></div>');
			content.append(
				$('<a class="waves-effect waves-light red white-text btn"></a>').text('Verwijderen').click(function() {
					deleteMarker(marker);
				})
				);
			marker.bindPopup(content[0],{
				closeButton: false
			});
			return marker;
		}
		function deleteMarker(marker) {
			// deleteMarker
			roadBlockLayer.removeLayer(marker);

			// API
			$.post( "/brandweer/api/roadblock/delete", { 'lat': marker.getLatLng().lat, 'lng': marker.getLatLng().lng, "id": marker.database_identifier },function(response){
				console.log(response);
			});
		}

		var markerClickEnabled = false;
		var malClickEnabled = false;
		map.on('click', function(e) {
			if(markerClickEnabled)
			{
				// addMarker
				addMarker(e.latlng.lat,  e.latlng.lng);
				// API
				$.post( "/brandweer/api/roadblock/new", { 'lat': e.latlng.lat, 'lng': e.latlng.lng });
				ObstructionButton_disable();
			}else if(malClickEnabled) {
				if(mal == null) {
					mal = { location: e.latlng, polygon:null };
				}
				$('#MalModal').openModal({
	      dismissible: true, // Modal can be dismissed by clicking outside of the modal
	      opacity: 0.0}	);
				// on complete:
				malClickEnabled = false;

				//show modal for distance, angle and width?

			}
		});
		$( "#enableMarker" ).click(function() {
			$('#BottomSheetModal').closeModal();
			if(markerClickEnabled)
			{
				ObstructionButton_disable();
			}
			else
			{
				ObstructionButton_enable();
			}
		});

		function ObstructionButton_enable()
		{
			markerClickEnabled = true;
			$('#OpdrachtModal').closeModal();
			$('.nav-wrapper').removeClass('grey');
			$('.nav-wrapper').removeClass('darken-4');

			$('.nav-wrapper').addClass('amber');
			$('#navbar-title-text').html('&nbsp;&nbsp;Wegversperring Plaatsen');
		}

		function ObstructionButton_disable()
		{
			markerClickEnabled = false;

			$('.nav-wrapper').addClass('grey');
			$('.nav-wrapper').addClass('darken-4');

			$('.nav-wrapper').removeClass('amber');
			$('#navbar-title-text').html('&nbsp;&nbsp;Meetploeg App');
		}
		// https://www.mapbox.com/mapbox.js/example/v1.0.0/mouse-position/

		//Searchbox Bar Functionality

		$('#searchbox_button').click(function(){
			var query = $('#searchbox').val();
			console.log("searching for" + query);
			var mapCenter = map.getCenter();
			$.post('/brandweer/api/geocode/forwardEncodeByProximity', { 'address': query, 'lon': mapCenter.lng.toString(), 'lat': mapCenter.lat.toString()}, function(result){
				var jsonObj = JSON.parse(result);
				console.log(jsonObj);

				searchFeatureLayer.clearLayers();
				searchFeatureLayer.setGeoJSON(jsonObj).addTo(map);

				var layercounter = 0;
				searchFeatureLayer.eachLayer(function(l) {
					if(layercounter == 0)
					{
						map.panTo(l.getLatLng());
					}
					layercounter++;
				});
			})
		});

	function createMal(lat,lng, degrees, length/* meters */, width /* meters */, color) {
					var source = new L.latLng(lat,lng);
					var destination = moveLatLng(source, degrees, length);

					var center = new L.latLng((source.lat + destination.lat)/2, (source.lng + destination.lng)/2);

					var part1 = new Array();
					var part2 = new Array();

				/*points.push(source);
				points.push(moveLatLng(center, degrees-90,width/2));
				points.push(destination);
				points.push(moveLatLng(center, degrees+90,width/2));*/


				part1.push(source);

				var sPoint = moveLatLng(source, degrees, length*0.05);
				part1.push(moveLatLng(sPoint, degrees+90, width/4));
				part2.push(moveLatLng(sPoint, degrees-90, width/4));
				//points.push(moveLatLng(center, degrees+90,width/2));

				sPoint = moveLatLng(source, degrees, length*0.2);
				part1.push(moveLatLng(sPoint, degrees+90, width/2));
				part2.push(moveLatLng(sPoint, degrees-90, width/2));

				sPoint = moveLatLng(source, degrees, length*0.8);
				part1.push(moveLatLng(sPoint, degrees+90, width/2));
				part2.push(moveLatLng(sPoint, degrees-90, width/2));

				sPoint = moveLatLng(source, degrees, length*0.95);
				part1.push(moveLatLng(sPoint, degrees+90, width/4));
				part2.push(moveLatLng(sPoint, degrees-90, width/4));

				part2.push(destination);

				var d = source.distanceTo(destination)
				if(Math.abs(d - length) > 1) {
					console.warn("Distance to projected LatLng deviating more than a meter.");
				}

				return L.polygon(part1.concat(part2.reverse()	), {color:color});
			}

			function moveLatLng(latLng, degrees, distance) {
			/*	angle = Math.PI/180 * (degrees + 90); // now 0 degrees is North/Up
				north = Math.sin(angle) * distance;
   			east = Math.cos(angle) * distance;

    		newLat = latLng.lat + (north / earthRadius) * 180 / Math.PI;
   			newLng = latLng.lng + (east / (earthRadius * Math.cos(newLat * 180 / Math.PI))) * 180 / Math.PI;
   			return new L.latLng(newLat, newLng);*/


						var radius = 6378140; //meters
						var M_PI = Math.PI;
				    //# Degree to Radian
				    var lat = latLng.lat * (M_PI/180);
				    var lng = latLng.lng * (M_PI/180);
				    var brng = degrees * (M_PI/180);
				    var d = distance;

				    latitude2 = Math.asin( Math.sin(lat)* Math.cos(d/radius) +  Math.cos(lat)* Math.sin(d/radius)* Math.cos(brng));
				    longitude2 = lng +  Math.atan2( Math.sin(brng)* Math.sin(d/radius)* Math.cos(lat), Math.cos(d/radius)- Math.sin(lat)* Math.sin(latitude2));

				//    # back to degrees
				latitude2 = latitude2 * (180/M_PI);
				longitude2 = longitude2 * (180/M_PI);

				  //  # 6 decimal for Leaflet and other system compatibility
				  // $lat2 = round ($latitude2,6);
				   //$long2 = round ($longitude2,6);

				   // Push in array and get back
				   //$tab[0] = $lat2;
				  // $tab[1] = $long2;

				  return new L.latLng(latitude2, longitude2);
				}
	</script>
	@stop
