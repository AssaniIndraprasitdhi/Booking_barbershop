<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['admin_login'])) {
    header('location:signin.php');
} else if (isset($_SESSION['admin_login'])) {
    $query = $conn->query("SELECT * FROM account WHERE role = 'admin'");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
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

            <li class="active">
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
                <h5 class="text">Account</h5>

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Create At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <form action="../control/delete.admin_db.php" method="POST">
                    <tbody>
                        <tr class="mt-5">
                            <?php
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            $stmt = $conn->prepare("SELECT * FROM account");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $data) {
                            ?>
                        <tr>
                            <td><?= $data['id']; ?></td>
                            <td><?= $data['firstname']; ?></td>
                            <td><?= $data['lastname']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td><?= $data['phone']; ?></td>
                            <td><?= $data['role']; ?></td>
                            <td><?= $data['create_at']; ?></td>
                            <td>
                                <a href="../control/delete.admin_db.php?id=<?php echo $data['id']; ?>" type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete data !!');">Delete</?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </form>
            </table>
        </div>
    </div>


</body>

</html>