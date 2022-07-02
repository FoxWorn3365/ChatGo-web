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


$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

if (empty($email)) {
  die("EMPTY email");
}

if (empty($username)) {
  die("EMPTY uname");
}

if (empty($password)) {
  die("EMPTY passwd");
}

$res = json_decode(http('http://api.chatgo.tk/v3/user/new', array('username' => $username, 'password' => $password, 'descrizione' => 'Nuovo utente!', 'email' => $email)));

$_SESSION["username"] = $username;
$_SESSION["UserID"] = $res->id;
$_SESSION["token"] = $res->accessToken;

header("Location: /app/home");