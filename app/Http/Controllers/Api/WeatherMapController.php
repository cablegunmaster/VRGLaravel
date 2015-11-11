<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class WeatherMapController extends Controller
{
	private $APPID = "0dd63aad039cb00d7d28b0d8f7f6f8db";

	function getWeather()
	{
		$lon = $_POST['lon'];
		$lat = $_POST['lat'];
		$url = sprintf("http://api.openweathermap.org/data/2.5/weather?lat=%f&lon=%f&appid=%s", $lat, $lon, $this->APPID);

        $result = array();
        $result['success'] = false;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            if (!$api_result = curl_exec($ch)) {
                trigger_error(curl_error($ch));
            }
            curl_close($ch);

            $array = json_decode($api_result, true);
            $result['weather'] = array(
                'type' => $array['weather'][0]['main'],
                'description' => $array['weather'][0]['description'],
                'temperature' => (int)((int)$array['main']['temp'] - 273.15), // API returns in kelvin (convert to Celcius)
                'wind_speed' => (int)$array['wind']['speed'],
                'wind_degrees' => (int)$array['wind']['deg']);
            $result['success'] = true;
        }
        catch(Exception $e) {
            $result['error'] = "HAS_ERROR";
        }
		return json_encode($result);
	}
}
