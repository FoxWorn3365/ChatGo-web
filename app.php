<?php
session_start();
function authUser() {
  if (empty($_SESSION["user"]) || empty($_SESSION["token"])) {
    header("/app/login");
    die();
  }
}

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

function footer() {
  require_once("assets/footer.php");
}

function page($page) {
  require_once("protected/pages/$page");
}

// $_SESSION["user"] = NICKNAME
// $_SESSION["token"] = TOKEN
// UHHHHHHH CHE EMOZIONE IL FILE PRINCIPALEEEEE
$url = $_GET["url"];
$args = $_GET["args"];
$url = explode("/", str_replace("/app/", "", $url));

if (empty($_SESSION["UserID"])) {
  header("Location: /login?href=" . $_GET["url"]);
}

if ($url[0] == "home") {
   require_once("assets/header.php");
   page("home.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && empty($url[2]) && empty($url[3])) {
   require_once("assets/header.php");
   require_once("protected/components/serverBar.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "channel" && json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $url[3] . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])))->status == 200 && $url[4] != "raw") {
   require_once("assets/header.php");
   require_once("protected/components/serverBar.php");
   require_once("protected/components/serverChat.php");
   require_once("protected/components/serverInput.php");
} elseif ($url[0] == "new" && $url[1] == "server") {
   require_once("assets/header.php");
   require_once("protected/components/newServerForm.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "newChannel") {
   require_once("assets/header.php");
   require_once("protected/components/newChannelForm.php");
} elseif ($url[0] == "invite" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200) {
   require_once("assets/header.php");
   require_once("protected/components/invite.php");
} elseif ($url[0] == "confirmInvite" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200) {
   require_once("protected/components/Cinvite.php");
} elseif ($url[0] == "user" && json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $url[1]))->status == 200) {
   require_once("assets/header.php");
   require_once("protected/components/getUser.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "channel" && json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $url[3] . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])))->status == 200 && $url[4] == "raw") {
   require_once("protected/components/rawChat.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "settings" && $url[3] == "general") {
   require_once("assets/header.php");
   require_once("protected/pages/settings/main.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "settings" && $url[3] == "canali") {
   require_once("assets/header.php");
   require_once("protected/pages/settings/channels.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "settings" && $url[3] == "membri") {
   require_once("assets/header.php");
   require_once("protected/pages/settings/members.php");
} elseif ($url[0] == "server" && json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'))->status == 200 && $url[2] == "settings" && $url[3] == "deleteChannel" && json_decode(http('http://api.chatgo.tk/v3/server/' . $url[1] . '/' . $url[4] . '/info', array('UserID' => $_SESSION["UserID"], 'token' => $_SESSION["token"])))->status == 200) {
   require_once("protected/components/deleteChannel.php");
} elseif ($url[0] == "settings" && empty($url[1])) {
   require_once("assets/header.php");
   require_once("protected/pages/personal_settings/main.php");
} elseif ($url[0] == "settings" && $url[1] == "info") {
   require_once("assets/header.php");
   require_once("protected/pages/personal_settings/info.php");
} elseif ($url[0] == "settings" && $url[1] == "server") {
   require_once("assets/header.php");
   require_once("protected/pages/personal_settings/server.php");
} elseif ($url[0] == "settings" && $url[1] == "email") {
   require_once("assets/header.php");
   require_once("protected/pages/personal_settings/email.php");
} else { 
   die("LOL_ERROR");
}
   
