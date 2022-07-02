<?php
$token = $_SESSION["token"];
$id = $_SESSION["UserID"];

$res = json_decode(http('http://api.chatgo.tk/v3/user/addServer/' . $id, array('token' => $token, 'server' => $url[1])));

header("Location: /app/server/$url[1]/");
