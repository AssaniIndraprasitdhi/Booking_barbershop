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
                        <a class="nav-link" href="homepage.after.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.after.php">Prices</a>
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
    <div class="container-xl px-4 mt-30 d-flex justify-content-center rounded-5">
        <div class="col-xl-6">
            <!-- Account details card-->
            <div class="card mb-2">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form action="profile-edit.php" method="POST">
                        <div class="img-box d-flex justify-content-between">
                            <!-- Form Group (first name)-->
                            <div class="row gx-3 mb-3 col-md-6">
                                <img src="<?php echo $image ?>" alt="" class="img">
                            </div>
                            <div class="row gx-3 mb-3 col-md-6">
                                <h6 class="mt-5">Firstname : <?php echo $row['firstname'] ?></h6>
                                <h6 class="mt-4">Lastname : <?php echo $row['lastname'] ?></h6>
                                <h6 class="mt-4">Email : <?php echo $row['email'] ?></h6>
                                <h6 class="mt-4">Phone : <?php echo $row['phone'] ?></h6>
                            </div>

                        </div>
                        <!-- Save changes button-->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit" onclick="'location.document = profile-edit.php'">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Javascript Files  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="js/core.js"></script>
</body>

</html>
