<?php session_start(); ?>
<?php include "../header.php" ?>
<?php include('../include/connection.php') ?>

<?php 

			$id = intval($_GET['macdcs']);
			$sql = "DELETE FROM cdcs WHERE macdcs = '$id'";
			$query = mysqli_query($con,$sql);
			header('location: test1.php');
	


 		 ?>

</html>