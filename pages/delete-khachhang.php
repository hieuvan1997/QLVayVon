<?php session_start(); ?>
<?php include "../header.php" ?>
<?php include('../include/connection.php') ?>

<?php 

			$id = intval($_GET['makh']);
			$sql = "DELETE FROM khachhang WHERE makh = '$id'";
			$query = mysqli_query($con,$sql);
			header('location: test3.php');
	


 		 ?>

</html>