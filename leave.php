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

$server = filter_var($_GET["serverid"], FILTER_SANITIZE_STRING);

if (empty($server)) {
  die("EMPTY SERVER!");
}

if (empty($_SESSION["token"])) {
  die("UNHAUTORIZED!");
}

$de = json_decode(http('http://api.chatgo.tk/v3/user/leaveServer/' . $_SESSION["UserID"], array('server' => $server, 'token' => $_SESSION["token"])));

header('Location: ' . $_SERVER["HTTP_REFERER"]);