  <br><br>
  <h1>Impostazioni Utente</h1>
<?php
$user = $_SESSION["UserID"];

$info = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $user));
?>
  <br>
  <span style='font-size: 20px'>Utente: <b><?= $info->info->username; ?>#<?= $info->info->discriminator; ?></b></span>
  <br><br>
  <h2>I tuoi server:</h2>
<?php
$servers = json_decode(http('http://api.chatgo.tk/v3/user/servers/' . $user, array('token' => $_SESSION["token"])));

foreach ($servers->list as $server) {
    $serverinfo = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $server . '/info'));
?>
  <span style='font-size: 22px'><?= $serverinfo->info->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='position: absolute; right: 35%'><a href='/leave?serverid=<?= $server; ?>' style='color: red'><i class="fa-solid fa-arrow-right-from-bracket"></i></a></span></span><br>
<?php
}
?>