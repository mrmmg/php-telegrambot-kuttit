<?php
define('test', true);
require_once ('system/loader.php');
ob_start();
global $config;
define('API_KEY',$config['api']['telegram']);
//----------------------------------------
//Main fanction
function bot($method,$datas=[]){
  $url = "https://api.telegram.org/bot".API_KEY."/".$method;
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
  $res = curl_exec($ch);
  if(curl_error($ch)){
    var_dump(curl_error($ch));
  }else{
    return json_decode($res);
  }
}
//-------------------------------------------
//Telegram Variables
$update = json_decode(file_get_contents('php://input'));
$calldata = $update->callback_query->data;
$callid = $update->callback_query->id;
$callchatid = $update->callback_query->message->chat->id;
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$username = $message->from->username;
$textmsg = $message->text;
$owner = $config['admin']['owner'];
$forward_from_chat = $update->message->forward_from_chat;
$from_chat_id = $forward_from_chat->id;

//Common Variable
$send = file_get_contents(getcwd()."/assets/admin/send.txt");

//Auto load Request library
Requests::register_autoloader();

//Main code
if($textmsg == "/start"){
  //connect to Database and check if chat_id exists do nothing else make a record and save user data into it
  $allchatid = userModel::fetch_by_chatid($chat_id);
  foreach($allchatid as $key => $value){
    $xchatid = $value['x_chatid'];
  }

  if($xchatid == $chat_id){
    $botupdate = has_update();
    if($botupdate){
      sendMessage($chat_id,_bot_is_updated,"MarkDown","true");
    } else {
      sendMessage($chat_id,_you_already_start,"MarkDown","true");
    }
  } else{
    userModel::insert_new($chat_id,$username,0);
  }
  sendMessage($chat_id,_send_your_link,"MarkDown","true");
}

// 🔰 Super Admin Panel Begin 🔰
else if($textmsg == "/admin" and $chat_id == $owner){

  makeDir('/assets/admin/',$chat_id,$message_id);

  sendMessage($chat_id,_panel_for_superadmin,"MarkDown","true",$superadmin_keyboard);
}

else if($calldata == 'sendtoall' and $callchatid == $owner) {
  saveToFile(getcwd()."/assets/admin/send.txt","sendtoall");
}
else if($send == "sendtoall") {
  $chatids = adminModel::fetch_user_chatid();

  foreach ($chatids as $key => $value) {
    $x_chatid = $value['x_chatid'];
    saveToFile(getcwd() . "/assets/admin/send.txt", "Do not Send To All!");
    sendMessage($x_chatid, $textmsg, "MarkDown", "true");
    sleeep(0.5);
  }
}

else if($calldata == "usercount" and $callchatid == $owner){
  $users = adminModel::fetch_user_count();
  foreach ($users as $key => $value){
    $usercount = $value['usercount'];
  }
  answerCallbackQuery($callid,_number_users.$usercount,false);
 
}

else if($calldata == "kuttit" and $callchatid == $owner){
$counts = adminModel::fetch_counter();
foreach ($counts as $key => $value){
  $count = $value['x_counter'];
  }
  answerCallbackQuery($callid,_number_kutt_link.$count,false);
}

else if($calldata == "newupdate" and $callchatid == $owner){
$stat = has_update();
if($stat == 1) {
  adminModel::new_update(0);
  answerCallbackQuery($callid,_exit_from_update_state,false);
} else {
  adminModel::new_update(1);
  answerCallbackQuery($callid,_update_for_bot,false);
}
}

// 🔰 Super Admin Panel End 🔰

// 🔰 Admin Panel Begin 🔰
else if($textmsg == "/admin" and $chat_id !== $owner ){
  global $config;
  $admins = $config['admin']['other'];
  foreach ($admins as $key => $value){
    if($chat_id == $value){
      makeDir('/assets/admin/',$chat_id,$message_id);
      sendMessage($value,_panel_for_admin,"MarkDown","true",$admin_keyboard);
    }
  }
}

else if($calldata == 'sendtoall' and $callchatid !== $owner) {
  global $config;
  $admins = $config['admin']['other'];
  foreach ($admins as $key => $value){
    if($callchatid == $value){
      saveToFile(getcwd()."/assets/admin/send.txt","sendtoall");
    }
  }
}

else if($send == "sendtoall") {
  $chatids = adminModel::fetch_user_chatid();

  foreach ($chatids as $key => $value) {
    $x_chatid = $value['x_chatid'];
    saveToFile(getcwd() . "/assets/admin/send.txt", "Do not Send To All!");
    sendMessage($x_chatid, $textmsg, "MarkDown", "true");
    sleeep(0.5);
  }
}

else if($calldata == "usercount" and $callchatid !== $owner){
  global $config;
  $admins = $config['admin']['other'];
  foreach ($admins as $key => $value) {
    if($callchatid == $value){
      $users = adminModel::fetch_user_count();
      foreach ($users as $key1 => $value1){
        $usercount = $value1['usercount'];
      }
      answerCallbackQuery($callid,_number_users.$usercount,false);
    }
  }
}
// 🔰 Admin Panel End 🔰

//🔰 Help Message For Super Admin or Admins 🔰
else if($calldata == "help"){
  sendMessage($callchatid,_help_for_admin,"MarkDown","true");
}

// 🔰 Exit Form Super Admin or Admin Panel 🔰
else if($calldata == "exit"){
  adminExit('/assets/admin/',$callchatid);
  //sendMessage($callchatid,"$id","html","false");
}


// 🔰 The Last: Make kutt.it Link 🔰
else {
  $url = $textmsg;
  if (filter_var($url, FILTER_VALIDATE_URL)) {

    sendAction($chat_id,"Typing");

    $shortUrl = kuttit($url);

    sendMessage($chat_id,$shortUrl,"MarkDown","true");

    userModel::update_counter($chat_id);

  } else {
    sendMessage($chat_id,_link_is_not_standard,"MarkDown","true");
  }
}