{!! Form::open(array('url' => 'brandweer/meetinstructie/store','method' => 'post', 'id' => 'meetinstructie_form')) !!}
<div class="row">
 <div class="input-field col s12">
    <select id="team" name="teamId">
      <option value="" disabled selected>Selecteer een team</option>
      @if(count($teams))
      @foreach($teams as $team)
      <option value="{{ $team->id }}">{{ $team->code." ".$team->name }}</option>
      @endforeach
      @else
      <option value="0">Team Mock-up</option>
      @endif
  </select>
</div>
</div>

<div class="row">
    <div class="input-field col s12">
        {!! Form::label('buisnummer', 'Nummer Gasmeet buisje') !!}
        <span class="badge">Bravo</span>
        {!! Form::text('buisnummer', null, ['class'=> 'form-control']) !!}
    </div>
</div>


<div class="row">
    <div class="input-field col s12">
        <input type="checkbox" class="filled-in" id="explosion" name="items[]" value="Explosiemeting stand LEL"/>
        <label for="explosion">Explosiemeting stand LEL</label>
        <span class="badge">Echo</span>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <p>
            <input type="checkbox" class="filled-in" id="automess" name="items[]" value="Automess"/>
            <label for="automess">Automess</label>
            <span class="badge">Romeo</span>
        </p>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <p>
            <input type="checkbox" class="filled-in" id="drone" name="items[]" value="Automess + sonde"/>
            <label for="drone">Automess + sonde</label>
            <span class="badge">Romeo - sierra</span>
        </p>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <p>
            <input type="checkbox" class="filled-in" id="personal" name="items[]" value="Persoonlijke dosismeter"/>
            <label for="personal">Persoonlijke dosismeter</label>
            <span class="badge">Delta</span>
        </p>
    </div>
</div>


<div class="row">
    <div class="input-field col s12">
        <p>
            <input type="checkbox" class="filled-in" id="oxygen" name="items[]" value="Ademlucht"/>
            <label for="oxygen">Ademlucht</label>
            <span class="badge">Ademlucht</span>
        </p>
    </div>
</div>

<div class="row">
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            {!! Form::label('description', 'Bijzonderheden') !!}
            {!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
        </div>
    </div>
</div>



<div class="row">
    <div class="input-field col s12">
        <button class="btn blue waves-effect waves-light col s12" type="submit">Submit
            <i class="material-icons right">send</i>
        </button>
    </div>
</div>
{!! Form::close() !!}

<script>
    $('#meetinstructie_form').submit( function(e) {
        $.post($(this).attr('action'), $(this).serialize(), function(res){
            // Do something with the response `res`
            console.log(res);
            // Don't forget to hide the loading indicator!
            $('#meetinstructie_form').parent().parent().closeModal();
        });
        return false; // prevent default action
    });
</script>