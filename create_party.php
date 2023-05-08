<?php
session_start();
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['email'])) {
    
        $nom_partie = $_POST['salon'];

        if(!file_exists('parties.csv')) {
            $file = fopen('parties.csv', 'w');
            fputcsv($file, array('Nom partie', 'Créateur partie', 'Participant'));
        } else {

            $file = fopen('parties.csv', 'a');
            $getParty = array_map('str_getcsv', file('parties.csv'));
            foreach($getParty as $party) {
                if($nom_partie == $party[0]) {
                    session_start();
                    $_SESSION['errorSalon'] = "Ce nom de salon existe déjà";
                    header("Location: index.php");
                    exit();
                }
            /* foreach ($salonIndex as $data) {
                    $data = str_getcsv($data);
                    $salon = $data[$salonIndex];
                        // Vérifie si le nom de salon n'existe pas déjà
                    if (!in_array($salon, $existingSalons)) {
                            $existingSalons[] = $salon;
                        }
                    } */
        }
    }

        $users = array_map('str_getcsv', file('users.csv')); 
        foreach($users as $user) {
            if($user[1] == $_SESSION['email']) {
                $pseudo = $user[0];
        
            }
        } 

        $data = array($nom_partie, $pseudo);
        fputcsv($file, $data);
        fclose($file);

        



        header("Location: salon.php?partie=" . urlencode($nom_partie));
        exit();
    
} else {
    header("Location: index.php");
    exit();
} 
?>