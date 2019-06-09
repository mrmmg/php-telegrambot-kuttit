<?
/**
 All Common Function
 */
//Use Request library for send target url to kutt server
function kuttit($targetUrl){
  global $config;
  $headers = array(
    'X-API-Key' => $config['api']['kutt'],
    'Content-Type' => 'application/x-www-form-urlencoded'
  );
  $data = array(
    'target' => $targetUrl
  );
// Now let's make a request!
  $request = Requests::post('https://kutt.it/api/url/submit', $headers, $data);
// Check what we received
  $data = $request->body;
  $data = json_decode($data);
  $shortUrl = $data->shortUrl;
  return $shortUrl;
}

//Sleep in second or microsecond
function sleeep($seconds)
{
  $seconds = abs($seconds);
  if ($seconds < 1){
    usleep($seconds*1000000);
  }
  else{
    sleep($seconds);
  }
}

//Function for check update state
function has_update(){
  $update = adminModel::has_update();
  foreach ($update as $key => $value){
    $botupdate = $value['x_botupdate'];
  }
  return $botupdate;
}

//Function for save data into a file
function saveToFile($path, $text){
  $myfile = fopen("$path", "w");
  fwrite($myfile, $text);
  fclose($myfile);
  return true;
}

//Function for make directiory for each admin or superadmin
function makeDir($path, $chatid, $msgid){
  if (!is_dir(getcwd().$path.$chatid)) {
    mkdir(getcwd().$path.$chatid, 0777, true);
    fopen(getcwd().$path.$chatid.'/msgid.txt',"w");
    saveToFile(getcwd().$path.$chatid.'/msgid.txt', $msgid);
  } else {
    saveToFile(getcwd().$path.$chatid.'/msgid.txt', $msgid);
  }
}

//Function for exit from Admin or Super Admin panel
function adminExit($path,$callchatid){
  $adminfile = fopen(getcwd().$path.$callchatid.'/msgid.txt', "r");
  $filepath = getcwd().$path.$callchatid.'/msgid.txt';
  $content = fread($adminfile, filesize($filepath));
  //return $content;
  deleteMessage($callchatid, $content+1);
}