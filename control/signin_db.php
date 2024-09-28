<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill out the information completely';
        header('location:../signin.php');
    } else {
        $check_data = $conn->prepare("SELECT * FROM account WHERE email = :email");
        $check_data->bindParam(":email", $email);
        $check_data->execute();
        $row = $check_data->fetch(PDO::FETCH_ASSOC);

        if ($check_data->rowCount() > 0) {
            if ($row["email"] == $email) {
                if (password_verify($password, $row["password"])) {
                    if ($row["role"] == 'admin') {
                        $_SESSION['admin_login'] = $row['id'];
                        header('location:../admin/admin.php');
                    } else {
                        $_SESSION['member_login'] = $row['id'];
                        header('location:../homepage.after.php');
                    }
                } else {
                    $_SESSION['error'] = 'The password is incorrect';
                    header('location:../views/signin.php');
                }
            } else {
                $_SESSION['error'] = 'This email address does not exist in the system';
                header('location:../views/signin.php');
            }
        } else {
            $_SESSION['error'] = 'There is no information in the system';
            header('location:../views/signin.php');
        }
    }
}
?>