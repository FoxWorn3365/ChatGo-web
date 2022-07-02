<?php
session_start();
function http($url, $dev=array()) {

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded",
          'method'  => 'POST',
          'content' => http_build_query($dev)
      )
  );
  $context  = stream_context_create($options);
  return file_get_contents($url, false, $context);
}

$id = filter_var($_GET["user"], FILTER_SANITIZE_NUMBER_INT);
$server = filter_var($_GET["server"], FILTER_SANITIZE_NUMBER_INT);
$channel = filter_var($_GET["channel"], FILTER_SANITIZE_NUMBER_INT);
$token = $_SESSION["token"];

if (empty($id)) {
  die("EMPTY ID!");
}

if (empty($server)) {
  die("EMPTY server");
}

if (empty($channel)) {
  die("EMPTY channel");
}

if (empty($token)) {
  die("EMPTY token");
}

$getChat = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/' . $channel . '/chat', array('UserID' => $id, 'token' => $token)));

$count = 0;
$dd = $getChat->messaggi;

if (isset($_COOKIE["textSize"])) {
  $size = filter_var($_COOKIE["textSize"], FILTER_SANITIZE_NUMBER_INT);
} else {
  $size = '17';
}

if ($getChat->status == 200) {
  foreach($getChat->log as $msg) {
  $count++;
  $message = $msg->message;
  $inf = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $msg->author_id));
  if (date("d/m/Y", $msg->date) == date("d/m/Y")) {
    $giorno = "Oggi alle " . date("H:i", $msg->date);
  } else {
    $giorno = date("d/m/Y - H:i", $msg->date);
  }

  if ($count == $dd) {
?>
  <div id='latestMessageID' style='display: none'><?= $msg->id; ?></div>
  <div id='latestMessageAuthor' style='display: none'><?= $msg->author_nick; ?></div>
  <div id='latestMessageContent' style='display: none'><?= $msg->message; ?></div>
<?php
  }
 
  // PLACEHOLDER
  $message = str_replace("[cdnimg]", "<img src='https://chatgo.tk/cdn/images/", str_replace("[/cdnimg]", "' width='35%' height='20%'>", $message));
  $message = str_replace("[img]", "<img src='", str_replace("[/img]", "' width='35%' height='20%'>", $message));
  $message = str_replace("[link]", "<a href='", str_replace("[/link]", "'><u>Ha inviato un link</u></a>", $message));
  $message = str_replace("[b]", "<b>", str_replace("[/b]", "</b>", $message));
  $message = str_replace("[i]", "<i>", str_replace("[/i]", "</i>", $message));
  $message = str_replace("[u]", "<u>", str_replace("[/u]", "</u>", $message));
  $message = str_replace("[s]", "<s>", str_replace("[/s]", "</s>", $message));
  $message = str_replace("[orange]", "<span style='color: orange'>", str_replace("[/orange]", "</span>", $message));
  $message = str_replace("[blue]", "<span style='color: blue'>", str_replace("[/blue]", "</span>", $message));
  $message = str_replace("[red]", "<span style='color: red'>", str_replace("[/red]", "</span>", $message));
  $message = str_replace("[yellow]", "<span style='color: yellow'>", str_replace("[/yellow]", "</span>", $message));
?>
  <a id='<?= $msg->id; ?>'>
   <div id='message' class='w3-container' style='text-align: left'>
    <button class='w3-button w3-hover-gray' style='position: absolute; right: 0%' onclick='settings(<?= $msg->id; ?>)'><i class="fa-solid fa-ellipsis-vertical"></i></button>
    <a style='text-decoration: none' href='/app/user/<?= $msg->author_id; ?>/'><span style='font-size: 20px'><b><?= $msg->author_nick; ?></b></span></a><span style='font-size: 10px'>#<?= $inf->info->discriminator; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size: 10px'><?= $giorno; ?></span><br>
    <span style='font-size: <?= $size; ?>px'><?= $message; ?></span><br>
    <br>
   </div>
  </a>
<?php
  }
} else {
  die('ERRORE NEL CARICAMENTO DELLA CHAT! - ' . var_dump($getChat) . ' - RQ = http://api.chatgo.tk/v3/server/' . $server . '/' . $channel . '/chat');
}
?>
