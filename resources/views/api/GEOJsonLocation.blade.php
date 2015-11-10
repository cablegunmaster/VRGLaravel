{
    "type": "FeatureCollection",
    "features": [
@for ($i = 0; $i < count($locations); $i++)
    @if(isset($locations[$i]->lon))
    { "type": "Feature",
        "geometry": {
        "type": "Point",
        "coordinates": [
                        {{$users[$i]->lon}},
                        {{$users[$i]->lat}}
        ]
    },
    "properties": {
        "title": "Team: {{$locations[$i]->team_code or "Error"}}",
        "details": "Some Text",
        "type": "firetruck",
        "marker-color": "{{ "#".substr(hash('md5',$locations[$i]->team_code),0,6)}}",
        "marker-symbol": "police",
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
@endif
@endfor
]
}