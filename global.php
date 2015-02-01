<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$session_timeout = 86400; // 24 hours
session_start(); // Start session
setcookie(session_name(), session_id(), time() + $session_timeout); // CORRECT SESSION TIMING! The session will always reset the timing every time the page is refreshed or changes. 

$debug = false;
if ($debug == true) {
    $_SESSION['username']="<USERNAME>"; // Replace with your snapchat username
    $_SESSION['password']="<PASSWORD>"; // Replace with your snapchat password
}

// Check if session exists
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

require_once("snapchat.php");

$snapchat = new Snapchat($_SESSION['username'], $_SESSION['password']);

// Authenticate session
if ($snapchat->auth_token == "") {
    header("Location: login.php");
}

$points = $snapchat->cache->get("updates")->score;

// Function for generating a random string
function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}