<?php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['member_login'])) {
    $id = $_SESSION['member_login'];
    $query = $conn->prepare("SELECT * FROM account WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $stmt_email = $row["email"];

    // Get current date
    $current_date = date("Y-m-d");

    // Prepare and execute the query to retrieve bookings for the current user and current date
    $query2 = $conn->prepare("SELECT b.*, s.s_price
                              FROM booking b
                              INNER JOIN services s ON b.service = s.s_name
                              WHERE b.email = :email AND b.date = :current_date");
    $query2->bindParam(":email", $stmt_email);
    $query2->bindParam(":current_date", $current_date);
    $query2->execute();
} else if (!isset($_SESSION['member_login'])) {
    header('location:views/signin.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <!-- Include your CSS and JS files here -->
</head>

<!-- bootstrap Style CSS File -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Custom Style CSS File -->
<link rel="stylesheet" type="text/css" href="css/custom-style.css">
<link rel="stylesheet" type="text/css" href="css/loaders.css" />
<link rel="stylesheet" href="css/style.css">
<!-- Font-Awesome Style CSS File -->
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

<body>

    <!-- Page loading animation -->
    <div class="loader loader-bg">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Top navigation -->
    <nav class="navbar navbar-expand-md top-nav bg bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><strong>Barbershop</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><img src="img/icons/menu.png"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto text-sm-center text-md-center">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php#price">Prices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking_detail.php">Booking Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">Profile</a>
                    </li>
                </ul>
                <a class="btn btn-primary text-white mr-3" href="views/signout.php">Sign out</a>
            </div>
        </div>
    </nav>
    <!-- Your HTML content for displaying booking details -->
    <div class="container mt-5 text-center">
    <div class="container mt-5 text-center">
        <h2>Booking Successfully</h2>
        <h2 class="mt-3">Booking Details</h2>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if ($query2->rowCount() > 0) { ?>
            <?php while ($row = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card-body">
                    <h6 class="card-text"><strong>Name:</strong> <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h6>
                    <h6 class="card-text"><strong>Service:</strong> <?php echo $row['service']; ?></h6>
                    <h6 class="card-text"><strong>Service Price:</strong> <?php echo $row['s_price']; ?> Bath</h6>
                    <h6 class="card-text"><strong>Barber:</strong> <?php echo $row['barber']; ?></h6>
                    <h6 class="card-text"><strong>Date:</strong> <?php echo $row['date']; ?></h6>
                    <h6 class="card-text"><strong>Time:</strong> <?php echo $row['time']; ?></h6>
                    <form action="control/cancel_db.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-primary" name="cancel" onclick="return confirm('Confirm cancel?');">cancel</button>
                    </form>
                </div>
            <?php } ?>

        <?php } else { ?>
            <p>No bookings found.</p>
        <?php } ?>
    </div>

    <!-- Include your JavaScript files here -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/core.js"></script>
</body>

</html>
