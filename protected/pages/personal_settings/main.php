  <br><br>
  <h1>Impostazioni Utente</h1>
<?php
$user = $_SESSION["UserID"];

$info = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $user));
?>
  <br>
  <span style='font-size: 20px'>Utente: <b><?= $info->info->username; ?>#<?= $info->info->discriminator; ?></b></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a onclick='showID()'><i class="fa-solid fa-id-badge"></i></a>
  <br><br><br>
  <a href='/app/settings/info'><button class='w3-button w3-white w3-text-black'><i class="fa-solid fa-user-large"></i> <b>Informazioni Personali</b></button></a>
  <a href='/app/settings/email'><button class='w3-button w3-white w3-text-black'><i class="fa-solid fa-envelope"></i> <b>Email</b></button></a>
  <button class='w3-button w3-white w3-text-black' onclick='localsettings()'><i class="fa-solid fa-gear"></i> <b>Preferenze Locali</b></button><br><br>
  <a href='/app/settings/server'><button class='w3-button w3-white w3-text-black'><i class="fa-solid fa-server"></i> <b>I tuoi Server</b></button></a>
  <button class='w3-button w3-white w3-text-black' id='notifiche' onclick='requestNotifiche()'><i class="fa-solid fa-spinner"></i> Caricamento delle preferenze...</button></a><br><br>
  <a href='/logout'><button class='w3-button w3-orange w3-text-white'><i class="fa-solid fa-arrow-right-from-bracket"></i> <b>Esci</b></button></a>
  <br><br><h3>Zona Importante</h3>
  <button class='w3-button w3-red w3-text-white' onclick='confirm_deleting()'><i class="fa-solid fa-ban"></i> Elimina l'account</button>   <a href='/app/new/server'><button class='w3-button w3-green w3-text-white'><i class="fa-solid fa-circle-plus"></i> Crea Server</button></a>  <button class='w3-button w3-red w3-text-white' onclick='open_revoke_token()'><i class="fa-solid fa-circle-minus"></i> <b>Revoca <u>tutti</u> i Yoken</b></button>
  <br><br>
  <h3>Zona dati Personali</h3>
  <a href='/requireData'><button class='w3-button w3-orange w3-text-white' disabled><i class="fa-solid fa-database"></i> Richiedi i tuoi dati</button></a>
  <div class='w3-container w3-display-middle w3-black w3-text-white' style='display: none; border: solid 2px white' id='conferma_eliminazione_account'>
   <h1>Vuoi davvero eliminare l'account?</h1>
   Ricordiamo che eliminando l'account tutti i dati,<br>i server e le chat private legate<br>a questo account verranno <u>permanentemente eliminati</u><br>(E dico in modo irreversibile, quindi PENSACI BENE)<br><br>
   <button class='w3-button w3-red w3-text-white' onclick='alert("Questa funzione arriverà a breve!")'><b>Conferma e Procedi!</b></button> <button class='w3-button w3-green w3-text-white' onclick='close_deleting()'><b>Annulla!</b></button>
   <br><br>
  </div>
  <div class='w3-container w3-display-middle w3-black w3-text-white' style='display: none; border: solid 2px white' id='conferma_revocazione_token'>
   <h1>Vuoi davvero revocare <u>tutti</u> i token di accesso?</h1>
   Ricordiamo che revocando tutti i token verrai sloggato da tutte le sessioni attive e dovrai rieffettuare il login<br><br>
   <button class='w3-button w3-red w3-text-white' onclick='goto_revoke()'><b>Conferma e Procedi!</b></button> <button class='w3-button w3-green w3-text-white' onclick='close_revoke_token()'><b>Annulla!</b></button>
   <br><br>
  </div>
  <div class='w3-container w3-display-middle w3-black w3-text-white' style='display: none; border: solid 2px white' id='localsettings'>
   <h1>Impostazioni locali</h1>
   Queste impostazioni vengono salvate solo sul client tramite cookie
   <br><br>
   <b>Dimensione del testo delle chat:</b>
<?php
if (isset($_COOKIE["textSize"])) {
  $tx = ' value="' . $_COOKIE["textSize"] . '"';
} else {
  $tx = "";
}
?>
   <input type="number" id='numero'<?= $tx; ?>>px (pixel)<br><span style='font-size: 18px'>Questo testo è in 18px</span><br><button class='w3-button w3-white w3-text-black' onclick='pxsize()'>Modifica!</button> <button class='w3-button w3-white w3-text-black' onclick='document.getElementById("numero").value = 17; pxsize()'><b>Ripristina</b></button> <button class='w3-button w3-white w3-text-black' onclick='pxsize_close()'>Chiudi</button>
   <br><br>
  </div>
  <div class='w3-container w3-display-middle w3-black w3-text-white' style='display: none; border: solid 2px white' id='showuserid'>
   <h1>ID dell'Utente</h1>
   Questo ID ti identifica ed è univoco e non si può cambiare!<br>
   <code style='font-size: 20px'><u><?= $_SESSION["UserID"]; ?></u></code>
   <br><br>
   <button class='w3-button w3-white w3-text-black' onclick='document.getElementById("showuserid").style.display = "none"'>Chiudi</button>
   <br>
   <br>
  </div>

  <script>
  document.getElementById('body').addEventListener("load", notifiche());

  function notifiche() {
    if (Notification.permission === 'denied' || Notification.permission === 'default') {
      document.getElementById("notifiche").innerHTML = '<i class="fa-solid fa-x"></i> <b>Notifiche non attive</b>';
    } else {
      document.getElementById("notifiche").innerHTML = '<i class="fa-solid fa-check"></i> <b>Notifiche attive</b>';
    }
  }

  function requestNotifiche() {
    if (Notification.permission === 'denied' || Notification.permission === 'default') {
      Notification.requestPermission();
    }
  }

  function confirm_deleting() {
     document.getElementById("conferma_eliminazione_account").style.display = "block";
  }

  function close_deleting() {
     document.getElementById("conferma_eliminazione_account").style.display = "none";
  }

  function header_to_delete() {
     window.location.replace("https://chatgo.tk/deleteAccount");
  }

  function open_revoke_token() {
     document.getElementById("conferma_revocazione_token").style.display = "block";
  }

  function close_revoke_token() {
     document.getElementById("conferma_revocazione_token").style.display = "none";
  }

  function goto_revoke() {
     window.location.replace("https://chatgo.tk/revokeAll");
  }

  function http_request(web) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         document.getElementById("notLoaded").innerHTML = xhttp.responseText;
         return xhttp.responseText;
      }
    };
    xhttp.open("GET", web, true);
    xhttp.send();
  }

  function localsettings() {
    document.getElementById("localsettings").style.display = "block";
  }

  function pxsize() {
    var input = document.getElementById("numero").value;

    if (input == "") {
       alert("L'input non può essere vuoto!");
    } else {
      http_request('https://chatgo.tk/updateLocalPixel?px=' + input);
      alert("Modifiche apportate con successo nei cookie!");
    }
  }

  function pxsize_close() {
    document.getElementById("localsettings").style.display = "none";
  }

  function showID() {
    document.getElementById("showuserid").style.display = "block";
  }
  </script>
  <br><br><br><br><br><br><br><br><br>