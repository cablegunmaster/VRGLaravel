{
    "type": "FeatureCollection",
    "features": [
    @for ($i = 0; $i < count($roadblocks); $i++)
        { "type": "Feature",
            "geometry": {
            "type": "Point",
            "coordinates": [
                {!!  $roadblocks[$i]->feature !!}
            ]
        },
        "properties": {
            {{--"title": "{{$roadblocks[$i]->title}}",--}}
            {{--"details": "{{$roadblocks[$i]->details}}",--}}
            {!!  $roadblocks[$i]->properties !!}
        }
    @if($i == (count($roadblocks)-1))
        }
    @elseif($i < count($roadblocks))
    },
    @endif
    @endfor
    ]
}