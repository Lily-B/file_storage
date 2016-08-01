<?php
require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");

if(isset($_GET['id'])) {
    $file_id = $_GET['id'];
    $file_name = find_file_name_by_id($file_id);
    $upload_dir = 'uploads/';
    $full_file_name = $upload_dir . $file_name;

// Delete row from DB table
    $query = "DELETE FROM uploaded_files ";
    $query .= "WHERE id = {$file_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        if (file_exists($full_file_name)) {
// Delete file from directory
            if(unlink($full_file_name)){
                $_SESSION["message"] = "File deleted.";
                redirect_to("index.php");
            }else{
                $_SESSION["message"] = "Cannot delete file from directory.";
                redirect_to("index.php");
            }
        }else{
            $_SESSION["message"] = "File not found in directory.";
            redirect_to("index.php");
        }
    } else {
        $_SESSION["message"] = "Cannot delete file from directory from db.";
        redirect_to("index.php");
    }

} else {
    redirect_to("index.php");
}