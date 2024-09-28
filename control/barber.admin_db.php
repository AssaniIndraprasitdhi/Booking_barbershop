<?php
session_start();
require_once("../config/db.php");

if (isset($_POST["add"])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if (strlen(($id)) == 3) {
        if (!isset($_SESSION['error'])) {
            $query = $conn->prepare("INSERT INTO barber (b_id, b_firstname, b_lastname,b_name, b_phone) VALUES (:id,:firstname, :lastname, :name, :phone)");
            $query->bindParam(":id", $id);
            $query->bindParam(":firstname", $firstname);
            $query->bindParam(":lastname", $lastname);
            $query->bindParam(":name", $name);
            $query->bindParam(":phone", $phone);
            $query->execute();

            $_SESSION['success'] = "Add data successfully";
            header('location:../admin/admin.barber.php');
        }
    } else {
        $_SESSION['error'] = 'Barber ID must equal 3';
        header('location:../admin/admin.barber.php');
    }
}

if (isset($_GET['b_id'])) {
    $id = $_GET['b_id'];
    $stmt = $conn->prepare('DELETE FROM barber WHERE b_id=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $_SESSION['success'] = 'Delete data successfully';
    header('location:../admin/admin.barber.php');
}
