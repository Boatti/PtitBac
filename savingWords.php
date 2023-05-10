<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(!file_exists('games.csv')) {
    $file = fopen('games.csv', 'w');
    fputcsv($file, array('Nom partie', 'Joueur', 'Mots', 'Points'));
} else {
    $file = fopen('games.csv', 'a');
}

$partie = $_SESSION['salon'];
$pseudo = $_SESSION['pseudo'];

 
        $animal = $_POST['animal'];
        $ville = $_POST['ville'];
        $jv = $_POST['jv'];
        $manga = $_POST['manga'];
        $fictif = $_POST['fictif'];
        $connus = $_POST['connus'];
        $objet = $_POST['objet'];

  
        $data = array($partie, $pseudo,"$animal, $ville, $jv, $manga, $fictif, $connus, $objet");
        fputcsv($file, $data);
        fclose($file);
    }

    $file = 'parties.csv'; 
$rows = array_map('str_getcsv', file($file)); 
foreach ($rows as &$row) {
    if ($row[0] == $_SESSION['salon']) {
        $row[5] = true;
        if ($_SESSION['pseudo'] == $row[1]){
                header("Location: correction.php");
            } else {
                header("Location: attenteCorrection.php");
            }

    }
}
unset($row); 
$fp = fopen($file, 'w'); 
foreach ($rows as $row) {
    fputcsv($fp, $row); 
}
fclose($fp);


   
?>


