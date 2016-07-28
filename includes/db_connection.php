<?php
define("DB_SERVER", "localhost");
define("DB_USER", "storage_user");
define("DB_PASS", "4WxVU2qwPx5Eustw");
define("DB_NAME", "file_storage");

//Create a database connection

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

//Test if connection occurred.
if (mysqli_connect_errno()){
    die ("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ") "
    );
}
