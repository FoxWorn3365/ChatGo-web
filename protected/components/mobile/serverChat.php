
  <!-- Parte purtroppo in JS per evitare un header ogni secondo lol -->
  <script type="text/javascript">
        function Ajax()
        {
            var
                $http,
                $self = arguments.callee;

            if (window.XMLHttpRequest) {
                $http = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                try {
                    $http = new ActiveXObject('Msxml2.XMLHTTP');
                } catch(e) {
                    $http = new ActiveXObject('Microsoft.XMLHTTP');
                }
            }

            if ($http) {
                $http.onreadystatechange = function()
                {
                    if (/4|^complete$/.test($http.readyState)) {
                        document.getElementById('ReloadThis').innerHTML = $http.responseText;
                        <?php if ($args == "down") { ?> window.location.replace("#bottom"); <?php } ?>
                        setTimeout(function(){$self();}, 1000);
                    }
                };
                $http.open('GET', 'https://chatgo.tk/getChat.php?user=<?= $_SESSION["UserID"]; ?>&server=<?= $url[1]; ?>&channel=<?= $url[3]; ?>', true);
                $http.send(null);
            }
        }
  </script>
  <script type="text/javascript">
      setTimeout(function() {Ajax();}, 1000);
  </script>
  <!-- Finalmente parte JS conclusa. 'Sto coso recupera le cose giuste :D -->
  <br><br>
  <div style='display: none; float: left' id='chatLoaded'></div>
  <div class='w3-container w3-display-topmiddle' style='max-width: 50%;'>
   <br><br>
   <div id="ReloadThis">Caricamento della chat in corso...</div>
   <br><br><br><br><br><br><a id='bottom'><br><br><br></a>
  </div>
