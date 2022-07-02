<?php
if (stripos($_SERVER["HTTP_USER_AGENT"], "Mobile") !== false) {
   require_once("protected/components/mobile/serverBar.php");
} else {
?>
  <div class="w3-sidebar w3-bar-block w3-top w3-text-white" style="width:25%;right:0; background-color: #3A3A3A">
   <h5 class="w3-bar-item">Membri del server <span class='w3-right'><a onclick="spoiler_invite_member()"><i class="fa-solid fa-circle-plus"></i></a></span></h5>
<?php
$ow = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/info'));
$dd = json_decode(file_get_contents('http://api.chatgo.tk/v3/server/' . $url[1] . '/members'));
foreach ($dd->members as $de) {
  $in = json_decode(file_get_contents('http://api.chatgo.tk/v3/user/info/' . $de));
  if ($ow->info->author == $de) {
   $st = "&nbsp;&#11088;";
  } else {
   $st = "";
  }
?>
   <a href="/app/user/<?= $de; ?>/" class="w3-bar-item w3-button"><?= $in->info->username; ?>#<?= $in->info->discriminator; ?><?= $st; ?></a>
<?php
}
?>
  </div>
<?php
}
?>
