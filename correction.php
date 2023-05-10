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
	<title>Le petit Bac | Correction</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>

<?php
    $file = 'parties.csv'; 
    $rows = array_map('str_getcsv', file($file)); 
    foreach ($rows as $row) {
        if ($row[0] == $_SESSION['salon']) {
            $lettre = $row[3];
            break;
        }
    } 
    echo '<h3>Correction du salon <span class=\'hostBold\'>' .$_SESSION['salon']. 
    '</span> avec la lettre <span class=\'hostBold\'>' . $lettre . '</span></h3>';
?>
<div class="error">Actualisez pour bien afficher les corrections de tous les joueurs</div>

<h3 class="cochez">Cochez si le mot est validé</h3>

<form id="formFinis" action='suivant.php' method='POST'>
    <?php
        $file = 'games.csv'; 
        $rows = array_map('str_getcsv', file($file)); 
        foreach ($rows as $row) {
            if ($row[0] == $_SESSION['salon']) {
                $mots = explode(',', $row[2]);

                echo '<div class=\'correc\'>
                        <div class=\'hostBold\'>Le joueur : ' .$row[1] . '</div>
                        <input type=\'hidden\' name=\'namePlayer[]\' value='.$row[1].'>
                        <div>Animal : ' .$mots[0] . '<input type="checkbox" name="animal['.$row[1].']"></div>
                        <div>Ville : ' .$mots[1] . '<input type="checkbox" name="ville['.$row[1].']"></div>
                        <div>Jeux-vidéo : ' .$mots[2] . '<input type="checkbox" name="jv['.$row[1].']"></div>
                        <div>Manga : ' .$mots[3] . '<input type="checkbox" name="manga['.$row[1].']"></div>
                        <div>Personnage fictif : ' .$mots[4] . '<input type="checkbox" name="persofictif['.$row[1].']"></div>
                        <div>Personnalité connue : ' .$mots[5] . '<input type="checkbox" name="persoconnue['.$row[1].']"></div>
                        <div>Objet : ' .$mots[6] . '<input type="checkbox" name="objet['.$row[1].']"></div>
                    </div>';
            }
        }
    ?>
    </div>
    <div id='divClassement'><button class='button' type='submit'>Voir le classement</button></div>
</form>


</body>
</html>



