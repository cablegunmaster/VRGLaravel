{!! Form::open(array('url' => 'brandweer/instructions','method' => 'post', 'id'=>'instruction_form')) !!}
<div class="row">
    <div class="input-field col s12">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class'=> 'form-control']) !!}
    </div>
</div>


<div class="row">
    <div class="row">
        <div class="input-field col s12">
            {!! Form::label('description', 'Description: ') !!}
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
    $('#instruction_form').submit( function(e) {
        $.post($(this).attr('action'), $(this).serialize(), function(res){
            // Do something with the response `res`
            console.log(res);
            // Don't forget to hide the loading indicator!
            $('#instruction_form').parent().parent().closeModal();
        });
        return false; // prevent default action
    });
</script>