<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['nom'])) {
    if(isset($_POST['submit'])) {
        $nom_partie = $_POST['nom_partie'];
        header("Location: game.php?partie=".$nom_partie);
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

$parties = array_map('str_getcsv', file('parties.csv'));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Join Party</title>
</head>
<body>
	<h1>Join Party</h1>
	<form method="POST">
		<label for="nom_partie">Choisissez une partie :</label>
		<select name="nom_partie" id="nom_partie">
			<?php foreach($parties as $partie) {
				echo "<option value=\"".$partie[0]."\">".$partie[0]." (".$partie[1].")</option>";
			} ?>
		</select><br>
		<input type="submit" name="submit" value="Rejoindre">
	</form>
	<form action="index.php">
	  <button type="submit">
