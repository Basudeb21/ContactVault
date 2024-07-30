<?php
session_start();

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
if (isset($_SESSION['upd_contact_img']) && !empty($_SESSION['upd_contact_img'])) {
    $profilePic = '../uploads/' . $_SESSION['upd_contact_img'] . '?' . time();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Vault | Update My Contacts</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/store.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="shortcut icon" href="../img/logo-round.png" type="x-icon">

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

    <div class="header ">
        <h3 class="text-muted prj-name">
            Contacts
        </h3>
    </div>

    <div class="container mt-5">
        <form class="form-horizontal" role="form" method="post"
            action="http://localhost/GetMyContact/backends/update_mycontact.php" enctype="multipart/form-data">

            <h1 class="text-primary mt-5">Add Contacts</h1>
            <hr>
            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img id="previewImg" src="<?php echo $profilePic; ?>"
                            class="avatar img-fluid img-circle img-thumbnail" alt="avatar">
                        <h6>Upload a different photo...</h6>
                        <input type="file" class="form-control" name="c_img" accept="image/*" onchange="previewFile()">
                        <input class="btn btn-lg btn-primary w-100 fs-6 mt-3" type="submit" name="submit"
                            value="Update Contact">

                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">

                    <h3>Contact Information</h3>


                    <div class="form-group">
                        <label class="col-lg-3 mb-2 control-label">
                            <span class="lbl-txt">Email</span>
                        </label>
                        <div class="col-lg-8 mb-2">
                            <input class="form-control" type="email" placeholder="example@gmail.com" name="c_mail"
                                value="<?php echo $_SESSION['upd_contact_email'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 mb-2 control-label">
                            <span class="lbl-txt">Phone</span>
                        </label>
                        <div class="col-lg-8 mb-2">
                            <input class="form-control" type="number" placeholder="9876543210" name="c_phno"
                                value="<?php echo $_SESSION['upd_contact_phno'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 mb-2 control-label">
                            <span class="lbl-txt">Name</span>
                        </label>
                        <div class="col-lg-8 mb-2">
                            <input class="form-control" type="text" placeholder="Jhon Doe" name="c_name"
                                value="<?php echo $_SESSION['upd_contact_name'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 mb-2 control-label">
                            <span class="lbl-txt">Address</span>
                        </label>
                        <div class="col-lg-8 mb-2">
                            <input class="form-control" type="text" placeholder="Janai Road, Hooghly, Westbengal"
                                name="c_add" value="<?php echo $_SESSION['upd_contact_address'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 mb-2 control-label">
                            <span class="lbl-txt">DOB</span>
                        </label>
                        <div class="col-lg-8 mb-2">
                            <input class="form-control" type="date" name="c_dob">
                        </div>
                    </div>


                </div>
            </div>
        </form>
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
    <script>
        function previewFile() {
            const preview = document.getElementById('previewImg');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>