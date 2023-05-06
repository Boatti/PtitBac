<?php
if(isset($_POST['submit'])) {

    if ($_POST['motdepasse'] !== $_POST['confmotdepasse']) {
        session_start();
        $_SESSION['errorRegister'] = "Les mots de passe ne sont pas les mêmes";
        header("Location: connexion.php");
        exit();   
    }

    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    if(!file_exists('users.csv')) {
        $file = fopen('users.csv', 'w');
        fputcsv($file, array('Pseudo', 'E-mail', 'Mot de passe'));
    } else {
        $file = fopen('users.csv', 'a');
        $users = array_map('str_getcsv', file('users.csv'));
        foreach($users as $user) {
            if($email == $user[1]) {
                session_start();
                $_SESSION['errorRegister'] = "L'email est déjà utilisé";
                header("Location: connexion.php");
                exit();
            }
        }
    }

    session_start();
    $_SESSION['email'] = $email;

    try {
    $data = array($pseudo, $email, $motdepasse);
    fputcsv($file, $data);
    fclose($file);
    header("Location: index.php");
    } catch (Exception $e) {
        echo "Erreur lors de l'ajout dans la database : " . $e->getMessage();
    }
    exit();
}
?>
