{
    "type": "FeatureCollection",
    "features": [
@for ($i = 0; $i < count($locations); $i++)
    { "type": "Feature",
        "geometry": {
        "type": "Point",
        "coordinates": [
                        {{$locations[$i]->lon}},
                        {{$locations[$i]->lat}}
        ]
    },
    "properties": {
        "title": "Team: {{$locations[$i]->team_code or "Error"}} {{($locations[$i]->title or "Geen opdracht")}}",
        "details": "{{$locations[$i]->description or "Team heeft geen opdracht."}}",
        "type": "firetruck",
        "marker-color": "{{ "#".substr(hash('sha256',$locations[$i]->team_code),0,6)}}",
        "icon": {
            "iconUrl": "/font/police-24.png",
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