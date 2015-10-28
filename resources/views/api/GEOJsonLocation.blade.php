{
    "type": "FeatureCollection",
     "features": [
    @foreach($locations as $location)
    { "type": "Feature",
    "geometry": {"type": "Point", "coordinates": [{{$location->lat}}, {{$location->lon}} ]},
    "properties": {
        "title": "brandweerwagen"
        "icon": {
            "iconUrl": "/img/firetruck.png",
            "iconSize": [35,17], // size of the icon
            "className": "dot"
        }
    },
    @endforeach
    ]
}
