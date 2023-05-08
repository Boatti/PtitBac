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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Inclure jQuery-CSV -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.11/jquery.csv.min.js"></script>
	<!-- Votre code Javascript -->
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

    if (damnPartie && damnPartie['Started'] === '1') {
        window.location.href =  'game.php?partie='+partyName;
    } else {
      console.log("La partie 'Damn' n'a pas encore commencé.");
    }
  });
});
    }
}, 1000);

</script> 

</body>
</html>
