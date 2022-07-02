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

$px = filter_var($_GET["px"], FILTER_SANITIZE_NUMBER_INT);

if (empty($px)) {
  die("INVALID INPUT");
}

// Ok, salvo la preferenza
$cookie_name = "textSize";
$cookie_value = $px;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

echo 'FATTO!';