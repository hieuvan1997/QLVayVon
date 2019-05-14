<?php 
	$server_username = "root";
	$server_password = "";
	$server_host = "localhost";
	$database = 'qlvayvon';
	$tencdct = "";
	$tencdcs    = "";
	$errors = array(); 

	$con = mysqli_connect($server_host,$server_username,$server_password,$database) or die("Không thể kết nối database");
	mysqli_query($con,"SET NAMES 'UTF8'");
