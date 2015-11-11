@foreach($chat as $m)
    @if($m->user_id == $mpl->id)
        <div class="row" >
            <div class="col s8 m8 right" align="right">
                <div class="card-panel green lighten-1">
                     <div align="right">
                         {{$m->message}}
                     </div>
                    <div align="right" style="align-content: right; margin-top: 10px; color: #696565;">
                        22:00
                    </div>
                 </div>
             </div>
        </div>
    @else
        <div class="row" >
            <div class="col s8 m8 left" align="left">
                <div class="card-panel green lighten-4">
                    <div align="left" style="align-content: right; margin-bottom: 10px; color: #696565;">
                        ~{{ $m->name }}
                    </div>
                    <div align="left">
                        {{ $m->message }}
                    </div>
                    <div align="right" style="align-content: right; margin-top: 10px; color: #696565;">
                        22:00
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
