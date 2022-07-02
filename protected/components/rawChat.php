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
  <link rel="stylesheet" href="https://cdn.rgbcraft.com/static/fontawesome/css/all.min.css">
 </head>
 <body class='w3-center w3-text-white' style='background-color: black' onload='window.scrollTo(0,document.body.scrollHeight);'>
  
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
                        <?php if ($args == "down") { ?>window.location.replace("#bottom");<?php } ?>
                        setTimeout(function(){$self();}, 1000);
                    }
                };
                $http.open('GET', 'https://chatgo.tk/getChat.php?user=<?= $_SESSION["UserID"]; ?>&server=<?= $url[1]; ?>&channel=<?= $url[3]; ?>', true);
                $http.send(null);
            }

        }
  </script>
  <script type="text/javascript">
      setTimeout(function() {Ajax();}, 1000);
  </script>
  <!-- Finalmente parte JS conclusa. 'Sto coso recupera le cose giuste :D -->
  <br><br>
  <div class='w3-container w3-top w3-display-topmiddle' style='max-width: 50%;'>
   <br><br>
   <div id="ReloadThis" onload='goDown'>Caricamento della chat in corso...</div>
   <br><br><br><br><br><br><a id='bottom'><br><br><br></a>
  </div>
  <div class='w3-container w3-center w3-bottom w3-black w3-bottom' style='width: 50%; left: 25%'>
   <button class='w3-right w3-bottom w3-button w3-white w3-text-black' style='width: 50px; left: 67%; bottom: 20px' onclick='imageForm()'><i class="fa-solid fa-image"></i></button>
   <hr>
   <form id='postAMessage'>
    <input type="hidden" name="server" value="<?= $url[1]; ?>" id='server'>
    <input type="hidden" name="channel" value="<?= $url[3]; ?>" id='channel'>
    <input type="text" name='message' style='width: 75%; height: 75px; background-color: #363636; border: none; color: white' id='messageOfChannelNew'>
    <br><br>
    <input type='submit' class='w3-button w3-white w3-text-black w3-hover-gray w3-hover-text-white' value='invia' onclick='return clickButton();'>
   </form>
   <br>
  </div>
  <div class='w3-display-middle w3-gray w3-text-white' style='z-index: 5; display:none; padding: 10px' id='postImage'>
    <br>
    Carica un immagine sulla chat!<br><br>
    <form enctype="multipart/form-data" action="/postImageChat?server=<?= $url[1]; ?>&channel=<?= $url[3]; ?>" method="POST">
     <input type="hidden" name="MAX_FILE_SIZE" value="30000">
     Invia questo file: <input name="userfile" type="file"></br><br>
     <input type="submit" class='w3-button w3-text-black w3-white' value="Invia File">
     <br>
     <br>
    </form>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
function imageForm() {
   window.location.replace("#top");
   document.getElementById("postImage").style.display = "block";
}

function clickButton(){
    var server=document.getElementById('server').value;
    var channel=document.getElementById('channel').value;
    var message=document.getElementById('messageOfChannelNew').value;
    document.getElementById("postAMessage").reset();
    $.ajax({
        type:"post",
        url:"https://chatgo.tk/postMessage",
        data: 
        {  
           'server' :server,
           'channel' :channel,
           'message' :message
        },
        cache:false,
        success: function (html) 
        {
           $('#msg').html(html);
        }
    });
    return false;
 }
</script>