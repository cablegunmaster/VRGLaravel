{
    "type": "FeatureCollection",
    "features": [<br/>
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
        "title": "brandweerwagen",
        "icon": {
        "iconUrl": "/img/firetruck.png",
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