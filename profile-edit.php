<?php

session_start();
require_once 'config/db.php';

if (isset($_SESSION['member_login'])) {
    $id = $_SESSION['member_login'];
    $query = $conn->query("SELECT * FROM account WHERE id = $id");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $directory = 'img/';
    $image = $directory . $row['img'];
} else if (!isset($_SESSION['member_login'])) {
	header('location:views/signin.php');
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking</title>
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
                        <a class="nav-link" href="homepage.after.php#home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php#price">Prices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.php">Booking Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">Profile</a>
                    </li>
                </ul>
                <a class="btn btn-primary text-white mr-3" href="views/signout.php">Sign out</a>
            </div>
        </div>
    </nav>
    <div class="container-xxl px-4 mt-30 d-flex justify-content-center rounded-5">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-2">
                <div class="card-header">Profile Edit</div>
                <div class="card-body">
                    <form action="control/profile_db.php" method="POST">
                        <!-- Form Row-->
                        <!-- Form Group (first name)-->
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['warning'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <?php
                                echo $_SESSION['warning'];
                                unset($_SESSION['warning']);
                                ?>
                            </div>
                        <?php } ?>
                        <div class="img-box d-flex justify-content-between">
                            <!-- Form Group (first name)-->
                            <div class="row gx-3 mb-3 col-md-6">
                                <img src="<?php echo $image?>" alt="" class="img">
                                <input type="file" name="image">
                            </div>
                            <div class="row gx-3 mb-3 col-md-6">
                                <label class="small mb-1" for="new_firstName">Firstname</label>
                                <input class="form-control" name="new_firstname" type="text" placeholder="Enter your first name" required>
                                <label class="small mb-1" for="new_lastname">Lastname</label>
                                <input class="form-control" name="new_lastname" type="text" placeholder="Enter your last name" required>
                                <label class="small mb-1" for="new_email">Email address</label>
                                <input class="form-control" name="new_email" type="email" placeholder="Enter your email address" required>
                                <label class="small mb-1" for="new_phone">Phone number</label>
                                <input class="form-control" name="new_phone" type="tel" placeholder="Enter your phone number" required>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary text-white mr-3" href="profile.php">Back</a>
                            <button class="btn btn-primary d-flex justify-content-center" type="submit" name="submit">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Javascript Files  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/core.js"></script>
</body>

</html>