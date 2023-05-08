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
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

<div>
    <h3>Le classement est le suivant :</h3>
<?php
     $file = 'reponses.csv';
     $rows = array_map('str_getcsv', file($file)); 
     foreach ($rows as &$row) {
         if ($row[0] == $_SESSION['salon']) {
            echo $row[3];
         }
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