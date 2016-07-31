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



</main>

<?php include("../includes/layouts/footer.php"); ?>

