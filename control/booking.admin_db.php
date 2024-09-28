<?php
session_start();
require_once '../config/db.php';

// Handle form submission
if (isset($_POST['submit'])) {
    try {
        // Retrieve form data
        $barber_name = $_POST['barber']; // Get selected barber name
        $service = $_POST['service']; // Get selected service
        $date = $_POST['date'];
        $slottimes = isset($_POST['slottime']) ? $_POST['slottime'] : []; // Array of selected slot times

        // Get service ID based on service price
        $stmt_availability = $conn->prepare("SELECT b.*, s.s_id FROM booking b JOIN services s ON b.sid = s.s_id WHERE b.barber = :barber AND b.date = :date AND b.time = :time");
        $stmt_availability->bindParam(':barber', $barber_name);
        $stmt_availability->bindParam(':date', $date);
        $stmt_availability->bindParam(':time', $slottime);
        $stmt_availability->execute();
        $result_availability = $stmt_availability->fetchAll();

        // Get barber ID based on barber name
        $stmt_barber = $conn->prepare("SELECT b_id FROM barber WHERE b_name = :barber_name");
        $stmt_barber->bindParam(':barber_name', $barber_name);
        $stmt_barber->execute();
        $barber_row = $stmt_barber->fetch(PDO::FETCH_ASSOC);

        if ($barber_row) {
            $bid = $barber_row['b_id']; // Get the barber ID

            // Get user's email from the session
            if (isset($_SESSION['member_login'])) {
                $id = $_SESSION['member_login'];
                $stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $phone = $row['phone'];

                    foreach ($slottimes as $slottime) {
                        // Check if the barber is available
                        $stmt_availability = $conn->prepare("SELECT * FROM booking WHERE barber = :barber AND date = :date AND time = :time");
                        $stmt_availability->bindParam(':barber', $barber_name);
                        $stmt_availability->bindParam(':date', $date);
                        $stmt_availability->bindParam(':time', $slottime);
                        $stmt_availability->execute();
                        $result_availability = $stmt_availability->fetchAll();

                        if (count($result_availability) > 0) {
                            $_SESSION['error'] = "<p>Barber $barber_name is not available at $slottime on $date.</p>";
                            header("Location: ../booking.php");
                        } else {
                            // Prepare and bind SQL statement for insertion
                            $stmt_insert = $conn->prepare("INSERT INTO booking (firstname, lastname, email, phone, bid, barber, sid, service, date, time) VALUES (:firstname, :lastname, :email, :phone, :bid, :barber, :sid, :service, :date, :time)");
                            // Bind user's data to the prepared statement
                            $stmt_insert->bindParam(":firstname", $firstname);
                            $stmt_insert->bindParam(":lastname", $lastname);
                            $stmt_insert->bindParam(":email", $email);
                            $stmt_insert->bindParam(":phone", $phone);
                            $stmt_insert->bindParam(':bid', $bid); // Insert barber ID
                            $stmt_insert->bindParam(':barber', $barber_name);
                            $stmt_insert->bindParam(':sid', $result_availability[0]['s_id']); // Insert service ID from the JOIN result
                            $stmt_insert->bindParam(':service', $service); // Insert barber ID
                            $stmt_insert->bindParam(':date', $date);
                            $stmt_insert->bindParam(':time', $slottime);

                            // Execute SQL statement for insertion
                            if ($stmt_insert->execute()) {
                                $_SESSION['success'] = "<p>Booking successful! Barber: $barber_name, Service: $service, Date: $date, Time: $slottime</p>";
                                // Redirect to booking page after successful booking
                                header("Location: ../booking.php");
                                exit(); // Make sure to exit after redirecting
                            } else {
                                echo "Error: " . $stmt_insert->errorInfo()[2];
                            }
                        }
                    }
                } else {
                    echo "User not found.";
                }
            } else {
                echo "User not logged in.";
            }
        } else {
            $_SESSION['error'] = "Barber not found.";
            header("Location: ../booking.php");
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else if (isset($_GET['search_date'])) {
    // Your existing code for searching by date
} else {
    echo 'Not found';
}
