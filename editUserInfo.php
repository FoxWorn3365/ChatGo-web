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

$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$descrizione = filter_var($_POST["descrizione"], FILTER_SANITIZE_STRING);

if (empty($_SESSION["token"])) {
  die("UNHAUTORIZED!");
}

if (empty($username)) {
  die("EMPTY USERNAME");
}

if (empty($descrizione)) {
  die("EMPTY DESCRIPTION!");
}

$dd = json_decode(http('http://api.chatgo.tk/v3/update/user/info/' . $_SESSION["UserID"], array('username' => $username, 'descrizione' => $descrizione, 'token' => $_SESSION["token"])));

header('Location: ' . $_SERVER["HTTP_REFERER"]);