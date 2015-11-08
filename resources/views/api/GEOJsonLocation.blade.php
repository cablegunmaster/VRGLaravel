{
    "type": "FeatureCollection",
    "features": [
@for ($i = 0; $i < count($locations); $i++)
    { "type": "Feature",
        "geometry": {
        "type": "Point",
        "coordinates": [
                        {{$locations[$i]->lat}},
                        {{$locations[$i]->lon}}
        ]
    },
    "properties": {
        "title": "{{$locations[$i]->title or "Geen opdracht"}}",
        "details": "{{$locations[$i]->description or "Team heeft geen opdracht."}}",
        "type": "firetruck",
        "icon": {
        "iconUrl": "/brandweer/img/firetruck.png",
        "iconSize": [35,17],
        "className": "dot"
        }
    }
@if($i == (count($locations)-1))
    }
@elseif($i < count($locations))
},
@endif
@endfor
]
}