<?php
session_start();

include 'connection.php';
include 'query.php';


if (isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];

    // Fetch the image name associated with the contact
    $query = selectContactFromMe($contact_id);
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $imgName = $row['contact_img'];

        // Delete the contact from the database
        $deleteQuery = deleteContactFromMe($contact_id);
        if (mysqli_query($con, $deleteQuery)) {
            // Delete the image file if it exists
            if (!empty($imgName)) {
                $filePath = '../uploads/' . $imgName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $_SESSION["msg"] = "Contact deleted successfully.";
            header("Location: http://localhost/GetMyContact/html/contacts.php");
            exit();


        } else {
            $_SESSION["msg"] = "Failed to delete contact.";
        }
    } else {
        $_SESSION["msg"] = "Contact not found.";
    }
} else {
    $_SESSION["msg"] = "No contact ID provided.";
}
header("Location: http://localhost/GetMyContact/html/contacts.php");
exit();
