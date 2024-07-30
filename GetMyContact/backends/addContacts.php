<?php

include 'connection.php';
include 'query.php';
include 'message.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['c_mail'];
    $phno = $_POST['c_phno'];
    $name = $_POST['c_name'];
    $add = $_POST['c_add'];
    $dob = $_POST['c_dob'];
    $imagePath = '';

    $chk_qry = checkContactsExist($_SESSION['user_phone'] . $phno);
    $chk_result = mysqli_query($con, $chk_qry);

    if (mysqli_num_rows($chk_result) > 0) {
        $_SESSION["msg"] = "Contact already exists.";
        header("Location: http://localhost/GetMyContact/html/store.php");
        exit();
    } else {
        $global_chk_qry = getGlobalContacts($phno);
        $global_chk_result = mysqli_query($con, $global_chk_qry);

        if (mysqli_num_rows($global_chk_result) > 0) {
            $row = mysqli_fetch_assoc($global_chk_result);
            $existing_name .= $row['contact_name'];
            $updated_name = $existing_name . $name . "&cvnil";
            $update_qry = updateGlobalContactName($updated_name, $email, $add, $phno);
            mysqli_query($con, $update_qry);
        } else {
            $insert_qry = addToGlobalContacts($_POST['c_phno'], $name . "&cvnil", $email, $add, $dob);
            mysqli_query($con, $insert_qry);
        }

        if (isset($_FILES['c_img']) && $_FILES['c_img']['error'] == 0) {
            $imageTmpName = $_FILES['c_img']['tmp_name'];
            $imageExtension = pathinfo($_FILES['c_img']['name'], PATHINFO_EXTENSION);
            $imageName = $_SESSION['user_phone'] . $phno . '.' . $imageExtension; // Save the image as contact_id.extension
            $uploadDir = '../uploads/';
            $uploadFile = $uploadDir . basename($imageName);


            if (move_uploaded_file($imageTmpName, $uploadFile)) {
                $imagePath = $imageName; // Save the image name to use in the database
                $qry = addToContacts($_SESSION['user_phone'] . $phno, $_SESSION['user_phone'], $email, $phno, $name, $add, $dob, $imagePath);
                $result = mysqli_query($con, $qry);
                if ($result) {
                    $_SESSION["msg"] = "Contact added successfully.";
                    header("Location: http://localhost/GetMyContact/html/store.php");
                    exit();
                } else {
                    $_SESSION["msg"] = "An error occurred... data not stored...";
                    header("Location: http://localhost/GetMyContact/html/store.php");
                    exit();
                }
            } else {
                $_SESSION["msg"] = "File upload failed.";
                header("Location: http://localhost/GetMyContact/html/store.php");
                exit();
            }
        }



    }
}