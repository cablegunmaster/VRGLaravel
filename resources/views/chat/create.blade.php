{!! Form::open(array('url' => 'brandweer/chat/store','method' => 'post', 'id' => 'send_chat_message')) !!}
<div class="row">
    <div class="input-field col s12">
        <button class="btn waves-effect waves-light" type="submit" name="action" style="float: right">
            send <i class="material-icons right">send</i>
        </button>
        <div style="overflow: hidden; padding-right: .5em;">
            <input placeholder="Type hier uw bericht" id="chat_message" type="text" style="float: left">
        </div>
    </div>
</div>
{!! Form::close() !!}