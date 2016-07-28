<footer>Copyright <?php echo date("Y");?>, File Storage Corp</footer>
</body>
</html>
<?php
// Close database connection
if (isset($connection)){
    mysqli_close($connection);
}
?>