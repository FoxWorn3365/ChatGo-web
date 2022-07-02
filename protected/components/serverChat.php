
  <!-- Parte purtroppo in JS per evitare un header ogni secondo lol -->
  <script type="text/javascript">
        function Ajax()
        {
            var
                $http,
                $self = arguments.callee;

            if (window.XMLHttpRequest) {
                $http = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                try {
                    $http = new ActiveXObject('Msxml2.XMLHTTP');
                } catch(e) {
                    $http = new ActiveXObject('Microsoft.XMLHTTP');
                }
            }

            if ($http) {
                $http.onreadystatechange = function()
                {
                    if (/4|^complete$/.test($http.readyState)) {
                        document.getElementById('ReloadThis').innerHTML = $http.responseText;
                        latestMessage();
                        <?php if ($args == "down") { ?> window.location.replace("#bottom"); <?php } ?>
                        setTimeout(function(){$self();}, 500);
                    }
                };
                $http.open('GET', 'https://chatgo.tk/getChat.php?user=<?= $_SESSION["UserID"]; ?>&server=<?= $url[1]; ?>&channel=<?= $url[3]; ?>', true);
                $http.send(null);
            }
        }
  </script>
  <script type="text/javascript">
      setTimeout(function() {Ajax();}, 500);
  </script>
  <!-- Finalmente parte JS conclusa. 'Sto coso recupera le cose giuste :D -->
  <br><br>
  <div style='display: none; float: left' id='chatLoaded'></div>
  <div class='w3-container w3-display-topmiddle' style='max-width: 50%;'>
   <br><br>
   <div id="ReloadThis">Caricamento della chat in corso...</div>
   <br><br><br><br><br><br><a id='bottom'><br><br><br></a>
  </div>
  <div id='impostazioni' class='w3-black w3-text-white w3-display-middle' style='border: solid 2px gray; display: none; padding: 10px'>
   <a class='w3-display-topright' style='padding: 10px' onclick='closeMessageSettings()'><i class="fa-solid fa-xmark"></i></a>
   <h2>Impostazioni Messaggio</h2>
   Impostazioni del messaggio con l'ID <a onclick='copyId()'><div id='message_id_settings'></div></a>
   <br>
   <button class='w3-button w3-white w3-text-black' onclick='shareMessage()'><i class="fa-solid fa-share-nodes"></i> Condividi</button>
   <?php if ($ow->info->author == $_SESSION["UserID"]) { ?> <button class='w3-button w3-red w3-text-white' onclick='deleteMessage()'><i class="fa-solid fa-dumpster"></i> Elimina</button> <?php } ?>
   <br><br><br>
  </div>
  <div id='notLoaded'></div>
  <script>
  function copyId() {
    navigator.clipboard.writeText(document.getElementById('message_id_settings').innerHTML);
  }

  function closeMessageSettings() {
    document.getElementById('impostazioni').style.display = "none";
    document.getElementById('message_id_settings').innerHTML = "";
  }

  function deleteMessage() {
    if (document.getElementById('message_id_settings').innerHTML != "") {
      http_request('/deleteMessage?message=' + document.getElementById('message_id_settings').innerHTML + '&server=<?= $url[1]; ?>&channel=<?= $url[3]; ?>');
      alert("Messaggio eliminato con successo!");
      setTimeout (() => { document.getElementById('impostazioni').style.display = "none" }, 1000);
    } else {
      alert("ERROR x012 - NON VALIDO! (ID)");
    }
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

  function notif(message) {
    var text = message;
    var title = "Nuovo messaggio - ChatGo!";
    var options = {
        body: text,
        vibrate: [200, 100, 200],
        tag: "new-message",
        badge: "https://spyna.it/icons/android-icon-192x192.png",
    };
    navigator.serviceWorker.ready.then(function(serviceWorker) {
      serviceWorker.showNotification(title, options);
    });
  }

  function shareMessage() {
    var msg = document.getElementById('message_id_settings').innerHTML;
    navigator.clipboard.writeText('https://chatgo.tk/app/server/<?= $url[1]; ?>/channel/<?= $url[3]; ?>/#' + msg);
    alert("Link copiato negli appunti!");
  }

  var id = 0;
  var sendN = 0;
  function latestMessage() {
    if (document.getElementById('latestMessageID').innerHTML != id) {
      if (sendN == 0) {
        sendN = 1;
        return;
      } else if (sendN == 1) {
        id = document.getElementById('latestMessageID').innerHTML;
        var text = document.getElementById('latestMessageAuthor').innerHTML + ': ' + document.getElementById('latestMessageContent').innerHTML;
        var notification = new Notification('Nuovo messaggio! - ChatGo!', { body: text});
      }
    }
  }

  function settings(id) {
    window.location.replace("#top");
    document.getElementById('message_id_settings').innerHTML = id;
    document.getElementById('impostazioni').style.display = "block";
  }
  </script>
      
      



