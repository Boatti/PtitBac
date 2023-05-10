<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: connexion.php");
    exit();
}


$party_name = $_POST['party_name'];

$file = fopen('parties.csv', 'r+');

$newLines = array();

while (($data = fgetcsv($file, 0, ',')) !== false) {
    if ($data[0] == $party_name or $data[0] == $_SESSION['salon']) {
        continue;
    }
    $newLines[] = $data;
}
rewind($file);
ftruncate($file, 0);

foreach ($newLines as $line) {
    fputcsv($file, $line);
}

fclose($file);


unset($_SESSION['salon']);
header("Location: index.php");

?>