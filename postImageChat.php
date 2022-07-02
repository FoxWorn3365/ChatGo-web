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

$token = $_SESSION["token"];
$user = $_SESSION["UserID"];

if (empty($token)) {
  die("UNHAUTORIZED!");
}

$server = $_GET["server"];
$channel = $_GET["channel"];

if (empty($channel)) {
  die("EMPTY CHANNEL");
}

if (empty($server)) {
  die("EMPTY SERVER");
}


$target_dir = "cdn/images/";
$filename = rand(1000, 9999) . rand(1900, 9999) . '.' . end(explode(".", basename($_FILES["fileToUpload"]["name"])));
$target_file = $target_dir . $filename;
$uploadOk = 1;
$imageFileType = var_dump(explode(".", $_FILES["fileToUpload"]["name"]));

die($imageFileType);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 52428800) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Scusa, solo i file JPG, JPEG, PNG & GIF sono ammessi. La tua estensione: $imageFileType";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  die("ERRORE: Il tuo file non rispetta i requisiti fondamentali!");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $message = '[cdnimg]' . $filename . '[/cdnimg]';
    $res = json_decode(http('http://api.chatgo.tk/v3/server/' . $server . '/' . $channel . '/message', array('UserID' => $user, 'token' => $token, 'message' => $message)));
    header("Location: /app/server/$server/channel/$channel/#bottom");
  } else {
    die("ERRORE: Il caricamento del file non è riuscito!");
  }
}
?>