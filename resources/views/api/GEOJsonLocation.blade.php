{
    "type": "FeatureCollection",
     "features": [
    @foreach($locations as $location)
    { "type": "Feature",
    "geometry": {"type": "Point", "coordinates": [{{$location->lat}}, {{$location->lon}} ]},
    "properties": {"image": "brandweerwagen"}
    },
    @endforeach
    ]
}
