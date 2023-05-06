<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: connexion.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Le petit Bac | Salon d'attente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

<div id="main">
<h1>Bienvenue sur le jeu du petit bac, 
  <?php $users = array_map('str_getcsv', file('users.csv')); 
  foreach($users as $user) {
    if($user[1] == $_SESSION['email']) {
        $pseudo = $user[0];
        echo "$pseudo";
        break;
    }
} ?> ! </h1>

<form action="logout.php" method="POST">
    <input type="submit" name="logout" value="Log out" formnovalidate>

</div>

<div id='creerPartie'>
<form action="create_party.php" method="POST">
<input type="text" name="salon" placeholder="Nom de la partie" class="input" autocomplete="off" required><br>
  <button type="submit">Créer une partie</button>
</form>
</div>

<div id='rejoindrePartie'>
<form action="join_party.php" method="POST">
  <button type="submit">Rejoindre une partie</button>
</form>
</div>

</body>
</html>
