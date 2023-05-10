<?php
session_start();
$file = fopen('parties.csv', 'a');
        $rows = array_map('str_getcsv', file('parties.csv'));
        foreach($rows as $row) {
            if ($row[0]== $_SESSION['salon']) {
            if(!$row[6]) {
                session_start();
                $_SESSION['notCorrectedYet'] = "La correction n'est pas terminée";
                header("Location: attenteCorrection.php");
                exit();
            }
            else {
                header("Location: classement.php");
                exit();
            }
        }
        } echo 'La partie n\'existe pas ou a été supprimé';

?>

