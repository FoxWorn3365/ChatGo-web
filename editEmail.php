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

$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);

if (empty($email)) {
  die("DIE");
}

$reponse = json_decode(http('https://api.chatgo.tk/v3/update/user/email/' . $_SESSION["UserID"], array('token' => $_SESSION["token"], 'email' => $email)));

header('Location: ' . $_SERVER["HTTP_REFERER"]);