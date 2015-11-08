{
    "type": "FeatureCollection",
    "features": [
@for ($i = 0; $i < count($roadblocks); $i++)
    { "type": "Feature",
        {!!  $roadblocks[$i]->feature !!}
    },
    "properties": {
        {{--"title": "{{$roadblocks[$i]->title}}",--}}
        {{--"details": "{{$roadblocks[$i]->details}}",--}}
        "title": "Wegversperring",
        "details": "Bijzonder punt, vermijden",
            {!!  $roadblocks[$i]->properties !!}
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