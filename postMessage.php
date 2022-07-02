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


$id = $_SESSION["UserID"];
$token = $_SESSION["token"];

if (empty($token)) {
   die("NON AUTORIZZATO!");
}

$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
$channel =  filter_var($_POST["channel"], FILTER_SANITIZE_NUMBER_INT);
$server =  filter_var($_POST["server"], FILTER_SANITIZE_NUMBER_INT);

file_put_contents("log.txt", "AUTHOR: $id - MESSAGE: $message - CHANNEL: $channel - SERVER: $server - TIME: " . date("d/m/Y - H:i:s"));
if (empty($message)) {
   die("Empty message!");
} else {
   $res = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/' . $channel . '/message', array('UserID' => $id, 'token' => $token, 'message' => $message)));
   header("Location: /app/server/$server/channel/$channel/#fondo");
}