<?
if (!defined('test')) { exit; }
//Database Section
global $config;
$config['db']['host'] = 'localhost';                // Database Host
$config['db']['user'] = 'username';      //  Database Username
$config['db']['pass'] = 'password';     //   Database Password
$config['db']['name'] = 'db name';     //    Dababase Name

//API Section
$config['api']['kutt'] = 'xxxx';           // Kutt.it API Key
$config['api']['telegram'] = 'xx:xxxxx'; //  Telegram Bot API Key

//Admins Section
$config['admin']['owner'] = 'xxxxxxxxx';  //Super Admin Telegram ID
/**
* Admins Telegram ID | Optional
* IF you do not want to have an admin for your robot, do not change this area ELSE Complete it!
*/
$config['admin']['other'] = array(
  'admin1' => 'xxxxxxxxx',
  'admin2' => 'xxxxxxxxx',
);
