<?php
/** All Admins Database Query */
class adminModel {
  public static  function  add_new($chatid,$username){
    $db = Db::getInstance();

    $db->insert("INSERT INTO admin (x_chatid, x_username) VALUE (:chatid, :username)", array(
      'chatid' => $chatid,
      'username' => $username,
    ));
  }

  public static  function  get_all(){
    $db = Db::getInstance();

    $admins = $db->query("SELECT x_chatid FROM admin", array());

    return $admins;
  }

  public static  function  fetch_user_count(){
    $db = Db::getInstance();

    $user = $db->query("SELECT COUNT(id) AS usercount FROM users", array());

    return $user;
  }

  public static  function  fetch_user_chatid(){
    $db = Db::getInstance();

    $user = $db->query("SELECT x_chatid FROM users", array());

    return $user;
  }

  public static  function  fetch_counter(){
    $db = Db::getInstance();

    $user = $db->query("SELECT SUM(x_counter) AS x_counter FROM users", array());

    return $user;
  }

  public static function new_update($update){
    $db = Db::getInstance();
    $db->modify("UPDATE bot SET x_botupdate=:x_update", array(
      'x_update' => $update,
    ));
  }

  public static function has_update(){
    $db = Db::getInstance();
    $bot = $db->query("SELECT x_botupdate FROM bot", array());
    return $bot;
  }

}