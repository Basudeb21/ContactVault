<?php
session_start();
$_SESSION['close'] = false;

if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] != true) {
    header("Location: http://localhost/GetMyContact/html/login.php");
    exit();
}

$msg = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

include '../backends/connection.php';
include '../backends/query.php';

$user_phone = $_SESSION['phno'];
$all_data = true;

if (isset($_POST['submit'])) {
    $all_data = false;
    $data = $_POST['data'];
    $result = searchContactByDetails($user_phone, $data, $con);
} else if (isset($_POST['all'])) {
    $query = "SELECT * FROM add_to_contacts_tbl WHERE user_phno = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $all_data = true;
} else {
    $query = "SELECT * FROM add_to_contacts_tbl WHERE user_phno = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $all_data = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Vault | Contact</title>
    <link rel="shortcut icon" href="../img/logo-round.png" type="x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/contacts.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <style>
        .form-control.me-2.invisible {
            visibility: hidden;
        }
    </style>
</head>

<body>

    <?php include ("navbar.html"); ?>

    <?php if ($msg != ''): ?>
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>
    <?php endif; ?>
    <div class="break"></div>

    <div class="container mt-5 content">
        <div class="header">
            <h3 class="text-muted prj-name">Contacts</h3>
        </div>
        <div class="jumbotron list-content">
            <ul class="list-group">
                <li href="#" class="list-group-item title">
                    <div class="row">
                        <div class="col-md-5 d-flex">Your contacts list</div>
                        <div class="col-md-7">
                            <form class="d-flex w-100" role="search" method="post">
                                <input name="data"
                                    class="form-control me-2 <?php echo !$all_data ? 'invisible' : ''; ?>" type="search"
                                    placeholder="Search by name or phone number" aria-label="Search">
                                <button class="btn btn-dark" type="submit"
                                    name="<?php echo $all_data ? 'submit' : 'all'; ?>"><?php echo $all_data ? 'Search' : 'Contacts'; ?></button>
                            </form>
                        </div>
                    </div>
                </li>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $imgSrc = empty($row['contact_img']) ? "../img/avatar.jpg" : "../uploads/" . $row['contact_img'];
                        ?>
                        <li href="#" class="list-group-item text-left">
                            <img class="img-thumbnail" src="<?php echo $imgSrc; ?>" alt="Contact Image">
                            <label class="name"><?php echo $row['contact_name']; ?> <br></label>
                            <label class="name">&nbsp;&nbsp;<?php echo $row['contact_phno']; ?><br></label>
                            <label class="pull-right">
                                <form action="http://localhost/GetMyContact/backends/view_contact_from_tbl.php" method="post"
                                    style="display:inline;">
                                    <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                                    <button type="submit" class="btn btn-success mt-4"><i
                                            class="far fa-eye ms-3 me-3"></i></button>
                                </form>
                                <form action="http://localhost/GetMyContact/backends/update_my_contact.php" method="post"
                                    style="display:inline;">
                                    <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                                    <button type="submit" class="btn btn-warning mt-4"><i
                                            class="fas fa fa-edit ms-3 me-3 text-white"></i></button>
                                </form>
                                <form action="http://localhost/GetMyContact/backends/delete_contact_from_tbl.php" method="post"
                                    style="display:inline;">
                                    <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                                    <button type="submit" class="btn btn-danger mt-4"><i
                                            class="fa-solid fa-trash ms-3 me-3"></i></button>
                                </form>
                            </label>
                            <div class="break"></div>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <li href="#" class="list-group-item text-left">No contacts found.</li>
                    <?php
                }
                ?>
            </ul>
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
                        <?php echo $msg . "\n This message shows because you used a phone number or email ID that already exists in this application. So please login or create another account..."; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>