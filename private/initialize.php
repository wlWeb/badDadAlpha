<?php
ob_start(); // output buffering on
session_start(); // turn on sessions

define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
$public_end = strpos($_SERVER['SCRIPT_NAME'], 'baddadalpha') + 11;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

include('functions.php');
include('database.php');
include('query_functions.php');
include('validation_functions.php');
include('auth_functions.php');


$db = db_connect();
$errors = [];

?>