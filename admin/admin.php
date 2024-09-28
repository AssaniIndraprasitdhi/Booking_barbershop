<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['admin_login'])) {
    header('location:../views/signin.php');
} else if (isset($_SESSION['admin_login'])) {
    $query = $conn->query("SELECT * FROM account WHERE role = 'admin'");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
}

// Handle form submission for searching by date
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_date'])) {
    // Retrieve the search date from the form
    $search_date = $_GET['search_date'];

    try {
        // Prepare and execute the query to fetch bookings for the specified date
        $stmt = $conn->prepare("SELECT * FROM booking WHERE date = :search_date");
        $stmt->bindParam(':search_date', $search_date);
        $stmt->execute();
        $result = $stmt->fetchAll();
    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
} else {
    // If no date is selected, display bookings for the current date
    $current_date = date("Y-m-d");
    try {
        // Prepare and execute the query to fetch bookings for the current date
        $stmt = $conn->prepare("SELECT * FROM booking WHERE date = :current_date");
        $stmt->bindParam(':current_date', $current_date);
        $stmt->execute();
        $result = $stmt->fetchAll();
    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>admin</title>
</head>

<body>
    <section class="sidebar">
        <a href="#" class="logo">
            <i class="fab fa-slack"></i>
            <span class="text">Admin</span>

        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="admin.php" class="nav-link">
                    <i class="bx bx-book icon"></i>
                    <span class="text">Booking</span>
                </a>
            </li>

            <li>
                <a href="admin.account.php" class="nav-link">
                    <i class="bx bx-user icon"></i>
                    <span class="text">Account</span>
                </a>
            </li>


            <li>
                <a href="admin.barber.php" class="nav-link">
                    <i class="fas fa-people-group"></i>
                    <span class="text">Barber</span>
                </a>
            </li>
        </ul>


        <ul class="side-menu">
            <li>
                <a href="../views/signin.php" class="logout">
                    <i class="fas fa-right-from-bracket"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <section class="content">
        <nav>
            <i class="fas fa-bars menu-btn"></i>
        </nav>
    </section>

    <div class="container">
        <div class="table">
            <table class="table mt-4 w-20px">
                <!-- Display success, error, or search messages -->
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php } ?>

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php } ?>

                <!-- Search form -->
                <div class="header">
                    <h6>Search Date : </h6>
                </div>

                <div class="input-group">
                    <form action="" method="GET">
                        <input type="date" name="search_date" class="form-control" required>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <!-- Table header -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Barber</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    <?php if (isset($result) && count($result) > 0) {
                        foreach ($result as $data) { ?>
                            <tr>
                                <td><?= $data['id']; ?></td>
                                <td><?= $data['firstname']; ?></td>
                                <td><?= $data['lastname']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['phone']; ?></td>
                                <td><?= $data['service']; ?></td>
                                <td><?= $data['barber']; ?></td>
                                <td><?= $data['date']; ?></td>
                                <td><?= $data['time']; ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="../control/cancel.admin_db.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirm cancel?');">Cancel</a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="10">No bookings found for the selected date.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>