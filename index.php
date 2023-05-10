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
	<title>Le petit Bac</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">

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
    <input type="submit" name="logout" class="button" value="Log out">
</form>

</div>

<div id='creerPartie'>
<form id="formCreate" class="formConx" method="POST" action="create_party.php">
  <input type="text" name="salon" placeholder="Nom de la partie" class="input" autocomplete="off" required><br>
  <button type="submit"  class='button'>Créer partie</button>
</form>
</div>

<?php
	if(isset($_SESSION['errorSalon'])) {
		echo '<div class="error">'.$_SESSION['errorSalon'].'</div>';
		unset($_SESSION['errorSalon']);
	}
?>




<div id='divSalon'>
<div>- Rejoindre une partie -</div>
 <?php
  if(file_exists('parties.csv')) {
	$file = fopen('parties.csv', 'a');
  $getParty = array_map('str_getcsv', file('parties.csv'));
  $getParty = array_slice($getParty, 1);
  foreach($getParty as $party) {
      
          echo "<div><form action='join.php' method='POST'>
          <input type='hidden' name='party_name' value='$party[0]'>
          <button class='salon' type='submit' name='party_name' value='$party[0]'>Rejoindre le salon : $party[0]</button>
        </form></div>";
      }
    }
?>
</div>


</body>
</html>
