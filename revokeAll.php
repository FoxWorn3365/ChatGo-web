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

if (empty($_SESSION["token"])) {
  die("UNHAUTORIZED");
}

$dev = json_decode(http('http://api.chatgo.tk/v3/user/revokeAllTokens/' . $_SESSION["UserID"], array('token' => $_SESSION["token"])));

header("Location: /logout");
