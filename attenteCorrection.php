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
	<title>Le petit Bac | Attente correction</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>
    <h3>Veuillez attendre que l'hôte corrige, quand il a finis, appuyez sur le bouton</h3>
</div>

<form action='isCorrectionOver.php' method='POST'>
    <button class='button' type='submit'>Accèder au classement</button>
</form>

<?php
	if(isset($_SESSION['notCorrectedYet'])) {
		echo '<div class="error">'.$_SESSION['notCorrectedYet'].'</div>';
		unset($_SESSION['notCorrectedYet']);
	}
	?>

<script>
</script>

</body>
</html>