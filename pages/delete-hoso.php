<?php session_start(); ?>
<?php include "../header.php" ?>
<?php include('../include/connection.php') ?>

<?php 

			$id = intval($_GET['ma']);
			$sql = "DELETE FROM hoso WHERE ma = '$id'";
			$query = mysqli_query($con,$sql);
			header('location: test2.php');
	


 		 ?>

</html>