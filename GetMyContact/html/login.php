<?php
session_start();
$msg = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img/logo-round.png" type="x-icon">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Contact Vault | Login</title>
</head>

<body>

    <?php if ($msg != ''): ?>
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>
    <?php endif; ?>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="http://localhost/GetMyContact/img/logo.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    Login now</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Hello, user login now on your
                    id.</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Welcome, Back</h2>
                    </div>
                    <form action="http://localhost/GetMyContact/backends/login.php" method="post">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Enter phone number" name="phno" required>
                        </div>
                        <div class="input-group mb-5">
                            <input type="password" name="pass" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Enter password" required>
                        </div>

                        <div class="input-group mb-3">
                            <input class="btn btn-lg btn-primary w-100 fs-6" type="submit" name="Login" value="Login">
                        </div>
                    </form>
                    <div class="row">
                        <small>Don't have an account? <a href="http://localhost/GetMyContact/html/signup.php">Signup
                                now</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php if ($msg != ''): ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true"
            data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="messageModalLabel">Contact Vault says....</h5>
                    </div>
                    <div class="modal-body">
                        <?php echo "$msg"; ?>
                    </div>
                    <div class="modal-footer">
                        <a href="http://localhost/GetMyContact/html/login.php" class="btn btn-success text-white">Login</a>
                        <a href="http://localhost/GetMyContact/html/signup.php"
                            class="btn btn-primary text-white">Signup</a>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($msg != ''): ?>
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>
    <?php endif; ?>

</body>

</html>