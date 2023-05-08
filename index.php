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
    <input type="submit" name="logout" value="Log out">
</form>

</div>

<div id='creerPartie'>
<form id="formCreate" method="POST" action="create_party.php">
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


  <div>Rejoindre une partie -</div>
  <div id='partyContainer'></div>

<!--   <script>
function sendPartie(event) {

  event.preventDefault();

    // Récupère la div "partyContainer"
    const partyContainer = document.getElementById('partyContainer');

    // Récupère le formulaire de création de partie
    const form = document.getElementById('formCreate');

    // Ajoute un écouteur d'événements sur le formulaire
    

      const nomPartie = event.target.elements.salon.value; // Récupère le nom de la partie

      // Crée une nouvelle div pour la partie
      const divPartie = document.createElement('div');
      divPartie.id = nomPartie
      divPartie.textContent = nomPartie;

      // Ajoute la nouvelle div à la div "partyContainer"
      partyContainer.appendChild(divPartie);
    
      //event.target.submit();
  

  }
  </script>
 -->

 <?php
  if(file_exists('parties.csv')) {
	$file = fopen('parties.csv', 'a');
  $getParty = array_map('str_getcsv', file('parties.csv'));
  $getParty = array_slice($getParty, 1);
  foreach($getParty as $party) {
      
          echo "<form action='join.php' method='POST'>
          <input type='hidden' name='party_name' value='$party[0]'>
          <button class='salon' type='submit' name='party_name' value='$party[0]'>Rejoindre le salon : $party[0]</button>
        </form>";
      }
    }
?>



</body>
</html>
