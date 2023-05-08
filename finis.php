<?php


session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}

if(!file_exists('games.csv')) {
    $file = fopen('games.csv', 'w');
    fputcsv($file, array('Nom partie', 'Hote', 'Joueur', 'Mots', 'Points'));
} else {

    $file = fopen('games.csv', 'a');
    
}


$pseudo = $_SESSION['pseudo'];
$partie = $_SESSION['salon'];
 
    


$data = array($partie, $pseudo);
fputcsv($file, $data);
fclose($file);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Le petit Bac | Correction</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

<div>
    <h3>Correction de la lettre <?php $file = 'parties.csv'; 
$rows = array_map('str_getcsv', file($file)); 
foreach ($rows as &$row) {
    if ($row[0] == $_SESSION['salon']) {
       echo $row[3];
    }
} ?> du joueur </h3>
    <div>Animal : </div>
    <div>Ville : </div>
    <div>Jeux-vidéo : </div>
    <div>Manga : </div>
    <div>Personnage fictif : </div>
    <div>Personnalité connue : </div>
    <div>Objet : </div>
</div>

<form id="formFinis" action='suivant.php' method='POST'>
    <button class='button' type='submit'>Suivant</button>
</form>

<script>
</script>

</body>
</html>