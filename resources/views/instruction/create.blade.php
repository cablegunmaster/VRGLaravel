{!! Form::open(array('url' => 'brandweer/instructions','method' => 'post')) !!}
<div class="row">
    <div class="input-field col s6">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class'=> 'form-control']) !!}
    </div>
</div>


<div class="row">
    <div class="row">
        <div class="input-field col s6">
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
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
