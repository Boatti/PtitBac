<?php

session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}

// Récupérer le nom de la partie et le pseudo du nouveau participant
$party_name = $_POST['party_name'];
$session_pseudo = $_SESSION['pseudo'];

$file = fopen('parties.csv', 'r+');
$newLines = array();
$isFirstLine = true;

while (($data = fgetcsv($file, 0, ',')) !== false) {
    if ($isFirstLine) {
        $isFirstLine = false;
        $newLines[] = $data;
        continue;
    }

    if ($data[0] == $party_name) {
        $participants = $data[2] ? explode(',', $data[2]) : array();
        $participants[] = $session_pseudo;
        $data[2] = implode(',', $participants);
    }

    $newLines[] = $data;
}

rewind($file);
ftruncate($file, 0);

foreach ($newLines as $line) {
    fputcsv($file, $line);
}

fclose($file);




header("Location: salon.php?partie=$party_name");

?>