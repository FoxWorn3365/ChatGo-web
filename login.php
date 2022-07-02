<?php
session_start(); 
if (!empty($_SESSION["token"])) {
  header("Location: /app/home");
  die();
}

if (!empty($_COOKIE["__auth"]) && !isset($_GET["error"])) {
  header("Location: /auth");
  die();
}

require("assets/not_header.php"); 
?>
  <br><br>
  <h1>Accedi a ChatGo!</h1>
  <br><br><br>
  <form method="POST" action="/auth">
    <?php if (!empty($_GET["href"])) { echo '<input type="hidden" name="href" value="' . $_GET["href"] . '">'; } ?>
    Email:<br>
    <input type="email" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <b>Ricordami  &nbsp;&nbsp;&nbsp;<a onclick='openInfoRemember()'><i class="fa-solid fa-circle-info"></i></a></b>&nbsp;&nbsp;
    <input type="radio" name="ricordami" value="1">
    <br><br>
    <button class='w3-button w3-orange w3-text-white'>Accedi</button>
  </form>
  <br>
  <div id='notLoaded' style='display: none'></div>
  <a style='font-size: 15px' href='/register'><b>Non hai un account?</b></a>
  <div class='w3-container w3-black w3-text-white w3-display-middle' style='display: none; border: solid 2px white' id='info'>
   <h1>Funzione "Ricordami"</h1>
   La funzione <u>Ricordami</u> ti permette di non dover più effettuare l'accesso ogni<br>
   volta che scade la sessione. Ovviamente ti potrai sloggare anche da questo metodo tramite
   l'apposito bottone <b><u>Esci</u></b> situato nelle impostazioni<br><br>
   <button class='w3-button w3-white w3-text-black' onclick='document.getElementById("info").style.display = "none";'>Ho capito!</button>
   <br><br>
  </div>
  <div class='w3-container w3-gray w3-text-white w3-display-middle' style='display: none; width: 25%' id='connecting'>
    <br>
    <center><div class="loader" id='load'></div></center>
    <div id='text_to_load'></div>
    <br>
  </div>
  <script>
  document.getElementById("body").addEventListener("load", connectToServers());

  function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
      currentDate = Date.now();
    } while (currentDate - date < milliseconds);
  }

  function connectToServers() {
    show("connecting");
    document.getElementById("text_to_load").innerHTML = "<span style='color: orange'>Connessione ai server centrali in corso</span>";
    http_request("https://api.chatgo.tk/ping");
    setTimeout(() => {
     if (document.getElementById("notLoaded").innerHTML == "ok") {
       close("load");
       document.getElementById("text_to_load").innerHTML = "<span style='font-size: 35px'><i class='fa-solid fa-circle-check'></i></span><br><span style='color: green'>Connesso ai server centrali</span>";
       setTimeout(() => { document.getElementById("connecting").style.display = "none"; }, 1500);
     } else {
       close("load");
       document.getElementById("text_to_load").innerHTML = "<span style='font-size: 35px'><i class='fa-solid fa-circle-xmark'></i></span><br><span style='color: red'><u>Connessione FALLITA!</u></span>";
     }
    }, 1000);
  }

  function openInfoRemember() {
    close("info");
  }

  function show(id) {
    document.getElementById(id).style.display = "block";
  }

  function close(id) {
    document.getElementById(id).style.display = "none";
  }

  function getResponse() {
    return document.getElementById("notLoaded").innerHTML;
  }

  function http_request(web) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         document.getElementById("notLoaded").innerHTML = xhttp.responseText;
      }
    };
    xhttp.open("GET", web, true);
    xhttp.send();
  }
  </script>