<?php
$id = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'));
?>
  <br><br>
  <h1>Sei stato invitato per far parte del server: <?= $id->info->name; ?></h1>
  <br><br><br>
  <a href='/app/confirmInvite/<?= $url[1]; ?>/'><button class='w3-button w3-white w3-text-black'>Accetta!</button></a>
