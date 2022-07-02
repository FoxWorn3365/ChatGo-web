  <br><br>
  <h2>Crea il tuo nuovo canale su ChatGo!</h2>
  <br><br><br>
  <form method="post" action="/new_channel">
   <input type="hidden" name="server" value="<?= $url[1]; ?>">
   <b>Nome del canale:</b><br>
   <input type="text" name="nome"><br>
   <b>Breve descrizione del canale:</b><br>
   <input type="text" name="descrizione" style='width: 300px'><br>
   <br>
   <b>Tutti possono scrivere in questa chat?</b> <i>(In caso contrario solo il creatore del server potrà)</i><br>
   <input type="checkbox" name="restricted" value="1">
   <br><br>
   <button class='w3-button w3-white w3-text-black'><b>Crea!</b></button>
  </form>