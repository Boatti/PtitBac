<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['email'])) {
    header("Location: index.php");
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
	<h1>Le petit bac de Clement et Lauris</h1>
	
	<div id='register'>
		<form method="POST" action="register.php">
			<h2>Inscription</h2>
			<label for="pseudo">Pseudo :</label><br>
			<input type="text" name="pseudo" class="input" autocomplete="off" required><br>

			<label for="email">E-mail :</label><br>
			<input type="email" name="email" class="input" autocomplete="off" required><br>

			<label for="motdepasse">Mot de passe :</label><br>
			<input type="password" name="motdepasse" class="input" required><br>

			<label for="confmotdepasse">Confirmer le mot de passe :</label><br>
			<input type="password" name="confmotdepasse" class="input" required><br><br>

			<input type="submit" name="submit" class="button" value="S'inscrire">
		</form>
	</div>

	<?php
	if(isset($_SESSION['errorRegister'])) {
		echo '<div class="error">'.$_SESSION['errorRegister'].'</div>';
		unset($_SESSION['errorRegister']);
	}
	?>

	<div id="login">
		<form method="POST" action="login.php">
			<h2>Connexion</h2>
			<label for="email">E-mail :</label><br>
			<input type="email" name="email" class="input" autocomplete="off" required><br>

			<label for="motdepasse">Mot de passe :</label><br>
			<input type="password" name="motdepasse" class='input' required><br><br>

			<input type="submit" name="submit" class="button" value="Se connecter">
		</form>
	</div>
	
	<?php
	if(isset($_SESSION['error'])) {
		echo '<div class="error">'.$_SESSION['error'].'</div>';
		unset($_SESSION['error']);
	}
	?>
	

	<div id="rules">
		<h2>Règles</h2>
		<p>Les règles du petit bac sont les suivantes :</p>
		<p>- Une lettre va apparaitre aléatoirement</p>
		<p>- Il faut remplir les champs en commençant par la lettre demandée</p>
		<p>- Le créateur du salon pourra ensuite décider si les réponses sont justes ou fausses</p>
		<p>- Le but est d'avoir le maximum de mots</p>
	</div>
</body>
</html>
