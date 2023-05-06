<?php
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['motdepasse'];

    $users = array_map('str_getcsv', file('users.csv'));
    foreach($users as $user) {
        if($email == $user[1] && $password == $user[2]) {
            session_start();
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        }
    }
    session_start();
    $_SESSION['error'] = "L'email ou le mot de passe est incorrect";
    header("Location: index.php");
    exit();
}
?>

