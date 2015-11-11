<?php

namespace App\Http\Controllers\Api;

use App\Incident;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Input;
use Mockery\Exception;

class WeatherMapController extends Controller
{
	private $APPID = "0dd63aad039cb00d7d28b0d8f7f6f8db";

    function getWeather() {
        $result = array();
        $result['success'] = false;

        if(Input::has('incidentID')) {
            $incident = Incident::where('id', Input::get('incidentID'))->first();
            if($incident != null) {
                if ($incident->weather == null) {
                    $updateWeatherResult = $this->updateWeather();
                    $result = json_decode($updateWeatherResult, true); // Geeft dezelfde velden terug namelijk weather(Array) en success(Boolean).
                } else {
                    $result['weather'] = json_decode($incident->weather, true); // decode de JSON (Hij saved hem als JSON namelijk. Maak er een basic PHP Array
                    $result['success'] = true;
                }
            }
            else {
                $result['error'] = "INCIDENT_NOT_FOUND";
            }
        }
        else {
            $result['error'] = "No incidentID";
        }
        return json_encode($result);
    }

	function updateWeather()
	{
        $result = array();
        $result['success'] = false;

        if(Input::has('incidentID')) {
            $incident = Incident::where('id', Input::get('incidentID'))->first();
            if($incident != null) {
                $url = sprintf("http://api.openweathermap.org/data/2.5/weather?lat=%f&lon=%f&appid=%s&lang=nl&units=metric", $incident->lat, $incident->lon, $this->APPID);
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPGET, 1);
                    if (!$api_result = curl_exec($ch)) {
                        trigger_error(curl_error($ch));
                    }
                    curl_close($ch);

                    // Parse the result, create a new JSON with data we would like to store, type (RAIN), temperature (20) and wind speed/direction
                    $array = json_decode($api_result, true);
                    $result['weather'] = array(
                        'type' => $array['weather'][0]['main'],
                        'description' => $array['weather'][0]['description'],
                        // 'temperature' => (int)((int)$array['main']['temp'] - 273.15), // API returns in kelvin (convert to Celcius)
                        'temperature' => (int)$array['main']['temp'],
                        'wind_speed' => (int)$array['wind']['speed'],
                        'wind_degrees' => (int)$array['wind']['deg']);

                    // Store the result so multiple MP and MPL can use this.
                    $incident->weather = json_encode($result['weather']);
                    $incident->save();

                    $result['success'] = true;
                } catch (Exception $e) {
                    $result['error'] = "HAS_ERROR";
                }
            }
            else {
                $result['error'] = "INCIDENT_NOT_FOUND";
            }
        }
        else {
            $result['error'] = "No incidentID";
        }
		return json_encode($result);
	}
}
