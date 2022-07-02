<?php
session_start();

$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

$id = json_decode(http('http://api.chatgo.tk/v3/user/getUserIDByEmail', array('email' => $email)));
$auth = json_decode(http('http://api.chatgo.tk/v3/user/auth/' . $id->username, array('password' => $password)));

if (!empty($auth->token)) {
  $username = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $id->username));
  $_SESSION["user"] = $username->info->username;
  $_SESSION["UserID"] = $id->username;
  $_SESSION["token"] = $auth->token;
  header("Location: /app/home");
  exit;
} else {
  header("Location: /app/login?error=password");
  exit;
}
