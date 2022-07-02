<?php
session_start();
function http($url, $dev=array()) {

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded",
          'method'  => 'POST',
          'content' => http_build_query($dev)
      )
  );
  $context  = stream_context_create($options);
  return file_get_contents($url, false, $context);
}

$server = $_GET["server"];
$id = $_SESSION["UserID"];
$user = $_GET["user"];
$token = $_SESSION["token"];

if (empty($token)) {
  die("UNHAUTORIZED");
}

if (empty($server)) {
  die("EMPTY SERVER");
}

if (empty($user)) {
  die("EMPTY USER TO BAN!");
}

$dev = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/kick', array('UserID' => $id, 'token' => $token, 'user' => $user)));

header("Location: /app/server/$server/settings/membri");