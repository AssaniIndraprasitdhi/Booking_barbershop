<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['cancel']) && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    // Prepare and execute the SQL query to delete the booking
    $query = $conn->prepare("DELETE FROM booking WHERE id = :booking_id");
    $query->bindParam(":booking_id", $booking_id);
    $query->execute();

    $_SESSION['success'] = "Booking cancelled successfully.";
    header("Location: ../booking_detail.php");
    exit;
} else {
    // Redirect if cancel button or booking ID is not set
    header("Location: ../booking_detail.php");
    exit;
}
?>
