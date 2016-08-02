<?php
require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");

if(isset($_GET['id'])) {
    $file_id = $_GET['id'];
    $file = find_file_by_id($file_id);
    $file_name = $file["name"];
    // Full file name in directory
    $file_name_in_dir = $file["name_in_dir"];

// Delete row from DB table
    $query = "DELETE FROM uploaded_files ";
    $query .= "WHERE id = {$file_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        if (file_exists($file_name_in_dir)) {
// Delete file from directory
            if(unlink($file_name_in_dir)){
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
        $_SESSION["message"] = "Cannot delete file from db.";
        redirect_to("index.php");
    }

} else {
    redirect_to("index.php");
}