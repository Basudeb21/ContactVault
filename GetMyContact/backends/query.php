<?php

function userSignUp($name, $phno, $email, $pass)
{
    return "INSERT INTO `user_signup_tbl` (`user_name`, `user_phone`, `user_email`, `user_password`) VALUES ('$name', '$phno', '$email', '$pass')";
}

function isUserExsist($phno, $email)
{
    return "SELECT `user_phone`, `user_email` FROM `user_signup_tbl` WHERE  `user_phone` = '$phno' OR `user_email` = '$email'";
}

function checkLoginDetails($phno)
{
    return "SELECT `user_password`  FROM `user_signup_tbl` WHERE `user_phone` = $phno";
}

function checkContactsExist($cid)
{
    return "SELECT `contact_id` FROM `add_to_contacts_tbl` WHERE `contact_id` = $cid";
}

function getUserDetails($phno)
{
    return "SELECT * FROM `user_signup_tbl` WHERE `user_phone` = $phno";
}
function addToContacts($contact_id, $user_phone, $email, $phno, $name, $add, $dob, $imagePath)
{
    return "INSERT INTO add_to_contacts_tbl (contact_id, user_phno, contact_email, contact_phno, contact_name, contact_address, contact_dob, contact_img) VALUES ('$contact_id', '$user_phone', '$email', '$phno', '$name', '$add', '$dob', '$imagePath')";
}



function addToGlobalContacts($phno, $name, $email, $add, $dob)
{
    return "INSERT INTO `global_contacts`(`contact_phone`, `contact_name`, `contact_email`, `contact_address`, `contact_dob`) VALUES ('$phno','$name','$email','$add','$dob')";
}

function getGlobalContacts($phno)
{
    return "SELECT * FROM global_contacts WHERE contact_phone = '$phno'";
}

function updateGlobalContactName($updated_name, $email, $add, $phno)
{
    return "UPDATE global_contacts SET contact_name = '$updated_name', contact_email = '$email', contact_address = '$add' WHERE contact_phone = '$phno'";
}

function searchGlobalContactByPhno($phno)
{
    return "SELECT * FROM `global_contacts` WHERE `contact_phone` = $phno";
}

function deleteContactFromMe($contact_id)
{
    return "DELETE FROM add_to_contacts_tbl WHERE contact_id = '$contact_id'";
}

function selectContactFromMe($contact_id)
{
    return "SELECT * FROM `add_to_contacts_tbl` WHERE `contact_id` = '$contact_id'";
}

function updateUserProfile($email, $name, $address, $dob, $imagePath, $user_phone)
{
    return "UPDATE user_signup_tbl SET user_email = '$email', user_name = '$name', user_address = '$address', user_birthdate = '$dob', user_img = '$imagePath' WHERE user_phone = '$user_phone'";
}

function countProfileContacts($user_phno)
{
    return "SELECT COUNT(*) AS row_count FROM `add_to_contacts_tbl` WHERE `user_phno` = '$user_phno'";
}

function updateMyContact($email, $name, $add, $dob, $img, $phno)
{
    return "UPDATE `add_to_contacts_tbl` SET `contact_email` = '$email', `contact_name` = '$name', `contact_address` = '$add', `contact_dob` = '$dob', `contact_img` = '$img' WHERE `contact_phno` = '$phno'";
}

// function searchContactByDetails($phno, $data)
// {

//     $data = "%" . $data . "%";
//     return "SELECT `contact_id`,`user_phno`,`contact_phno`,`contact_name` FROM `add_to_contacts_tbl` WHERE `user_phno`= '$phno' AND (`contact_phno`= LIKE '$data' OR `contact_name` LIKE '$data')";
// }


function searchContactByDetails($phno, $data, $conn)
{
    $sql = "SELECT `contact_id`, `user_phno`, `contact_phno`, `contact_name`,`contact_img` 
            FROM `add_to_contacts_tbl` 
            WHERE `user_phno` = ? 
            AND (`contact_phno` LIKE ? OR `contact_name` LIKE ?)";

    if ($stmt = $conn->prepare($sql)) {
        $likeData = '%' . $data . '%';
        $stmt->bind_param("sss", $phno, $likeData, $likeData);
        $stmt->execute();
        return $stmt->get_result();
    } else {
        die("SQL error: " . $conn->error);
    }
}
