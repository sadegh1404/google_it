


<?php

require_once('telegram.php');




$content = json_decode(file_get_contents('php://input'));

$text = $content->message->text;

if ($text == '/start'){

    sendHi($content);
}else{
    sendLink($content);
}




function sendHi($content){

    $chat_id = $content->message->chat->id;
    $text = 'متنتو بده من برات گوگل کنم ... ';

    $data = ['chat_id' => $chat_id , 'text' => $text ];
    Telegram::send('sendMessage',$data);


}



function sendLink($content){

    $chat_id = $content->message->chat->id;
    $data1 = ['chat_id'=>$chat_id ,'action'=>'typing'];

    Telegram::send('sendChatAction',$data1);

    $text = $content->message->text;
    $text1 = 'http://bmbgk.ir/?q='.urlencode($text);
    $msg = '<a href="'.$text1.'">'.$text."</a>";

    $data = ['chat_id'=>$chat_id , 'text'=>$msg , 'parse_mode'=>'HTML'];

    Telegram::send('sendMessage',$data);

}
?>