<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $namePlayers = $_POST['namePlayer'];
  $nb_animaux = isset($_POST['animal']) ? $_POST['animal'] : array();
  $nb_villes = isset($_POST['ville']) ? $_POST['ville'] : array();
  $nb_jv = isset($_POST['jv']) ? $_POST['jv'] : array();
  $nb_mangas = isset($_POST['manga']) ? $_POST['manga'] : array();
  $nb_persos_fictifs = isset($_POST['persofictif']) ? $_POST['persofictif'] : array();
  $nb_persos_connus = isset($_POST['persoconnue']) ? $_POST['persoconnue'] : array();
  $nb_objets = isset($_POST['objet']) ? $_POST['objet'] : array();

$file = 'games.csv'; 
$rows = array_map('str_getcsv', file($file)); 

  foreach ($namePlayers as $namePlayer) {
    $count = 0;

    if (isset($nb_animaux[$namePlayer])) {
      $count += 1;
    }

    if (isset($nb_villes[$namePlayer])) {
      $count += 1;
    }

    if (isset($nb_jv[$namePlayer])) {
      $count += 1;
    }
    if (isset($nb_objets[$namePlayer])) {
        $count += 1;
      }
      if (isset($nb_mangas[$namePlayer])) {
        $count += 1;
      }
      if (isset($nb_persos_fictifs[$namePlayer])) {
        $count += 1;
      }
      if (isset($nb_persos_connus[$namePlayer])) {
        $count += 1;
      }

      foreach ($rows as &$row) {
          if ($row[0] == $_SESSION['salon'] and $namePlayer == $row[1]) {
              $row[3] = $count;
          }
      }unset($row); 
     
    
  }
}

$fp = fopen($file, 'w'); 
foreach ($rows as $row) {
    fputcsv($fp, $row); 
}
fclose($fp);


$file2 = 'parties.csv'; 
$rows2 = array_map('str_getcsv', file($file2)); 
foreach ($rows2 as &$row2) {
    if ($row2[0] == $_SESSION['salon']) {
        $row2[6] = true;
    }
}
unset($row2); 
$fp2 = fopen($file2, 'w'); 
foreach ($rows2 as $row2) {
    fputcsv($fp2, $row2); 
}
fclose($fp2); 
header("Location: classement.php");

?>

