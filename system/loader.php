<?
// Load Requirement File

date_default_timezone_set('Asia/Tehran');
global $config;
require_once(getcwd().'/config.php');
require_once(getcwd().'/system/db.php');
require_once(getcwd().'/model/admin.php');
require_once(getcwd().'/model/users.php');
require_once(getcwd().'/assets/lib/request/library/Requests.php');
require_once(getcwd().'/assets/admin/keyboard.php');
require_once(getcwd().'/locale/en.php');
require_once(getcwd().'/system/function/telegram.php');
require_once(getcwd().'/system/function/common.php');

