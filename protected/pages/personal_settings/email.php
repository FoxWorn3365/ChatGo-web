  <br><br>
  <h1>Impostazioni Utente - Email</h1>
<?php
$user = $_SESSION["UserID"];

$info = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $user));
?>
  <br>
  <span style='font-size: 20px'>Utente: <b><?= $info->info->username; ?>#<?= $info->info->discriminator; ?></b></span>
  <br><br>
  Quest'email verrà utilizzata solo per le comunicazioni <u>urgenti</u> e per inviare i dati personali quando vengono richiesti<br><br>
  <form method="POST" action="/editEmail">
   <b>Email:</b><br>
<?php
$email = json_decode(http('https://api.chatgo.tk/v3/user/email/' . $user, array('token' => $_SESSION["token"])));
?>
   <input type="email" name="email" value="<?= $email->email; ?>" width="30%">
   <br><br>
   <input type='submit' class='w3-button w3-white w3-text-black' value='Modifica'>
  </form>
