<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['submit'])) {
    $new_firstname = $_POST['new_firstname'];
    $new_lastname = $_POST['new_lastname'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];
    $img = $_POST['image'];

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Syntax not correct!';
        header('location:../profile.php');
    } else {
        $check_email = $conn->prepare("SELECT email FROM account WHERE email = :email");
        $check_email->bindParam(":email", $new_email);
        $check_email->execute();
        $row = $check_email->fetch(PDO::FETCH_ASSOC);
        if ($row['email'] == $new_email) {
            $_SESSION["error"] = "This email is already in the system!!";
            header('location:../profile-edit.php');
        } else if (isset($_SESSION['member_login'])) {
            $id = $_SESSION['member_login'];
            $query = $conn->query("SELECT * FROM account WHERE id = $id");
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (!isset($_SESSION['error'])) {
                $query = $conn->prepare("UPDATE account SET firstname = :new_firstname, lastname = :new_lastname, email = :new_email, phone = :new_phone, img = :img WHERE id = :id;");
                $query->bindParam(":new_firstname", $new_firstname);
                $query->bindParam(":new_lastname", $new_lastname);
                $query->bindParam(":new_email", $new_email);
                $query->bindParam(":new_phone", $new_phone);
                $query->bindParam("img", $img);
                $query->bindParam(":id", $id);
                $query->execute();

                $_SESSION['success'] = "Update data successfully";
                header('location:../profile-edit.php');
            }
        } else {
            $_SESSION['error'] = 'Something went wrong!';
            header('location:../profile-edit.php');
        }
    }
}
