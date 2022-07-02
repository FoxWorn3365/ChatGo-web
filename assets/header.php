<?php
if (stripos($_SERVER["HTTP_USER_AGENT"], "Mobile") !== false) {
   require_once("assets/mobile_header.php");
} else {
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="description" content="ChatGo! è un portale innovativo di messaggistica online, 100% italiano e sicuro!">
  <meta name="keywords" content="ChatGo, ChatGo!">
  <meta name="author" content="Federico Cosma">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatGo! - Un nuovo modo di chattare</title>
  <link rel="stylesheet" href="https://chatgo.tk/assets/w3.css"> 
<?php if (date('d/m') == '25/04') { ?>  <link rel="stylesheet" href="https://fcosma.it/assets/css/special/25aprile.css">
<?php } ?>
  <link rel="stylesheet" href="https://cdn.rgbcraft.com/static/fontawesome/css/all.min.css">
 </head>
 <body class='w3-center w3-text-white' style='background-color: black' id='body'>
  <div id='notLoaded' style='display: none'></div>
  <div class="w3-sidebar w3-bar-block" id="mySidebar" style='<?php if (!empty($url[1]) && $url[0] != "user") { ?>display:none; <?php } else { ?>display: block; width:25%; <?php } ?>background-color: #3A3A3A; color: white'>
   <h5 class='w3-bar-item' id='serverping'><code style='color: orange'>Connessione ai server...</code></h5>
   <span class='w3-bar-item' style='font-size: 20px'>I tuoi server:</span>
<?php
if (!empty($_SESSION["user"]) && !empty($_SESSION["UserID"]) && !empty($_SESSION["token"])) {
$dev = get_object_vars(json_decode(http('http://api.chatgo.tk/v3/user/servers/' . $_SESSION["UserID"], array('token' => $_SESSION["token"]))));
for($a = 0; $a < count($dev["list"]); $a++) {
  $server = json_decode(file_get_contents("http://api.chatgo.tk/v3/server/" . $dev["list"][$a]. "/info"));
?>
   <a href="/app/server/<?= $dev["list"][$a]; ?>/" class="w3-bar-item w3-button"><?= $server->info->name; ?></a>
<?php
}
}
?>
   <h3 class='w3-bar-item w3-bottom'><a href='/app/settings/' class='w3-left'><i class="fa-solid fa-gears"></i></a></h3>
  </div>
  <div id='mySidebarChannels' class="w3-sidebar w3-bar-block w3-top w3-text-white" style="<?php if (empty($url[1]) || $url[0] == "user") { echo 'display:none; '; } ?>width:25%;left:0; background-color: #3A3A3A">
   <button class="w3-bar-item w3-button w3-left w3-display-top" onclick="w3_open_servers()" style='font-size: 25px;'><i class="fa-solid fa-angles-left"></i></button>
   <hr class='w3-bar-item' style='color: white'>
   <h5 class="w3-bar-item">Canali del server <?php if (json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->info->author == $_SESSION["UserID"]) {?><span class='w3-right'><a href='/app/server/<?= $url[1]; ?>/settings/general'><i class="fa-solid fa-gear"></i></a></span><?php } ?>&nbsp;&nbsp;&nbsp;<?= json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->info->name; ?></h5>
<?php
$dd = json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/channels', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])));
foreach ($dd->channels as $de) {
  $in = json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $de . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])));
  if (!empty($url[3]) && $url[3] == $de) {
    $tag = ' style="background-color: #727272"';
  } else {
    $tag = '';
  }
?>
   <a href="/app/server/<?= $url[1]; ?>/channel/<?= $de; ?>/#bottom" class="w3-bar-item w3-button"<?= $tag; ?>><?= $in->name; ?></a>
<?php
}
?>
  </div>
<?php
if (!empty($url[3]) && $url[2] == "channel") {
  $ch = json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $url[3] . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])));
?>
  <div class="w3-sidebar w3-bar-block w3-bottom w3-text-white" style="z-index: 2; width:25%; height: 25%; right:0; background-color: #3A3A3A">
   <hr class='w3-bar-item'>
   <h5 class="w3-bar-item">Canale #<?= $ch->name; ?></h5>
   <?= $ch->description; ?>
  </div>
<?php
}
?>
  <div id='inviteUser' class='w3-container w3-top w3-center' style='display:none; background-color: gray; left: 25%; max-width: 50%;'>
   <h2>Invita un amico sul server!</h2>
   Inoltragli questo link:<br>
   <code><u>https://chatgo.tk/app/invite/<?= $url[1]; ?></u></code>
   <br><br>
   <button onclick="invite_close()" class='w3-button w3-white w3-text-black'>Fatto!</button>
   <br><br>
  </div>
  <br>
  <script>
  function w3_open() {
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myDivvete").style.display = "none";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myDivvete").style.display = "block";
    document.getElementById("mySidebarChannels").style.display = "none";
  }

  function spoiler_invite_member() {
    document.getElementById("inviteUser").style.display = "block";
  }

  function invite_close() {
    document.getElementById("inviteUser").style.display = "none";
  }


  function w3_open_channels() {
    document.getElementById("mySidebarChannels").style.width = "25%";
    document.getElementById("mySidebarChannels").style.display = "block";
    document.getElementById("myDivvete").style.display = "none";
  }

  function w3_open_servers() {
    document.getElementById("mySidebarChannels").style.display = "none";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("mySidebar").style.width = "25%";
  }


  document.getElementById("body").addEventListener("load", ping_s());

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

  function ping_s() {
     http_request("https://api.chatgo.tk/ping");
     setTimeout(() => {
       if (document.getElementById("notLoaded").innerHTML == "ok") {
         document.getElementById("serverping").innerHTML = "<code style='color: green'><b>Connesso ai server!</b></code>";
       } else {
         document.getElementById("serverping").innerHTML = "<code style='color: red'><b>Non connesso ai server!</b></code>";
       }
     }, 2000);
   }
  </script>
  <script src="https://chatgo.tk/assets/main.js"></script> 
<?php
}
?>