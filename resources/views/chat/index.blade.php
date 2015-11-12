

@foreach($chat as $m)
    @if($m->user_id == $mpl->id)
        <div class="row" style="margin-bottom:0.2em ;margin-top: 0.1em;" >
            <div class="col s8 m8 right" align="right">
                <div style="margin:0.1em 0.1em 0.1em 0.1em; padding: 0.4em 0.3em 0.1em 0.3em" class="card-panel blue white-text">
                    <div align="right">
                         {{$m->message }}
                     </div>
                 </div>
             </div>
        </div>
    @else
        <div class="row" style="margin-bottom:0.2em ;margin-top: 0.1em;" >
            <div class="col s8 m8 left" align="left">
                <div style="margin:0.1em 0.1em 0.1em 0.1em; padding: 0.4em 0.3em 0.1em 0.3em" class="card-panel green white-text">
                    <div align="left" style="align-content: right; margin-bottom: 10px;" class="white-text">
                        {{ $m->created_at }} -&nbsp;<b><i>{{ $m->name }}</i></b>:
                    </div>
                    <div align="left">
                        {{ $m->message }}
                    </div>
                    <div align="right" style="align-content: right; margin-top: 10px;" class="white-text">
                        
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
