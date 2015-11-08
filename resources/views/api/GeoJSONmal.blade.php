{
"type": "FeatureCollection",
"features": [
@for ($i = 0; $i < count($mal); $i++)
    { "type": "Feature",
    {!!  $mal[$i]->feature !!}
    },
    "properties": {
    {{--"title": "{{$roadblocks[$i]->title}}",--}}
    {{--"details": "{{$roadblocks[$i]->details}}",--}}
    {!!  $mal[$i]->properties !!}
    }
    }
    @if($i == (count($mal)-1))
        }
    @elseif($i < count($mal))
        },
    @endif
@endfor
]
}