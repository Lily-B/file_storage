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
    $upload_file_extension = get_file_extension($upload_file_name);
    // for MySQL
    $file_name_in_db = mysql_prep($upload_file_name);
    $file_size_in_db = (int) $_FILES['upload_file']['size'];
    $upload_date = date("Y-m-d H:i:s");
// Full file name in directory
    $file_name_in_dir = $upload_dir . microtime().".".$upload_file_extension;


    // Process the form
    // Check filesize
    if ($_FILES['upload_file']['size'] > 3000000) {
        $_SESSION["message"] = "File " . $upload_file_name . " is too big.";
        redirect_to("index.php");
    }

    // Copy uploaded file:
    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $file_name_in_dir )) {
        $query = "INSERT INTO uploaded_files (";
        $query .= "name, size, date, name_in_dir";
        $query .= ") VALUES (";
        $query .= "'{$file_name_in_db}', {$file_size_in_db}, '{$upload_date}', '{$file_name_in_dir}'";
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

