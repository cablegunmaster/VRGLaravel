@extends('template')

@section('content')
{!! Form::open(array('url' => 'brandweer/instructions','method' => 'post')) !!}
<div class="row">
    <div class="input-field col s6">
        {!! Form::label('buisnummer', 'Nummer Gasmeet buisje') !!}
        <span class="badge">Bravo</span>
        {!! Form::text('buisnummer', null, ['class'=> 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="input-field col s6">
    {!! Form::checkbox('explosion', 'value', false, ['class' => 'filled-in']); !!}
        {!! Form::label('explosion', 'Explosiemeting stand LEL') !!}
        <span class="badge">Echo</span>

    </div>
</div>

<div class="row">
    <div class="input-field col s6">
    {!! Form::checkbox('automess', 'value', false, ['class' => 'filled-in']); !!}
        {!! Form::label('automess', 'Automess') !!}
        <span class="badge">Remeo</span>

    </div>
</div>

<div class="row">
    <div class="input-field col s6">
    {!! Form::checkbox('sonde', 'value', false, ['class' => 'filled-in']); !!}
        {!! Form::label('sonde', 'Automess + sonde') !!}
        <span class="badge">Remeo - sierra</span>

    </div>
</div>

<div class="row">
    <div class="input-field col s6">
        {!! Form::checkbox('dosis', 'value', false, ['class' => 'filled-in']); !!}
        {!! Form::label('dosis', 'Persoonlijke dosismeter') !!}
        <span class="badge">Delta</span>
    </div>
</div>

<div class="row">
    <div class="input-field col s6">

        {!! Form::checkbox('oxygen', 'value', false, ['class' => 'filled-in']); !!}
        {!! Form::label('oxygen', 'Ademlucht') !!}
        <span class="badge">Ademlucht</span>
    </div>
</div>

<div class="row">
    <div class="row">
        <div class="input-field col s6">
            {!! Form::label('particularities', 'Bijzonderheden') !!}
            {!! Form::textarea('particularities', null, ['class' => 'materialize-textarea']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="input-field col s6">
        <button class="btn waves-effect waves-light col s12" type="submit">Submit
            <i class="material-icons right">send</i>
         </button>
     </div>
</div>
{!! Form::close() !!}
@stop