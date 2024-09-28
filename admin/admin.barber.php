<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['admin_login'])) {
    header('location:../views/signin.php');
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
            <li>
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


            <li class="active">
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
            <table class="table mt-1 w-20px">
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <form action="../control/delete.admin_db.php" method="POST">
                    <tbody>
                        <tr class="mt-2">
                            <?php
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            $stmt = $conn->prepare("SELECT * FROM barber");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $data) {
                            ?>
                        <tr>
                            <td><?= $data['b_id']; ?></td>
                            <td><?= $data['b_firstname']; ?></td>
                            <td><?= $data['b_lastname']; ?></td>
                            <td><?= $data['b_name']; ?></td>
                            <td><?= $data['b_phone']; ?></td>

                            <td><a href="../control/barber.admin_db.php?b_id=<?php echo $data['b_id']; ?>" type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete data !!');">Delete</?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </form>
            </table>
        </div>
    </div>

    <div class="popup mt-5">
        <div class="popup-content">
            <span class="header">
                Add barber
            </span>
            <form action="../control/barber.admin_db.php" method="POST">

                <div class="add_barber1">
                    <label for="id" class="label">ID</label>
                    <input type="text" name="id" required>
                </div>
                <div class="add_barber2">
                    <label for="name" class="label">Firstname</label>
                    <input type="text" name="firstname" required>
                </div>

                <div class="add_barber2">
                    <label for="name" class="label">Lastname</label>
                    <input type="text" name="lastname" required>
                </div>
                <div class="add_barber2">
                    <label for="name" class="label">Phone</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="add_barber2">
                    <label for="name" class="label">Nickname</label>
                    <input type="text" name="name" required>
                </div>
                <div class="button">
                    <button type="submit" name="add" class="btn btn-primary btn-sm">Add</button>
                </div>

        </div>

        </form>
    </div>
</body>

</html>