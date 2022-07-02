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

$rs = json_decode(http('http://api.chatgo.tk/v3/server/new', array('UserID' => $author, 'token' => $token, 'name' => $nome, 'description' => $descrizione)));

header("Location: /app/server/$rs->serverId/channel/000000001/");