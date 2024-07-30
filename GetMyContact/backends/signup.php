<?php

include 'connection.php';
include 'query.php';
include 'message.php';
session_start();

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $phno = $_POST['phno'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phno = ltrim($phno, '0');

    $checkQuery = isUserExsist($phno, $email);
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION["msg"] = "Phone number or email already exists.";
        header("Location: http://localhost/GetMyContact/html/signup.php");
        exit();
    } else {
        $global_chk_qry = getGlobalContacts($phno);
        $global_chk_result = mysqli_query($con, $global_chk_qry);

        if (mysqli_num_rows($global_chk_result) > 0) {
            $row = mysqli_fetch_assoc($global_chk_result);
            $existing_name = $row['contact_name'];
            $updated_name = $existing_name . $name . "&cvnil";
            $update_qry = updateGlobalContactName($updated_name, $email, $add, $phno);
            mysqli_query($con, $update_qry);
        } else {
            $insert_qry = addToGlobalContacts($phno, $name . "&cvnil", $email, $add, $dob);
            mysqli_query($con, $insert_qry);
        }
        $qry = userSignUp($name, $phno, $email, $pass);
        $result = mysqli_query($con, $qry);

        if ($result) {
            $_SESSION["msg"] = "Registration successful.";
            header("Location: http://localhost/GetMyContact/html/login.php");
            exit();
        } else {
            $_SESSION["msg"] = "An error occurred... data not stored...";
            header("Location: http://localhost/GetMyContact/html/signup.php");
            exit();
        }
    }

}
