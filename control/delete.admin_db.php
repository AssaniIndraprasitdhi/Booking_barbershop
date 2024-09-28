<?php
   require_once '../config/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('DELETE FROM account WHERE id=:id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['success'] = 'Delete data successfully';
    header('location:../admin/admin.php');
} else {
    $_SESSION['error'] = 'Something went wrong!!';
    header('location:../admin/admin.php');
}
?>


