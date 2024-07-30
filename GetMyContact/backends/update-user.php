<?php
session_start();
include 'connection.php';
include 'query.php';
include 'message.php';

if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] != true) {
    header("Location: http://localhost/GetMyContact/html/login.php");
    exit();
}

$user_phone = $_SESSION['user_phone'];
$user_email = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_address = $_SESSION['user_address'];
$user_birthdate = $_SESSION['user_birthdate'];
$user_img = $_SESSION['user_img'];

if (isset($_POST['submit'])) {
    $email = $_POST['user_email'] ?? $user_email;
    $name = $_POST['user_name'] ?? $user_name;
    $address = $_POST['user_address'] ?? $user_address;
    $dob = $_POST['user_birthdate'] ?? $user_birthdate;
    $phno = $_POST['user_phone'] ?? $user_phone;


    $imagePath = $user_img; // Retain the existing image path by default

    if (isset($_FILES['c_img']) && $_FILES['c_img']['error'] == 0) {
        $imageTmpName = $_FILES['c_img']['tmp_name'];
        $imageExtension = pathinfo($_FILES['c_img']['name'], PATHINFO_EXTENSION);
        $imageName = $user_phone . '.' . $imageExtension; // Image name format: phno.extension
        $uploadDir = '../profile_pics/';
        $uploadFile = $uploadDir . basename($imageName);


        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            $imagePath = $imageName; // Update with new image name
        } else {
            $_SESSION["msg"] = "Failed to upload the profile image.";
            header("Location: http://localhost/GetMyContact/html/update-user.php");
            exit();
        }
    }


    $updateQry = updateUserProfile($email, $name, $address, $dob, $imagePath, $user_phone);

    if (mysqli_query($con, $updateQry)) {
        // Update session variables
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_address'] = $address;
        $_SESSION['user_birthdate'] = $dob;
        $_SESSION['user_img'] = $imagePath;

        $_SESSION["msg"] = "Profile updated successfully.";
    } else {
        $_SESSION["msg"] = "An error occurred while updating the profile.";
    }

    header("Location: http://localhost/GetMyContact/html/update-user.php");
    exit();
}