<?php

$count = $_POST['count'];
$party_name = $_POST['party_name'];

if ($count < 1) {
    header("Location: salon.php?partie=$party_name");
    session_start();
    $_SESSION['errorParticipant'] = "Il faut au minimum 1 participant";
} else {
    $random_letter = chr(rand(65, 90));
    
    header("Location: game.php?partie=$party_name");
}

?>