
<?php include "../form/header.php" ?>
<?php include('../include/connection.php') ?>
<?php 
if (isset($_POST['btn_cdct'])) {
  $tencdct = mysqli_real_escape_string($con, $_POST['tencdct']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $diachi = mysqli_real_escape_string($con,$_POST['diachi']);
  $sdt = mysqli_real_escape_string($con, $_POST['sdt']);
   if (empty($tencdct)) { array_push($errors, "Bạn chưa nhập tên CĐCT"); }

  $user_check_query = "SELECT * FROM cdct WHERE tencdct='$tencdct' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
 if ($user) { // if user exists
    if ($user['tencdct'] === $tencdct) {
      array_push($errors, "CĐCT nay da ton tai!");
    }
  }
  if (count($errors) == 0) {
  	$query = "INSERT INTO cdct (tencdct, email, diachi, sdt) 
  			  VALUES('$tencdct', '$email', '$diachi', '$sdt')";
  	mysqli_query($con, $query);
  	 while ( $data = mysqli_fetch_array($result) ) {
      $_SESSION["macdct"] = $data["macdct"];
      $_SESSION['tencdct'] = $data["tencdct"];
       $_SESSION["diachi"] = $data["diachi"];
       $_SESSION["email"] = $data["email"];
       $_SESSION["sdt"] = $data["sdt"];
      }
  	$_SESSION['success'] = "Bạn đã nhập dữ liệu thành công!";
}
}
?>

<div>
	<h2>Nhập dữ liệu công đoàn cấp trên</h2>
</div>
<form method="post" action="insert-cdct.php">
	<?php include('D:/xampp/htdocs/qlvayvon/form/errors.php'); ?>
	<div> 
		<label>Nhập tên CĐCT:</label>
		<input type="text" name="tencdct"  value="<?php echo "$tencdct" ?>">
	</div>
	<div>
		<label>Nhập địa chỉ:</label>
		<input type="text" name="diachi">
	</div>
	<div>
		<label>Nhập email:</label>
		<input type="email" name="email">
	</div>
	<div>
		<label>Nhập SĐT:</label>
		<input type="text" name="sdt"
	</div>
		<div>
			<button type="submit" class="btn" name="btn_cdct">Nhập</button>
		</div>
</form>
<?php
 $sql = "SELECT * FROM cdct";
 $query = mysqli_query($con,$sql);
?>

	<div align="center">
      <h2>Danh sách CĐCT</h2>
    </div>
 		<table align="center">
 			<thead >
 				<tr>
 					<th>ID</th>
 					<th>Tên CĐCT</th>
 					<th>Email</th>
 					<th>Địa chỉ</th>
 					<th>SĐT</th>
 					<th>Hành động</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php while ($data=mysqli_fetch_array($query)) {
 					$id=$data['macdct'];

 				 ?>
 				 <tr>
 				 	<td><?php echo $id ?></td>
 				 	<td><?php echo $data['tencdct'] ?></td>
 				 	<td><?php echo $data['email'] ?></td>
 				 	<td><?php echo $data['diachi'] ?></td>
 				 	<td><?php echo $data['sdt'] ?></td>
 				 	<td>
 				 		<a href="edit-cdct.php?macdct=<?php echo $id; ?>">sua</a> |
 				 		<a href="delete-cdct.php?macdct=<?php echo $id; ?>">xoa</a>
 				 	</td>
 				 </tr>
 				 <?php 
 				 	}
 				  ?>
 			</tbody>
 		</table>
<?php include "../form/footer.php" ?>