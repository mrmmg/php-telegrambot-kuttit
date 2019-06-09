<?php
/** All Users Database Query */
class userModel {
public static  function insert_new ($chatid,$username,$counter){
  $db = Db::getInstance();

  $lastId = $db->insert("INSERT INTO users (x_chatid, x_username, x_counter) VALUE (:chatid, :username, :counter)", array(
    'chatid' => $chatid,
    'username' => $username,
    'counter' => $counter,
  ));
}

public static function fetch_by_chatid($chatid){
  $db = Db::getInstance();

  $user = $db->query("SELECT x_chatid FROM users WHERE x_chatid=:chatid", array(
    'chatid' => $chatid,
  ));

  return $user;
}

public static function update_counter($chatid){
  $db = Db::getInstance();

  $db->modify("UPDATE users SET x_counter=x_counter+1 WHERE x_chatid=:chatid", array(
    'chatid' => $chatid,
  ));
}

}
