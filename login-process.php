<?php

session_start();
require_once 'Login.php';

$login = new Login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $login->authenticate($username, $password);

        if ($user) {
            header("Location: home.php");
            exit();
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Incorrect CAPTCHA!";
    }
}

?>