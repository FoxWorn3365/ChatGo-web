  <br><br>
  <a href='general'>Torna Indietro</a>
  <br>
  <h1>Impostazioni del Server - Membri</h1>
  <br><br><hr style='margin: auto; width: 40%'><br>
<?php
$dd = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/members'));
foreach ($dd->members as $de) {
  $in = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $de));
?>
  <span style='font-size: 25px'><?= $in->info->username . '#' . $in->info->discriminator; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/banUser?user=<?= $de; ?>&server=<?= $url[1]; ?>" style='color: red'><i class="fa-solid fa-hammer"></i></a>&nbsp;&nbsp;&nbsp;<a href='/kickUser?user=<?= $de; ?>&server=<?= $url[1]; ?>'><i class="fa-solid fa-ban"></i></i></a></span><br>
<?php
}
?>
