<?php require("assets/not_header.php"); ?>
  <br><br>
  <h1>Registrati su ChatGo!</h1>
  <br><br><br>
  <form method="POST" action="/newUser">
    Username:<br>
    <input type="text" name="username"><br>
    Email:<br>
    <input type="email" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <button class='w3-button w3-orange w3-text-white'>Registrati!</button>
  </form>
  <br>
  <a style='font-size: 15px' href='/app/login'><b>Hai già un account?</b></a>
  <br><br>
