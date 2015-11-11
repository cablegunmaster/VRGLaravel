{!! Form::open(array('url' => 'brandweer/chat/store','method' => 'post', 'id' => 'send_chat_message')) !!}
<div class="input-field col s12" id="message" name="message">
    <a class="btn blue waves-effect waves-light right" href="#" onclick="sendChat();"><i class="material-icons">send</i>Verzenden</a>
    <div style="overflow: hidden; padding-right: .5em; margin-top: -20px; margin-bottom: 0px;">
         <input placeholder="Type hier uw bericht" id="chat_message" type="text" style="float: left; color: #000000; margin-bottom: 0px;">
    </div>
</div>
{!! Form::close() !!}