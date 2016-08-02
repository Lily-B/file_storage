<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");

if(isset($_GET['id'])){
    $file = find_file_by_id($_GET['id']);
    $file_name = $file["name"];
    // Full file name in directory
    $file_name_in_dir = $file["name_in_dir"];
    $extension = get_file_extension($file_name);
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
    if (file_exists($file_name_in_dir)) {
        header('Content-Type: '.$ctype.'; charset=utf-8');
        header("Content-Disposition: attachment; filename=".$file_name);
        ob_clean();
        readfile(realpath($file_name_in_dir));
        exit();
    }
} else {
    redirect_to("index.php");
}







