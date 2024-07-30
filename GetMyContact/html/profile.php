<?php
session_start();

include '../backends/connection.php';
include '../backends/query.php';
$rowCount = 0;
include '../backends/connection.php';
if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] != true) {
    header("Location: http://localhost/GetMyContact/html/login.php");
    exit();
}
$msg = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$profilePic = '../img/avatar.jpg';
if (isset($_SESSION['user_img']) && !empty($_SESSION['user_img'])) {
    $profilePic = '../profile_pics/' . $_SESSION['user_img'] . '?' . time();
}

$user_phno = $_SESSION['user_phone'];

$query = countProfileContacts($user_phno);
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $rowCount = $row['row_count'];
}

mysqli_close($con);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Vault | Profile Page</title>
    <link rel="shortcut icon" href="../img/logo-round.png" type="x-icon">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <?php
    include ("navbar.html");
    ?>
    <?php if ($msg != ''): ?>
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>
    <?php endif; ?>

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
                                            <img src="<?php echo $profilePic; ?>"
                                                class="img-radius img-fluid profile-pic" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600"><?php echo $_SESSION['user_name'] ?></h6>
                                        <p><?php echo $rowCount . " Contacts" ?></p>
                                        <form action="http://localhost/GetMyContact/html/update-user.php" method="post">
                                            <button class="btn btn-primary pl-3 pr-3" type="submit">Edit <i
                                                    class="fas fa fa-edit"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Contacts</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_email'] ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_phone'] ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Subscription</p>
                                                <h6 class="text-muted f-w-400">
                                                    <?php $subs = $_SESSION['user_subscription'] == null ? "No" : $_SESSION['user_subscription'];
                                                    echo $subs;
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Joined On</p>
                                                <h6 class="text-muted f-w-400">
                                                    <?php
                                                    echo $_SESSION['date_of_join'] ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6 mt-3">
                                                <p class="m-b-10 f-w-600">Birth Date</p>
                                                <h6 class="text-muted f-w-400">
                                                    <?php $dob = $_SESSION['user_birthdate'] == null ? "Not set" : $_SESSION['user_birthdate'];
                                                    echo $dob;
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6 mt-3">
                                                <p class="m-b-10 f-w-600">Address</p>
                                                <h6 class="text-muted f-w-400">
                                                    <?php $add = $_SESSION['user_address'] == null ? "Not set" : $_SESSION['user_address'];
                                                    echo $add;
                                                    ?>
                                                </h6>
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

    <?php if ($msg != ''): ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true"
            data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="messageModalLabel">Contact Vault says....</h5>
                    </div>
                    <div class="modal-body">
                        <?php echo $msg; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
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