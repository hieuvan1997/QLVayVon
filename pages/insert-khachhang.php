<?php include "../header.php" ?>
<?php include('../include/connection.php') ?>
<?php 
if (isset($_POST['action'])=="them") {
	  $tenkhachhang = mysqli_real_escape_string($con, $_POST['tenkhachhang']);
	  $diachi = mysqli_real_escape_string($con,$_POST['diachi']);
	  $nghenghiep = mysqli_real_escape_string($con, $_POST['nghenghiep']);
	  $gioitinh= mysqli_real_escape_string($con, $_POST['gioitinh']);
	  $mucthunhap= mysqli_real_escape_string($con, $_POST['mucthunhap']);
	  $mucdenghivay= mysqli_real_escape_string($con, $_POST['mucdenghivay']);
	  $mucdich= mysqli_real_escape_string($con, $_POST['mucdich']);
	  $mucvayduocduyet= mysqli_real_escape_string($con, $_POST['mucvayduocduyet']);
	  $macdcs =mysqli_real_escape_string($con,$_POST['macdcs']);

	   if (empty($tenkhachhang)) { array_push($errors, "Bạn chưa nhập tên khách hàng"); }

	   $user_check_query = "SELECT * FROM khachhang WHERE tenkhachhang='$tenkhachhang' LIMIT 1";
	  $result = mysqli_query($con, $user_check_query);
	  if (count($errors) == 0) {
	  	$query = "INSERT INTO khachhang(tenkhachhang,diachi,nghenghiep,gioitinh,mucthunhap,mucdenghivay,mucdich,mucvayduocduyet,macdcs) 
	  			  VALUES('$tenkhachhang', '$diachi','$nghenghiep','$gioitinh','$mucthunhap','$mucdenghivay','$mucdich','$mucvayduocduyet','$macdcs')";
	  	mysqli_query($con, $query);
	  	while ( $data = mysqli_fetch_array($result) ) {
	       $_SESSION["makh"] = $data["makh"];
	       $_SESSION['tenkhachhang'] = $data["tenkhachhang"];
	       $_SESSION["diachi"] = $data["diachi"];
	       $_SESSION["nghenghiep"] = $data["nghenghiep"];
	       $_SESSION["gioitinh"] = $data["gioitinh"];
	       $_SESSION["gioitinh"] = $data["mucthunhap"];
	       $_SESSION["gioitinh"] = $data["mucdenghivay"];
	       $_SESSION["gioitinh"] = $data["mucdich"];
	       $_SESSION["gioitinh"] = $data["mucvayduocduyet"];
	       $_SESSION["macdcs"] = $data["macdcs"];
	      }
	  	$_SESSION['success'] = "Bạn đã nhập dữ liệu thành công!";
	}
}
 	 
?>

<div>
	<h2>Nhập dữ liệu khách hàng</h2>
</div>
<form method="post" action="insert-khachhang.php" id= "sample_formkh">
	<!-- <?php include('../form/errors.php'); ?> -->
	<div> 
		<label>Nhập tên khách hàng:</label>
		<input type="text" name="tenkhachhang"  value="">
	</div>
	<div>
		<label>Nhập địa chỉ:</label>
		<input type="text" name="diachi">
	</div>
	<div>
		<label>Nhập nghề nghiệp:</label>
		<input type="text" name="nghenghiep">
	</div>
	<div>
		<label>Giới tính:</label>
		<select name="gioitinh" id="gioitinh">
			<option value="0">Nam</option>
			<option value="1">Nữ</option>
		</select>
	</div>
	<div>
		<label>Mức thu nhập:</label>
		<input type="text" name="mucthunhap">
	</div>
	<div>
		<label>Mức đề nghị vay:</label>
		<input type="text" name="mucdenghivay">
	</div>
	<div>
		<label>Mục đích:</label>
		<input type="text" name="mucdich">
	</div>
	<div>
		<label>Mức vay được duyệt:</label>
		<input type="text" name="mucvayduocduyet">
	</div>
	<div>
		<label>Chọn đơn vị công tác:</label>
		<select id="macdcs" name="macdcs">
			<?php 
			$sql = "SELECT * FROM cdcs ORDER BY tencdcs ASC";
			 $rs = mysqli_query($con, $sql);
			 $cdcs_list="";
				while ($row = mysqli_fetch_array($rs)) {
			
				$cdcs_list.='<option value="'.$row['macdcs'].'">'.$row['tencdcs'].'</option>';
			 } 
				echo $cdcs_list;

			 ?>
				
		</select>
	</div>
	<div>
		<input type="hidden" name="action" id="action" value="them" />
		<input type="submit" name="Save" id="savekh" class="btn btn-success" value="Save" />
	</div>
		
</form>

<?php
 $sql = "SELECT * FROM khachhang";
 $query = mysqli_query($con,$sql);
?>

	<div align="center">
      <h2>Danh sách </h2>
    </div>
 		<table align="center">
 			<thead >
 				<tr>
 					<th>ID</th>
 					<th>Tên khách hàng</th>
 					<th>Địa chỉ</th>
 					<th>Nghề nghiệp</th>
 					<th>Giới tính</th>
 					<th>Mức thu nhập </th>
 					<th>Mức đề nghị vay </th>
 					<th>Mục đích </th>
 					<th>Mức vay được duyệt </th>
 					<th>Đơn vị công tác </th>
 					<th>Hành động</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php while ($data=mysqli_fetch_array($query)) {
 					$id=$data['makh'];

 				 ?>
 				 <tr>
 				 	<td><?php echo $id ?></td>
 				 	<td><?php echo $data['tenkhachhang'] ?></td>
 				 	<td><?php echo $data['diachi'] ?></td>
 				 	<td><?php echo $data['nghenghiep'] ?></td>
 				 	<td><?php echo $data['gioitinh'] ?></td>
 				 	<td><?php echo $data['mucthunhap'] ?></td>
 				 	<td><?php echo $data['mucdenghivay'] ?></td>
 				 	<td><?php echo $data['mucdich'] ?></td>
 				 	<td><?php echo $data['mucvayduocduyet'] ?></td>
 				 	<td><?php echo $data['macdcs'] ?></td>
 				 	<td>
 				 		<a href="edit-khachhang.php?makh=<?php echo $id; ?>">sua</a> |
 				 		<a href="delete-khachhang.php?makh=<?php echo $id; ?>">xoa</a>
 				 	</td>
 				 </tr>
 				 <?php 
 				 	}
 				  ?>
 			</tbody>
 		</table>
</html>
<script type="text/javascript">
	
		$(document).ready(function(){
	
		$('#macdcs').editableSelect();

		$('#sample_formkh').on('hidden', function(event){
			event.preventDefault();
			if ($('#macdcs option:select').val()=='') {
				alert("Chọn CĐCs");
				return false;
			}
			else {
				$.ajax({
					url:"insert-khachhang.php",
					method:"POST",
					data:$(this).serialize(),
					success: function(data){
						alert(data);
						$('#sample_formkh')[0].reset();
					}
				});
			}
		});


	});
</script>
