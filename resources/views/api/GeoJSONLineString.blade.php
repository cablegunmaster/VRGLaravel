{
    "type": "FeatureCollection",
    "features": [
    @for ($i = 0; $i < count($linestring); $i++)
        { "type": "Feature",
            "geometry": {
            "type": "LineString",
            "coordinates": [
                {!!  $linestring[$i]->feature !!}
            ]
        },
        "properties": {
        }
        @if($i == (count($linestring)-1))
            }
        @elseif($i < count($linestring))
            },
        @endif
    @endfor
    ]
}