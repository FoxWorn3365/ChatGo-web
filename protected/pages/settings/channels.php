  <br><br>
  <a href='general'>Torna Indietro</a>
  <br>
  <h1>Impostazioni del Server - Canali</h1>
  <br><br>
  <a href='/app/server/<?= $url[1]; ?>/newChannel' style='font-size: 30px'><i class="fa-solid fa-circle-plus"></i></a>
  <br><br><hr style='margin: auto; width: 40%'><br>
<?php
$dd = json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/channels', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])));
foreach ($dd->channels as $de) {
  $in = json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $de . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])));
?>
  <span style='font-size: 25px'><?= $in->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/app/server/<?= $url[1]; ?>/settings/deleteChannel/<?= $de; ?>" style='color: red'><i class="fa-solid fa-trash-can"></i></a>&nbsp;&nbsp;&nbsp;<a onclick='alert("Al momento non è possibile cambiare e/o la descrizione ai canali!")'><i class="fa-solid fa-pen-to-square"></i></a></span><br>
<?php
}
?>
