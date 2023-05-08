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
	<link rel="stylesheet" type="text/css" href="connexion.css">
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
<form id="formFinis" action='finis.php' method='POST'>
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
  // Récupération de l'élément HTML qui affichera le timer
  const timerElement = document.getElementById("timer");

  // Définition de la durée du timer (en secondes)
  const duration = 60;

  // Définition de la fonction qui mettra à jour l'affichage du timer
  function updateTimer() {
    // Calcul du temps restant en secondes
    const remainingTime = Math.max(duration - Math.floor((new Date().getTime() - startTime) / 1000), 0);

    // Conversion du temps restant en format mm:ss
    const minutes = Math.floor(remainingTime / 60).toString().padStart(2, "0");
    const seconds = (remainingTime % 60).toString().padStart(2, "0");

    // Mise à jour de l'affichage du timer
    timerElement.innerText = `${minutes}:${seconds}`;

    // Si le temps est écoulé, arrêter le timer
    if (remainingTime <= 0) {
      clearInterval(timerInterval);
      setTimeout(function() {
        document.getElementById("formFinis").submit();
      }, 1000);

    }
  }

  // Définition de la date de début du timer
  const startTime = new Date().getTime();

  // Mise à jour initiale de l'affichage du timer
  updateTimer();

  // Lancement du timer
  const timerInterval = setInterval(updateTimer, 1000);
</script>

</body>
</html>



