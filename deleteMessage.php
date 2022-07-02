<?php
session_start();
function authUser() {
  if (empty($_SESSION["user"]) || empty($_SESSION["token"])) {
    header("/app/login");
    die();
  }
}

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

$server = filter_var($_GET["server"], FILTER_SANITIZE_NUMBER_INT);
$channel = filter_var($_GET["channel"], FILTER_SANITIZE_NUMBER_INT);
$message = filter_var($_GET["message"], FILTER_SANITIZE_NUMBER_INT);

if (empty($server)) {
  die("EMPTY SERVER");
}

if (empty($channel)) {
  die("EMPTY SERVER");
}

if (empty($message)) {
  die("EMPTY SERVER");
}

// Ok, ora provvedo a inviare la richiesta al portale API
$res = json_decode(http('https://api.chatgo.tk/v3/server/' . $server . '/' . $channel . '/deleteMessage', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"], 'message' => $message)));

die(var_dump($res));