<?php
session_start();
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="description" content="ChatGo! è un portale innovativo di messaggistica online, 100% italiano e sicuro!">
  <meta name="keywords" content="ChatGo, ChatGo!">
  <meta name="author" content="Federico Cosma">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatGo! - Un nuovo modo di chattare</title>
  <link rel="stylesheet" href="https://chatgo.tk/assets/w3.css"> 
  <link rel="stylesheet" href="https://cdn.rgbcraft.com/static/fontawesome/css/all.min.css">
 </head>
 <body class='w3-text-white' style='background-color: black'>
  <div class="w3-bar w3-black w3-text-white" style="font-size: 25px">
   <a href="/" class="w3-bar-item w3-button w3-left">Home</a>
   <a href="/team" class="w3-bar-item w3-button w3-left">Team ChatGo</a>
   <a href="/developers/" class="w3-bar-item w3-button w3-left">Documentazione</a>
   <a href="/news" class="w3-bar-item w3-button w3-left">Notizie</a>
   <a href="/login" class="w3-right w3-bar-item w3-button"><?php if (empty($_SESSION["user"])) { echo "Accedi"; } else { echo "App"; } ?></a>
  </div> 
  <div class='w3-center'>
  <br><br>
  <h1>ChatGo! - Notizie</h1>
  <br><br><br><br>
<?php
foreach(glob('assets/news/*') as $file) {
  $filename = str_replace("assets/news/", "", $file);
  $info = explode("{}", file_get_contents($file));
?>
  <hr style='margin: auto; width: 50%'>
  <a href='/articoli/?r=<?= $info[3]; ?>' id='<?= $filename; ?>' style='text-decoration: none'>
   <h3><?= $info[0]; ?></h3>
   <span style='font-size: 14px'>Di: <?= $info[1]; ?> - Il: <?= $info[2]; ?></span>
   </a>
  <br><br>
<?php
}
?>
  <br><br><br><br><br><br>
 </body>
</html>