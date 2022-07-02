  <br><br>
  <?php
  $user = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $url[1])); 
  ?>
  <h2>Utente <?= $user->info->username; ?><span style='font-size: 12px'>#<?= $user->info->discriminator; ?></span></h2>
  <br>
  <span style='font-size: 20px;'><b>Chi sono:</b></span><br>
  <?= $user->info->descrizione; ?>