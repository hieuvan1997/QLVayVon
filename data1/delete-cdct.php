<?php session_start(); ?>
<?php include "../header.php" ?>
<?php include('../include/connection.php') ?>

<?php 

			$id = intval($_GET['macdct']);
			$sql = "DELETE FROM cdct WHERE macdct = '$id'";
			$query = mysqli_query($con,$sql);
			header('location: test.php');
	


 		 ?>

</html>