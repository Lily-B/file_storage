<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");

if(isset($_GET['id'])){
    $file_name = find_file_name_by_id($_GET['id']);
    $upload_dir = 'uploads/';
    $full_file_name = $upload_dir.$file_name;
    $extension = strtolower(substr(strrchr($file_name,"."),1));
// Define Content-Type of selected file:
        switch ($extension) {
            case "jpg": $ctype="image/jpg"; break;
            case "jpeg": $ctype="image/jpg"; break;
            case "bmp": $ctype="image/bmp"; break;
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "pdf": $ctype="application/pdf"; break;
            case "doc": $ctype="application/msword"; break;
            case "docx": $ctype="application/msword"; break;
            case "xls": $ctype="application/vnd.ms-excel"; break;
            case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
            case "txt": $ctype="text/plain"; break;
            default: $ctype="application/force-download";
        }
// Download file
    if (file_exists($full_file_name)) {
        header('Content-Type: '.$ctype.'; charset=utf-8');
        header("Content-Disposition: attachment; filename=".$file_name);
        ob_clean();
        readfile(realpath($full_file_name));
        exit();
    }
} else {
    redirect_to("index.php");
}







