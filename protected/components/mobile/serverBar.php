  <button class='w3-button w3-right w3-display-topright w3-text-white' onclick='open_members()' style='display: block' id='show_members_tab_button'><span style='color: white'><i class="fa-solid fa-user-group"></i></span></button>
  <div class="w3-sidebar w3-bar-block w3-top w3-text-white" style="display:none; width:50%;right:0; background-color: #3A3A3A" id ='members_tab'>
   <button class='w3-bar-item w3-button' onclick='close_members()'><i class="fa-solid fa-xmark"></i></button>
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
  <script>
  function close_members() {
     document.getElementById("members_tab").style.display = "none";
     document.getElementById("show_members_tab_button").style.display = "block";
  }

  function open_members() {
     document.getElementById("members_tab").style.width = "50%";
     document.getElementById("members_tab").style.display = "block";
     document.getElementById("show_members_tab_button").style.display = "none";
  }
  </script>