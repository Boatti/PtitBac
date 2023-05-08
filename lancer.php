<?php

session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}

$count = $_POST['count'];
$party_name = $_POST['party_name'];

if ($count < 1) {
    $_SESSION['errorParticipant'] = "Il faut au minimum 1 participant";
    header("Location: salon.php?partie=$party_name");
    exit();
} else {
    $file = 'parties.csv'; 
$letter = chr(rand(65, 90));
$rows = array_map('str_getcsv', file($file)); 
foreach ($rows as &$row) {
    if ($row[0] == $party_name) {
        $row[3] = $letter;
        $row[4] = true;

    }
}
unset($row); 
$fp = fopen($file, 'w'); 
foreach ($rows as $row) {
    fputcsv($fp, $row); 
}
fclose($fp);

    header("Location: game.php?partie=$party_name");
}

?>