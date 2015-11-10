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
		</div>
	</div>
</div>

<script type="text/javascript">
	currentdata = "";
	oldlocations = "";
	'use strict';
	L.mapbox.accessToken = 'pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWcwM2NpazQwMmk4dDRreDdpNGd1MXd0In0.JsRAe5r1LWPdBqlhMTOlyQ';
	<?php if(!isset($_GET['colour'])){$_GET['colour'] = "default";} ?>
	@if($_GET['colour'] == "light")
	var map = L.mapbox.map('map', 'mapbox.streets').on('ready',function(){
	@else
	var map = L.mapbox.map('map', 'davidvisscher.nom58j6h').on('ready',function(){
	@endif
		L.control.fullscreen().addTo(map);
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
								accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
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
		map.on('click', function(e) {
			if(markerClickEnabled)
			{
				// addMarker
				addMarker(e.latlng.lat,  e.latlng.lng);
				// API
				$.post( "/brandweer/api/roadblock/new", { 'lat': e.latlng.lat, 'lng': e.latlng.lng });
				ObstructionButton_disable();
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
	</script>
	@stop
