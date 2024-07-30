<?php

include 'connection.php';
include 'query.php';
include 'message.php';


if (isset($_POST['Login'])) {
    session_start();
    $phno = $_POST['phno'];
    $pass = $_POST['pass'];

    $qry = checkLoginDetails($phno);
    $result = mysqli_query($con, $qry);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION["msg"] = "Your phone number is not register login again or signup.";
        header("Location: http://localhost/GetMyContact/html/login.php");
        exit();
    } else {

        $row = mysqli_fetch_assoc($result);
        $stored_pass = $row['user_password'];

        if ($pass == $stored_pass) {
            $_SESSION["isLoggedin"] = true;
            $_SESSION["phno"] = $phno;
            $qry = getUserDetails($phno);
            $result = mysqli_query($con, $qry);
            $userDetails = mysqli_fetch_assoc($result);
            $_SESSION['user_name'] = $userDetails['user_name'];
            $_SESSION['user_phone'] = $userDetails['user_phone'];
            $_SESSION['user_email'] = $userDetails['user_email'];
            $_SESSION['user_subscription'] = $userDetails['user_subscription'];
            $_SESSION['user_birthdate'] = $userDetails['user_birthdate'];
            $_SESSION['user_address'] = $userDetails['user_address'];
            $_SESSION['date_of_join'] = $userDetails['date_of_join'];
            $_SESSION['user_img'] = $userDetails['user_img'];

            header("Location: http://localhost/GetMyContact/html/profile.php");
            exit();
        } else {
            $_SESSION["msg"] = "Incorrect password. Please try again.";
            header("Location: http://localhost/GetMyContact/html/login.php");
            exit();
        }
    }
}