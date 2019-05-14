<?php include "../include/header.php" ?>
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

<body>
<div>


<div id="id01" class="modal">
  
<form class="modal-content animate" method="post" action="test.php">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	<?php include('f:/xampp/htdocs/vayvon/errors.php'); ?>
	<div class="imgcontainer">
	<h2>Nhập dữ liệu công đoàn cấp trên</h2>
</div>
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
		<div class="container">
			<button type="submit" class="btn" name="btn_cdct" >Nhập </button>

      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </button>
		</div>
	
</form>

</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</div>
<?php
 $sql = "SELECT * FROM cdct";
 $query = mysqli_query($con,$sql);
?>

	<div align="center">
      <h2>Danh sách CĐCT</h2>
    </div>
    <div>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;margin-left: 77%; margin-bottom: 3px"><i class="fa fa-plus" style="color: #00CC00" >Thêm mới </i></button>
    </div>
 		<table align="center" class="table">
 			<thead >
 				<tr>
 					<th>STT</th>
 					<th>Tên CĐCT</th>
 					<th>Email</th>
 					<th>Địa chỉ</th>
 					<th>SĐT</th>
 					<th>Hành động</th>
 				</tr>
 			</thead>
 			<tbody>
				 <?php 
				 $stt=0;
				 while ($data=mysqli_fetch_array($query)) {
 					$id=$data['macdct'];
					$stt++;
 				 ?>
 				 <tr>
 				 	<td><?php echo $stt; ?></td>
 				 	<td><?php echo $data['tencdct'] ?></td>
 				 	<td><?php echo $data['email'] ?></td>
 				 	<td><?php echo $data['diachi'] ?></td>
 				 	<td><?php echo $data['sdt'] ?></td>
 				 	<td>
            <button >
 				 		<a href="edit-cdct.php?macdct=<?php echo $id; ?>"?><i class="fa fa-edit" style="color: #FF9900" >edit </i></a>
            </button> |
            <button>
 				 		<a href="delete-cdct.php?macdct=<?php echo $id; ?>"> <i class=" fa fa-trash" style="color: red">delete  </i></a>
            </button>
   
 				 	</td>
 				 </tr>
 				 <?php 
 				 	}
 				  ?>
 			</tbody>
 		</table>

</body>

</html>


