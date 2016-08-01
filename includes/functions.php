<?php
// Redirect to new location
function redirect_to($new_location){
    header("Location: " . $new_location);
    exit;
}

// Prepare string for MySQL query
function mysql_prep($string){
    global $connection;
    $prep_string = mysqli_real_escape_string($connection, $string);
    return $prep_string;
}

// Check if the table exists in database
function table_exists_in_db ($table_name){
    global $connection;

    $query = "SHOW TABLES";
    $table_list = mysqli_query($connection, $query);
    while ($table_in_db = mysqli_fetch_row($table_list)) {
        if ($table_name==$table_in_db[0]) {
            return true;
        }
    }
    return false;
}

// Create new table for uploaded files (name and size)
function create_new_table($table_name){
    global $connection;
    $query = "CREATE TABLE " . $table_name . " (";
    $query .= "id INT(11) NOT NULL AUTO_INCREMENT, ";
    $query .= "name VARCHAR(255) NOT NULL, ";
    $query .= "size INT(9) NOT NULL, ";
    $query .= "PRIMARY KEY (id) )";
    $result = mysqli_query($connection, $query);
    if ($result) {
        return "Table " . $table_name . " created";
    }else{
        return "Table creation failed";
    }
}

// Check to see if the table is empty
function table_is_empty($table_name){
    global $connection;
    $query = "SELECT * FROM " . $table_name;
    $result = mysqli_query($connection, $query);
    $number_of_rows = mysqli_num_rows($result);
    if ($number_of_rows>0) {
        return false;
    }else{
        return true;
    }
}

// Returns HTML table of uploaded files
function table_files_in_storage(){

    $files_set = find_all_files();

    $table = "<table>";
    $table .= "<tr>";
    $table .= "<th>File Name</th><th>Size</th><td>&nbsp;</td>";
    $table .= "</tr>";
    while ($file = mysqli_fetch_assoc($files_set)){
        $table .= "<tr>";
          $table .= "<td>".htmlentities($file["name"])."</td>";
          $table .= "<td>".htmlentities($file["size"])."</td>";
          $table .= "<td><a class='delete' href='delete.php?id=".urlencode($file["id"])."'></a>
                         <a class='download' href='download.php?id=".urlencode($file["id"])."'></a></td>";
        $table .= "</tr>";
    }
    $table .= "</table>";

    return $table;
}

// Returns set of uploaded files
function find_all_files() {
    global $connection;

    $query = "SELECT id, name, size ";
    $query .= "FROM uploaded_files ";
    $query .= "ORDER BY id DESC";
    $files_set = mysqli_query($connection, $query);
    confirm_query($files_set);
    return $files_set;
}

function confirm_query($result_set){
    if (!$result_set){
            die("Database query failed.");
    }
}

// Returns file name from database by file ID
function find_file_name_by_id($file_id){
    global $connection;

    $safe_file_id = mysqli_real_escape_string($connection, $file_id);

    $query = "SELECT name ";
    $query .= "FROM uploaded_files ";
    $query .= "WHERE id = {$safe_file_id} ";
    $query .= "LIMIT 1";
    $file_set = mysqli_query($connection, $query);
    confirm_query($file_set);
    if ($file = mysqli_fetch_assoc($file_set)){
        return $file["name"];
    }else {
        return null;
    }
}
