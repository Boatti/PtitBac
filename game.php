<?php
  session_start();
  if (!(isset($_SESSION['email']))) {
      header("Location: connexion.php");
      exit();
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Le petit Bac | Game</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.11/jquery.csv.min.js"></script>
</head>
<body>

<div>
    <h3>La lettre est <?php $file = 'parties.csv'; 
$rows = array_map('str_getcsv', file($file)); 
foreach ($rows as &$row) {
    if ($row[0] == $_SESSION['salon']) {
       echo $row[3];
    }
} ?></h3>
<form id="formFinis" action='savingWords.php' method='POST'>
    <div>Animal : <input name="animal" class='inputMot' type="text"></div>
    <div>Ville : <input name="ville" class='inputMot' type="text"></div>
    <div>Jeux-vidéo : <input name="jv" class='inputMot' type="text"></div>
    <div>Manga : <input name="manga" class='inputMot' type="text"></div>
    <div>Personnage fictif : <input name="fictif" class='inputMot' type="text"></div>
    <div>Personnalité connue : <input name="connus" class='inputMot' type="text"></div>
    <div>Objet : <input name="objet" class='inputMot' type="text"></div>
    <button class='button' type='submit'>Finis</button>
    </form>
</div>

<p id="timer">01:00</p> 
                         
                       

<script>
   

const fileExists = (filePath) => {
  try {
    const xhr = new XMLHttpRequest();
    xhr.open('HEAD', filePath, false);
    xhr.send();
    return xhr.status !== 404;
  } catch (error) {
    return false;
  }
}

setInterval(function() {
    console.log('oui');
    if (fileExists('parties.csv')) {
        
$.getScript("https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var partyName = urlParams.get('partie');

  $.get("parties.csv", function(csv) {
 
    var parties = $.csv.toObjects(csv);
    console.log('non');

    var damnPartie = parties.find(function(partie) {
        
      return partie['Nom partie'] === partyName;
    });

    if (damnPartie && damnPartie['isOver'] == '1') {
      document.getElementById("formFinis").submit();
    } 
  });
});
    }
}, 500);

  const timerElement = document.getElementById("timer");

  const duration = 60;

  function updateTimer() {
    const remainingTime = Math.max(duration - Math.floor((new Date().getTime() - startTime) / 1000), 0);

    const minutes = Math.floor(remainingTime / 60).toString().padStart(2, "0");
    const seconds = (remainingTime % 60).toString().padStart(2, "0");
    timerElement.innerText = `${minutes}:${seconds}`;

    if (remainingTime <= 0) {
      clearInterval(timerInterval);
      setTimeout(function() {
        document.getElementById("formFinis").submit();
      }, 1000);

    }
  }
  const startTime = new Date().getTime();

  updateTimer();
  const timerInterval = setInterval(updateTimer, 1000);
</script>

</body>
</html>



