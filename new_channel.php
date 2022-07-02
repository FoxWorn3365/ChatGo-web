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


$token = $_SESSION["token"];
$author = $_SESSION["UserID"];
$rs = filter_var($_POST["restricted"], FILTER_SANITIZE_STRING);
$server = filter_var($_POST["server"], FILTER_SANITIZE_NUMBER_INT);
$nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
$descrizione = filter_var($_POST["descrizione"], FILTER_SANITIZE_STRING);

if (empty($token)) {
  die("Token");
}

if (empty($nome)) {
  die("EMPTY nome");
}

if (empty($descrizione)) {
  die("EMPTY descrizione");
}

if (empty($server)) {
  die("EMPTY descrizione");
}

if (empty($rs)) {
  $type = "public";
} else {
  $type = "restricted";
}

$rs = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/channel/new', array('UserID' => $author, 'token' => $token, 'name' => $nome, 'description' => $descrizione, 'type' => $type)));

header("Location: /app/server/$server/channel/$rs->channelID/");