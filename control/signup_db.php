<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    $role = 'member';
    $img = 'profile.png';


    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($conf_password)) {
        $_SESSION['error'] = 'Please fill out the information completely';
        header('location:../views/signup.php');
    } else if ($password != $conf_password) {
        $_SESSION['error'] = "Passwords don't match";
        header('location:../views/signup.php');
    } else if (strlen($password) < 8) {
        $_SESSION['error'] = 'Password should have at least 8 characters';
        header('location:../views/signup.php');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'This email is already in the system';
        header('location:../views/signup.php');
    } else {
        $check_email = $conn->prepare("SELECT email FROM account WHERE email = :email");
        $check_email->bindParam(":email", $email);
        $check_email->execute();
        $row = $check_email->fetch(PDO::FETCH_ASSOC);

        if ($row['email'] == $email) {
            $_SESSION["warning"] = "This email is already in the system <a href='../views/signin.php'>Click here</a> for sign in";
            header('location:../views/signup.php');
        } else if (!isset($_SESSION['error'])) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = $conn->prepare("INSERT INTO account (firstname, lastname, email, phone, password, role, img) VALUES (:firstname, :lastname, :email, :phone, :password, :role, :img)");
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':email', $email);
            $query->bindParam(':phone', $phone);
            $query->bindParam(':password', $passwordHash);
            $query->bindParam(':role', $role);
            $query->bindParam(':img', $img);
            $query->execute();

            $_SESSION['success'] = "Successfully applied for an account <a href='../views/signin.php'>Cilck here</a> for sign in";
            header('location:../views/signup.php');
        } else {
            $_SESSION['error'] = 'Something went wrong!';
            header('location:../views/signup.php');
        }
    }
}
