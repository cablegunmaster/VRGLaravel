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
        {{--"title": "{{$roadblocks[$i]->title}}",--}}
        {{--"details": "{{$roadblocks[$i]->details}}",--}}
        "title": "Wegversperring",
        "details": "Bijzonder punt, vermijden",
        "type": "obstruction",
        "icon": {
        "iconUrl": "/brandweer/img/obstruction.png",
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