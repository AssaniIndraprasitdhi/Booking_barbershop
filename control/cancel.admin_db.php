<?php
session_start();
require_once("../config/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('DELETE FROM booking WHERE id=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $_SESSION['success'] = 'Cancel successfully';
    header('location:../admin/admin.php');
}

?>
