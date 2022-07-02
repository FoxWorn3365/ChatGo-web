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

if (!empty($_COOKIE["__auth"])) {
  $dev = explode("; and ", $_COOKIE["__auth"]);
  $id = $dev[0];
  $token = $dev[1];
  $auth = json_decode(http('https://api.chatgo.tk/v3/user/validateToken/' . $id, array('token' => $token)));
  if ($auth->status == 200) {
    $_SESSION["user"] = $dev[2];
    $_SESSION["UserID"] = $id;
    $_SESSION["token"] = $token;
    if (!empty($href)) {
      header("Location: https://chatgo.tk$href");
      exit;
    } else {
      header("Location: https://chatgo.tk/app/home");
      exit;
    }
  } else {
    header("Location: /login?error");
    exit;
  }
}

$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$href = filter_var($_POST["href"], FILTER_SANITIZE_STRING);
$remember = filter_var($_POST["ricordami"], FILTER_SANITIZE_NUMBER_INT);

$id = json_decode(http('http://api.chatgo.tk/v3/user/getUserIDByEmail', array('email' => $email)));
$auth = json_decode(http('http://api.chatgo.tk/v3/user/auth/' . $id->username, array('password' => $password)));

if (!empty($auth->token)) {
  $username = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $id->username));
  $_SESSION["user"] = $username->info->username;
  $_SESSION["UserID"] = $id->username;
  $_SESSION["token"] = $auth->token;
  if ($remember == 1) {
    setcookie('__auth', $id->username . '; and ' . $auth->token .'; and ' . $username->info->username, time() + (86400 * 30), '/');
  }
  if (!empty($href)) {
    header("Location: https://chatgo.tk$href");
    exit;
  } else {
    header("Location: https://chatgo.tk/app/home");
    exit;
  }
} else {
  header("Location: /login?error");
  exit;
}
