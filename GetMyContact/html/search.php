<?php

error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] != true) {
    header("Location: http://localhost/GetMyContact/html/login.php");
    exit();
}
$imgSrc = "";

if (!empty($_SESSION['show_contact_img'])) {
    $imgSrc = "../uploads/" . $_SESSION['show_contact_img'];
    $_SESSION['show_contact_img'] = "";
} else if (!empty($_SESSION['upd_contact_img'])) {
    $imgSrc = "../uploads/" . $_SESSION['upd_contact_img'];
    $_SESSION['upd_contact_img'] = "";
} else {
    if (!empty($_SESSION['sr_contact_img'])) {
        $imgSrc = $_SESSION['sr_contact_img'];
        $_SESSION['sr_contact_img'] = "";
    } else {
        $imgSrc = "../img/avatar.jpg";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Vault | Search Profile</title>
    <link rel="shortcut icon" href="../img/logo-round.png" type="x-icon">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <?php
    include ("navbar.html");
    ?>

    <?php
    if ($_SESSION['close'] != true) {
        $_SESSION['close'] = false;
        ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true"
            data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="messageModalLabel">Enter The Phone Number You Want To
                            Search....</h5>
                    </div>
                    <form action="http://localhost/GetMyContact/backends/search.php" method="post">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control form-control-lg bg-light fs-6"
                                    placeholder="Enter phone number" name="phno" required>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-info text-white" type="submit" name="submit" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>

    <script>
        $(document).ready(function () {
            $('#myModal').modal('show');
        });
    </script>



    <div class="container mt-5">
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-xl-6 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            <img src="<?php
                                            if ($imgSrc == "" || $imgSrc == null) {
                                                echo "../img/avatar.jpg";
                                            } else {
                                                echo $imgSrc;
                                            }

                                            ?>" class="img-radius img-fluid profile-pic" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600">
                                            <?php
                                            if ($_SESSION['contact_name'] != null) {
                                                echo $_SESSION['contact_name'];
                                                $_SESSION['contact_name'] = null;
                                                $_SESSION['close'] = false;
                                            } else if ($_SESSION['show_contact_name'] != null) {
                                                echo $_SESSION['show_contact_name'];
                                                $_SESSION['show_contact_name'] = null;
                                                $_SESSION['close'] = false;

                                            } else {
                                                echo "null";
                                                $_SESSION['close'] = false;
                                            }
                                            ?>

                                        </h6>

                                        <button class="btn btn-primary pl-3 pr-3 disabled">Message <i
                                                class="fas fa-sms"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Contacts</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400">
                                                    <?php
                                                    if ($_SESSION['contact_email'] != null) {
                                                        echo $_SESSION['contact_email'];
                                                        $_SESSION['contact_email'] = null;
                                                    } else if ($_SESSION['show_contact_email'] != null) {
                                                        echo $_SESSION['show_contact_email'];
                                                        $_SESSION['show_contact_email'] = null;
                                                    } else {
                                                        echo "null";
                                                    }
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400"><?php
                                                if ($_SESSION['contact_phone'] != null) {
                                                    echo $_SESSION['contact_phone'];
                                                    $_SESSION['contact_phone'] = null;
                                                } else if ($_SESSION['show_contact_phno'] != null) {
                                                    echo $_SESSION['show_contact_phno'];
                                                    $_SESSION['show_contact_phno'] = null;
                                                } else {
                                                    echo "null";
                                                }
                                                ?></h6>
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Information</h6>
                                        <div class="row">

                                            <div class="col-sm-6 mt-3">
                                                <p class="m-b-10 f-w-600">Birth Date</p>
                                                <h6 class="text-muted f-w-400"><?php
                                                if ($_SESSION['contact_dob'] != null) {
                                                    echo $_SESSION['contact_dob'];
                                                    $_SESSION['contact_dob'] = null;
                                                } else if ($_SESSION['show_contact_dob'] != null) {
                                                    echo $_SESSION['show_contact_dob'];
                                                    $_SESSION['show_contact_dob'] = null;
                                                } else {
                                                    echo "null";
                                                }
                                                ?></h6>
                                            </div>
                                            <div class="col-sm-6 mt-1">
                                                <p class="m-b-10 f-w-600">Address</p>
                                                <h6 class="text-muted f-w-400"><?php
                                                if ($_SESSION['contact_address'] != null) {
                                                    echo $_SESSION['contact_address'];
                                                    echo $_SESSION['contact_address'] = null;
                                                } else if ($_SESSION['show_contact_address'] != null) {
                                                    echo $_SESSION['show_contact_address'];
                                                    $_SESSION['show_contact_address'] = null;

                                                } else {
                                                    echo "null";
                                                }
                                                ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</body>

</html>