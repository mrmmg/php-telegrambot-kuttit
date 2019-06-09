<?
/**
 All Telegram Function
 */

function sendMessage($chat_id,$text,$parsmde,$disable_web_page_preview,$keyboard){
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>$parsmde, //MarkDown | HTML
    'disable_web_page_preview'=>$disable_web_page_preview, //true or false
    'reply_markup'=>$keyboard
  ]);
}

function deleteMessage($chat_id,$message_id){
  bot('deleteMessage', [
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
  ]);
}

function answerCallbackQuery($callback_query_id,$text,$show_alert){
  bot('answerCallbackQuery',[
    'callback_query_id'=>$callback_query_id,
    'text'=>$text,
    'show_alert'=>$show_alert,
    'cache_time' =>5
  ]);
}

function sendAction($chat_id, $action){
  bot('sendChataction',[
    'chat_id'=>$chat_id,
    'action'=>$action]);
}
