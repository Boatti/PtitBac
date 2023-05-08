<!DOCTYPE html>
<html>
<head>
	<title>Le petit Bac | Salon</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

<div>
    <h3>La lettre est </h3>
    <div>Animal : <input class='inputMot' type="text"></div>
    <div>Ville : <input class='inputMot' type="text"></div>
    <div>Jeux vidéo : <input class='inputMot' type="text"></div>
    <div>Manga : <input class='inputMot' type="text"></div>
    <div>Personnage fictif : <input class='inputMot' type="text"></div>
    <div>Personnalité connus : <input class='inputMot' type="text"></div>
    <div>Objet : <input class='inputMot' type="text"></div>
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



