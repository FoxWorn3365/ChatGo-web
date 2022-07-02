  <br><br>
  <h1>Impostazioni Utente</h1>
<?php
$user = $_SESSION["UserID"];

$info = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $user));
?>
  <br>
  <span style='font-size: 20px'>Utente: <b><?= $info->info->username; ?>#<?= $info->info->discriminator; ?></b></span>
  <br><br>
  <form method="POST" action="/editUserInfo">
   <b>Username:</b><br>
   <input type="text" name="username" value="<?= $info->info->username; ?>"><b>#</b><input type="text" name="discriminator" value="<?= $info->info->discriminator; ?>" disabled><br>
   <b>Descrizione:</b><br>
   <input type="text" name="descrizione" value="<?= $info->info->descrizione; ?>" style='width: 40%'><br>
   <br>
   <button class='w3-button w3-white'>Modifica!</button>
  </form>