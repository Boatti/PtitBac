<?php
// Récupération du nom de la partie à supprimer


session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}
$party_name = $_POST['party_name'];


// Ouverture du fichier en lecture et écriture
$file = fopen('parties.csv', 'r+');

// Tableau pour stocker les nouvelles lignes du fichier CSV
$newLines = array();

// Parcours du fichier CSV
while (($data = fgetcsv($file, 0, ',')) !== false) {
    // Vérification si la première colonne contient le nom de la partie à supprimer
    if ($data[0] == $party_name) {
        // Ne pas ajouter la ligne correspondante au tableau des nouvelles lignes
        continue;
    }
    
    // Ajout de la ligne au tableau des nouvelles lignes
    $newLines[] = $data;
}

// Retour au début du fichier et suppression de son contenu
rewind($file);
ftruncate($file, 0);

// Écriture des nouvelles lignes dans le fichier CSV
foreach ($newLines as $line) {
    fputcsv($file, $line);
}

// Fermeture du fichier
fclose($file);



header("Location: index.php");

?>