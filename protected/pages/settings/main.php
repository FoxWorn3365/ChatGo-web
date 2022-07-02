  <br><br>
  <?php $server = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info')); ?>
  <h1>Impostazioni del Server</h1>
  Da qui potrai personalizzare il tuo server, modificandone la descrizione, il nome e molto altro!
  <br><br><br>
  <b>Nome:</b><br>
  <input type="text" name="server_name" value="<?= $server->info->name; ?>" disabled><br>
  <b>Descrizione:</b><br>
  <input type="text" name="server_description" value="<?= $server->info->description; ?>" style="width: 25%" disabled>
  <br><br>
  <button class='w3-button w3-text-black w3-white' onclick='alert("Al momento non si possono cambiare nome e/o descrizione!")'>Modifica!</button>
  <br><br><br>
  <a href='canali'><button class='w3-button w3-white w3-text-black'>Gestione Canali</button></a><br><br>
  <a href='membri'><button class='w3-button w3-white w3-text-black'>Gestione Membri</button></a>
  <br><br><br><br>
  <a href='/deleteServer?server=<?= $url[1]; ?>'><button class='w3-button w3-red w3-text-white'>Elimina Server!</button></a>
  <br><br><br>