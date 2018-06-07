{{-- <li class="clearfix" id="message-{{$message->id}}">
    <div class="message-data align-right">
        <span class="message-data-time" >{{$message->humans_time}} ago</span> &nbsp; &nbsp;
        <span class="message-data-name" >{{$message->sender->name}}</span>
        <a href="#" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message"><i class="fa fa-close"></i></a>
    </div>
    <div class="message other-message float-right">
        {{$message->message}}
    </div>
</li> --}}

<div class="send_row_4" id="message-{{$message->id}}">
    <p class="send_row_p">
        {{$message->humans_time}} ago
        <br>
        <strong>{{$message->sender->name}}</strong>:
        <br>
        {{$message->message}}
    </p>
</div>
