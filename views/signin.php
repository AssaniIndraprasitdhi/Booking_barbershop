<?php
session_start();
require_once("../config/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign in</title>
</head>

<body class="background">
    <div class="wrapper">
        <div class="login-box">
            <div class="header">
                <span>Sign in</span>
            </div>
            <form action="../control/signin_db.php" method="POST">
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
                <div class="input-box">
                    <input name="email" type="email" class="input-field" placeholder="Email" required>
                    <label for="email" class="label"></label>
                    <i class="bx bx-envelope icon"></i>
                </div>

                <div class="input-box">
                    <input name="password" type="password" class="input-field" placeholder="Password" required>
                    <label for="password" class="label"></label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>

                <div class="input-box">
                    <div class="submit">
                        <button type="submit" name="submit"><span>Sign in</span></button>
                    </div>
                </div>
            </form>
            <div class="register">
                <span>You don't have a member yet ? <a href="signup.php"> Sign up</a></span>
            </div>
        </div>
    </div>

</body>

</html>