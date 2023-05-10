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
	<title>Le petit Bac | Classement</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>
    <h3>Le classement est le suivant :</h3>
<?php
    
$tableau = file('games.csv');

$points = array();
$place = 1;
foreach ($tableau as $ligne) {
    $donnees = str_getcsv($ligne);
    if ($donnees[0] == $_SESSION['salon']) {
    $nom = $donnees[1];
    $pts = $donnees[3];
    
    $points[$nom] = $pts;
    }
}
arsort($points);
$i=1;
foreach ($points as $nom => $pts) {
    
    echo '<h4>', $i, ' - ', $nom, ' avec un total de ' ,$pts, ' points</h4><br>';
    $i++;
}

    ?>
</div>

<form action='delete.php' method='POST'>
   
    <button class='button' type='submit'>Retourner a la page d'accueil</button>
</form>

<script>
</script>

</body>
</html>