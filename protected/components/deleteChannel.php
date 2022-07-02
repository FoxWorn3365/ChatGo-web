<?php
session_start();

if (empty($_SESSION["token"])) {
  die("Unhautorized!");
}

$user = $_SESSION["UserID"];
$token = $_SESSION["token"];
$channel = filter_var($url[4], FILTER_SANITIZE_NUMBER_INT);
$server = filter_var($url[1], FILTER_SANITIZE_NUMBER_INT);

if (empty($server)) {
  die("EMPTY SERVER!");
}

if (empty($channel)) {
  die("EMPTY CHANNEL!");
}

$dev = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/channel/delete', array('UserID' => $user, 'token' => $token, 'channel' => $channel)));

if ($dev->status == 200) {
  header("Location: /app/server/$server/settings/canali");
} else {
  die("qualcosa è andato storto!");
}