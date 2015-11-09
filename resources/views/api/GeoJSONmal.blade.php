{
    "type": "FeatureCollection",
    "features": [
    @for ($i = 0; $i < count($mal); $i++)
        { "type": "Feature",
            "geometry": {
            "type": "Polygon",
            "coordinates": [
                {!!  $mal[$i]->feature !!}
            ]
        },
        "properties": {
            {!!  $mal[$i]->properties !!}
        }
        @if($i == (count($mal)-1))
            }
        @elseif($i < count($mal))
            },
        @endif
    @endfor
    ]
}