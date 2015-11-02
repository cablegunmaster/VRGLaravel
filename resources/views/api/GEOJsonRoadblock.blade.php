{
    "type": "FeatureCollection",
    "features": [
@for ($i = 0; $i < count($roadblocks); $i++)
    { "type": "Feature",
        "geometry": {
        "type": "Point",
        "coordinates": [
                        {{$roadblocks[$i]->lat}},
                        {{$roadblocks[$i]->lon}}
        ]
    },
    "properties": {
        {{--"title": "{{$roadblocks[$i]->poi_type}}",--}}
        "title": "obstructie",
        "icon": {
        "iconUrl": "/img/obstruction.png",
        "iconSize": [35,17],
        "className": "dot"
        }
    }
@if($i == (count($roadblocks)-1))
    }
@elseif($i < count($roadblocks))
},
@endif
@endfor
]
}
{{-- Uniformen naar elke Poi type uit de database gebasseerd op de title //uitzoeken relaties poi_type -> Poi  gebasseerd op ID kan je de naam eruit trekken. --}}