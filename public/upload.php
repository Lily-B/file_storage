<?php
require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");


if(isset($_POST['submit'])) {

    // Create a directory for uploaded files
    @mkdir("uploads", 0777);
    //Directory:
    $upload_dir = 'uploads/';
    //Original File name:
    $upload_file_name = $_FILES['upload_file']['name'];
    // for MySQL
    $file_name_in_db = mysql_prep($upload_file_name);
    $file_size_in_db = (int) $_FILES['upload_file']['size'];


    // Process the form
    // Check filesize
    if ($_FILES['upload_file']['size'] > 3000000) {
        $_SESSION["message"] = "File " . $upload_file_name . " is too big.";
        redirect_to("index.php");
    }

    // Copy uploaded file:
    if (copy($_FILES['upload_file']['tmp_name'], $upload_dir . basename($_FILES['upload_file']['name']))) {
        $query = "INSERT INTO uploaded_files (";
        $query .= "name, size";
        $query .= ") VALUES (";
        $query .= "'{$file_name_in_db}', {$file_size_in_db}";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        //Test if there was query error
        if ($result) {
            $_SESSION["message"] = "File " . $upload_file_name . " was uploaded successfully";
            redirect_to("index.php");
        } else {
            $_SESSION["message"] = "Cannot add file in DB";
            redirect_to("index.php");
        }
    } else {
        $_SESSION["message"] = "No file was uploaded";
        redirect_to("index.php");
    }
}else{
    redirect_to("index.php");
}

if (isset($connection)){
    mysqli_close($connection);
}

