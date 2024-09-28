<?php
session_start();
require_once '../config/db.php';

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
    <title>admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="navbar navbar-light bg-light">
        <div>
            <a class="navbar-brand">BackHome</a>
        </div>

        <form class="form-inline">
            <a href="signout.php" class="btn btn-danger">Sign out</a>
        </form>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="admin.php">Account</a>
            <h5 class="d-flex justify-content-center mt-4">Welcome <?php echo $firstname . ' ' . $lastname ?></h5>
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


                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Create At</th>
                        <th scope="col"></th>
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
                            <td><a href="../control/delete.admin_db.php?id=<?php echo $data['id']; ?>" type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete data !!');">Delete</?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </form>
            </table>
        </div>
    </div>

        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>

</body>

</html>