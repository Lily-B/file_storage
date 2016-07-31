<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>


<main>

			<p>Welcome!</p>
	<br />
<form name="upload" onsubmit="return is_valid_form();"
	  action="upload.php" enctype="multipart/form-data" method="post">
	<input type="file" id="upload_file" name="upload_file">
	<input type="submit" name="submit" value="Upload">
</form>

<?php echo session_message(); ?>

<?php
// Check if table 'uploaded_files' exists id DB
	if(!table_exists_in_db("uploaded_files")){create_new_table("uploaded_files");}
	if (!table_is_empty("uploaded_files")){
    echo table_files_in_storage();}
?>


</main>

<?php include("../includes/layouts/footer.php"); ?>
