<?php

include 'connection.php';
include 'query.php';
include 'message.php'; // Commented out since it's causing an inclusion error
session_start();

if (isset($_POST['submit'])) {
    $phno = $_POST['phno'];

    $qry = searchGlobalContactByPhno($phno);
    $result = mysqli_query($con, $qry);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["msg"] = "The phone number you entered is not available in our server..........";
        header("Location: http://localhost/GetMyContact/html/search.php");
        exit();
    } else {

        $_SESSION['close'] = true;

        $row = mysqli_fetch_assoc($result);

        $string = $row['contact_name'];
        $array = array_filter(explode('&cvnil', $string));
        $count = array_count_values($array);
        $maxCount = max($count);
        $maxString = array_search($maxCount, $count);



        $_SESSION['contact_phone'] = $row['contact_phone'];
        $_SESSION['contact_name'] = rtrim($maxString, "&cvnil");
        $_SESSION['contact_email'] = $row['contact_email'];
        $_SESSION['contact_address'] = $row['contact_address'];
        $_SESSION['contact_dob'] = $row['contact_dob'];
        $_SESSION['sr_contact_img'] = $row['contact_img'];

        header("Location: http://localhost/GetMyContact/html/search.php");

        exit();
    }
}
