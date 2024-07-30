<?php
session_start();

include 'connection.php';
include 'query.php';
include 'message.php';

if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] != true) {
    header("Location: http://localhost/GetMyContact/html/login.php");
    exit();
}

$email = $_POST['c_mail'] ?? '';
$phone = $_POST['c_phno'] ?? '';
$name = $_POST['c_name'] ?? '';
$address = $_POST['c_add'] ?? '';
$dob = $_POST['c_dob'] ?? '';

$imagePath = '';
if (isset($_FILES['c_img']) && $_FILES['c_img']['error'] == 0) {
    $imageTmpName = $_FILES['c_img']['tmp_name'];
    $imageExtension = pathinfo($_FILES['c_img']['name'], PATHINFO_EXTENSION);
    $imageName = $phone . '.' . $imageExtension; // Image name format: phone.extension
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($imageName);

    if (move_uploaded_file($imageTmpName, $uploadFile)) {
        $oldImagePath = '../uploads/' . $_SESSION['upd_contact_img'];
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $imagePath = $imageName;
    } else {
        $_SESSION['msg'] = "Failed to upload the profile image.";
        header("Location: http://localhost/GetMyContact/html/update-mycontact.php");
        exit();
    }
}
// Update contact details in the database
$updateQry = updateMyContact($email, $name, $address, $dob, $imagePath, $phone);
$result = mysqli_query($con, $updateQry);

if ($result) {
    $_SESSION['upd_contact_email'] = $email;
    $_SESSION['upd_contact_phone'] = $phone;
    $_SESSION['upd_contact_name'] = $name;
    $_SESSION['upd_contact_address'] = $address;
    $_SESSION['upd_contact_dob'] = $dob;
    $_SESSION['upd_contact_img'] = $imagePath;

    $_SESSION['msg'] = "Contact updated successfully.";
} else {
    $_SESSION['msg'] = "An error occurred while updating the contact.";
}

header("Location: http://localhost/GetMyContact/html/contacts.php");
exit();
