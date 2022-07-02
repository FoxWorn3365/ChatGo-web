  <div class='w3-container w3-center w3-bottom w3-black w3-bottom' style='width: 100%;'>
   <button class='w3-right w3-bottom w3-button w3-white w3-text-black' style='width: 50px; left: 86%; bottom: 20px' onclick='imageForm()'><i class="fa-solid fa-image"></i></button>
   <button class='w3-right w3-bottom w3-button w3-white w3-text-black' style='width: 50px; left: 86%; bottom: 80px' onclick='goDown()'><i class="fa-solid fa-arrow-down"></i></button>
   <hr>
   <form id='postAMessage'>
    <input type="hidden" name="server" value="<?= $url[1]; ?>" id='server'>
    <input type="hidden" name="channel" value="<?= $url[3]; ?>" id='channel'>
    <input id='getMessageFromChannel' type="text" name='message' style='width: 75%; height: 75px; background-color: #363636; border: none; color: white'>
    <br><br>
    <input type='submit' class='w3-button w3-white w3-text-black w3-hover-gray w3-hover-text-white' value='Invia' onclick='return clickButton();'>
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

function goDown() {
   window.location.replace("#bottom");
}

function clickButton(){
    var server=document.getElementById('server').value;
    var channel=document.getElementById('channel').value;
    var message=document.getElementById('getMessageFromChannel').value;
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