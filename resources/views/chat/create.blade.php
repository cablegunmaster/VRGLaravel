{!! Form::open(array('url' => 'brandweer/chat/store','method' => 'post', 'id' => 'send_chat_message')) !!}
<div class="input-field col s12" id="message" name="message">
    <button class="btn waves-effect blue" type="submit" name="action" style="float: right; ">
        send <i class="material-icons right">send</i>
    </button>
    <div style="overflow: hidden; padding-right: .5em; margin-top: -20px; margin-bottom: 0px;">
         <input placeholder="Type hier uw bericht" id="chat_message" type="text" style="float: left; color: #000000; margin-bottom: 0px;">
    </div>
</div>
{!! Form::close() !!}

