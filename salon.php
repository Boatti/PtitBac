<?php

session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}

if (!(isset($_SESSION['salon']))) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Le petit Bac | Salon</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>
    <div>
	<h1>Nom du salon :

<?php 
$nom_partie = $_GET['partie'];
$file = fopen('parties.csv', 'a');
$getParty = array_map('str_getcsv', file('parties.csv'));
foreach($getParty as $party) {
    if($nom_partie == $party[0]) {
        echo $nom_partie;
    }}
    fclose($file);
?>
</h1>
</div>

    <div id='host'>Host du salon : 

<?php 
$nom_partie = $_GET['partie'];
$file = fopen('parties.csv', 'a');
$getParty = array_map('str_getcsv', file('parties.csv'));
foreach($getParty as $party) {
    if($nom_partie == $party[0]) {
        echo $party[1];
        
    }}

    fclose($file);
?></div>
	
	<div id='joueur'>
        Participants : <br>
        <?php
        $file = fopen('parties.csv', 'r');
// Ignorer la première ligne qui contient les en-têtes de colonnes
fgetcsv($file);

while (($data = fgetcsv($file, 0, ',')) !== false) {
    if($data[0] == $nom_partie) {
    // Accéder à la troisième colonne qui contient les noms des participants
    if (!empty($data[2])) {

        $participants = explode(',', $data[2]);
        foreach ($participants as $participant) {
            echo "<span class='spanParticipant'>$participant</span><br>";
        }
        break;
    }
}}


fclose($file);
?>

	</div>


    <?php
    $nom_partie = $_GET['partie'];
    $filename = 'parties.csv';
    $handle = fopen($filename, 'r');
    if ($handle) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if (strpos($data[0], $nom_partie) !== false) {
                if ($data[1] == $_SESSION['pseudo'] and ($data[0] == $nom_partie))  {

                    $file = fopen('parties.csv', 'r');
                    $isFirstLine = true;

                    while (($data = fgetcsv($file, 0, ',')) !== false) {
                        if ($isFirstLine) {
                            $isFirstLine = false;
                            continue;
                        }
                        
                        if ($data[0] == $nom_partie and $data[1] == $_SESSION['pseudo']) {
                            if (!empty($data[2])) {
                            $participants = explode(',', $data[2]);
                            $count = count($participants);
                            echo "Le nombre de participants est de : $count";
                            echo "<form action='lancer.php' method='POST'>
                                <input type='hidden' name='count' value='$count'>
                                <input type='hidden' name='party_name' value='$nom_partie'>
                                <button id='lancerPartie' type='submit'>Lancer la partie</button>
                                </form>";
                            } else {
                                echo "<form action='lancer.php' method='POST'>
                                <input type='hidden' name='party_name' value='$nom_partie'>
                            <button id='lancerPartie' type='submit'>Lancer la partie</button>
                            </form>";
                            }
                        }
                    }

                    fclose($file);

                    

                    echo "<form action='delete.php' method='POST'>
                            <input type='hidden' name='party_name' value='$nom_partie'>
                            <button id='deleteGame' type='submit'>Supprimer le salon</button>
                            </form>";
                }
            }
        }
        fclose($handle);
    }
    
    ?>

    <?php
	if(isset($_SESSION['errorParticipant'])) {
		echo '<div class="error">'.$_SESSION['errorParticipant'].'</div>';
		unset($_SESSION['errorParticipant']);
	}
    ?>

<!-- <script>

// Récupérer le bouton de démarrage de la partie
const startButton = document.getElementById('startGame');

// Ajouter un écouteur d'événements pour le clic sur le bouton de démarrage
startButton.addEventListener('click', () => {
  // Envoyer une requête AJAX à un script PHP sur le serveur pour démarrer la partie
  fetch('/gameE.php', {
    method: 'POST',
    body: JSON.stringify({ game_id: 1234 }),
  })
  .then(response => {
    if (response.ok) {
      // Rediriger les utilisateurs vers la page de jeu
      window.location.href = '/jeu.php';
    } else {
      console.error('Impossible de démarrer la partie.');
    }
  })
  .catch(error => {
    console.error(error);
  });
});

</script> -->


</body>
</html>
