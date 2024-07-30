<?php
session_start();
include 'connection.php';
include 'query.php';




if (isset($_POST['contact_id'])) {
    $query = selectContactFromMe($_POST['contact_id']);
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {

        $string = $row['contact_name'];
        $array = explode('&cvnil', $string);

        $count = array_count_values($array);
        $maxCount = max($count);
        $maxString = array_search($maxCount, $count);

        $imgName = $row['contact_img'];

        $_SESSION['close'] = true;
        $_SESSION['show_contact_phno'] = $row['contact_phno'];
        $_SESSION['show_contact_email'] = $row['contact_email'];
        $_SESSION['show_contact_name'] = $maxString;
        $_SESSION['show_contact_address'] = $row['contact_address'];
        $_SESSION['show_contact_dob'] = $row['contact_dob'];
        $_SESSION['show_contact_img'] = $row['contact_img'];

        header("Location: http://localhost/GetMyContact/html/search.php");
        exit();
    } else {
        $_SESSION["msg"] = "Failed to fatched contact.";
        header("Location: http://localhost/GetMyContact/html/contacts.php");
        exit();
    }



}