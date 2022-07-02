<?php
$to = 'fede.cosma.ge@gmail.com';
$subject = "Verifica dell'Account";
$from = 'noreply.mystudents@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html>';
$message .= '<body style="background-color: #D8D8D8; color: black;">';
$message .= '<span style="color: #FFD100"><h1>MyStudents</h1></span>';
$message .= '<br>';
$message .= '<h4>Benvenuto ' .$nome. ' nella pattaforma MyStudents!<br>Per iniziare ad usare al meglio il tutto &egrave; necessario prima verificare la propria email</h4>';
$message .= "<h4>Per verificare l'account registrato con l'username " .$taga. " immetti nella schermata di verifica il seguente Codice</h4>";
$message .= '</body>';
$message .= '<div style="background-color: #ABCDEF"><br>';
$message .= '<h3>' .$codice. '</h3>';
$message .= '<br></div>';
$message .= '<h5>Se non sei stato te a registrarti su <a href="http://mystudents.ml/">MyStudents</a> ingora questa email';
$message .= '</html>';
 
// Sending email
if (mail($to, $subject, $message, $headers)) {
    echo '';
} else {
    echo '<center><h2 style="color: red">Email impossibile da inviare! Contattaci!</h2></center>';
}
