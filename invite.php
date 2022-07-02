<?php
$u = $_GET["user"];
if (empty($u)) {
  header("Location: /login");
}

$user = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $u));
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="description" content="ChatGo! è un portale innovativo di messaggistica online. <?= $user->info->username; ?> ti ha invitato ad entrare su ChatGo! per chattare! Registrati in qualche secondo e divertiti con i tupi amici!">
  <meta name="keywords" content="ChatGo, ChatGo!">
  <meta name="author" content="Federico Cosma">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatGo! - Un nuovo modo di chattare</title>
  <link rel="stylesheet" href="https://chatgo.tk/assets/w3.css"> 
  <link rel="stylesheet" href="https://cdn.rgbcraft.com/static/fontawesome/css/all.min.css">
 </head>
 <body class='w3-center w3-text-white' style='background-color: black'>
  <br><br>
  <h1>Unisciti a ChatGo!</h1>
  ChatGo! è una nuovissima piattaforma di messaggistica!<br><br>
  Entra con <?= $user->info->username; ?> e divertiti a chattare con lui!
  <br><br><br>
  <form method="POST" action="/newUser">
    Username:<br>
    <input type="text" name="username"><br>
    Email:<br>
    <input type="email" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <button class='w3-button w3-orange w3-text-white'>Registrati!</button>
  </form>
  <br>
  <a style='font-size: 15px' href='/login'><b>Hai già un account?</b></a>
  <br><br>