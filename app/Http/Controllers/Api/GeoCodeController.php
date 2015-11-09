<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeoCodeController extends Controller
{
	function postEncode()
	{
		$address = $_POST['address'];

		$urlAddress = urlencode($address);

		$url = "http://api.mapbox.com/geocoding/v5/mapbox.places/".$urlAddress.".json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWZtdHh6a3cwMTg5dGNseDg2cDFsMTZyIn0.bDPO2rgB_lpOypOYt-eOeg";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPGET, 1); 
		if( ! $result = curl_exec($ch)) 
		{ 
			trigger_error(curl_error($ch)); 
		} 
		curl_close($ch);

		return $result;
	}

	function postReverseEncode()
	{
		$lon = $_POST['lon'];
		$lat = $_POST['lat'];

		$url = "http://api.mapbox.com/geocoding/v5/mapbox.places/".$lon.",".$lat.".json?access_token=pk.eyJ1IjoiZGF2aWR2aXNzY2hlciIsImEiOiJjaWZtdHh6a3cwMTg5dGNseDg2cDFsMTZyIn0.bDPO2rgB_lpOypOYt-eOeg";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPGET, 1); 
		if( ! $result = curl_exec($ch)) 
		{ 
			trigger_error(curl_error($ch)); 
		} 
		curl_close($ch);

		$result_decoded = json_decode($result,true);

		$place_name = $result_decoded['features'][0]['place_name'];
		return $place_name;
	}
}
