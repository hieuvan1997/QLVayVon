<?php include "../include/header.php" ?>
<?php include('../include/connection.php') ?>

<?php 
		if (isset($_POST['save-kh'])) {
			$makh=mysqli_real_escape_string($con, $_POST['makh']);
			$tenkhachhang = mysqli_real_escape_string($con, $_POST['tenkhachhang']);
			  $diachi = mysqli_real_escape_string($con,$_POST['diachi']);
			  $nghenghiep = mysqli_real_escape_string($con, $_POST['nghenghiep']);
			  $gioitinh= mysqli_real_escape_string($con, $_POST['gioitinh']);
			  $mucthunhap= mysqli_real_escape_string($con, $_POST['mucthunhap']);
			  $mucdenghivay= mysqli_real_escape_string($con, $_POST['mucdenghivay']);
			  $mucdich= mysqli_real_escape_string($con, $_POST['mucdich']);
			  $mucvayduocduyet= mysqli_real_escape_string($con, $_POST['mucvayduocduyet']);
			  $macdcs =mysqli_real_escape_string($con,$_POST['macdcs']);
			$sql="UPDATE khachhang 
					SET tenkhachhang='$tenkhachhang',diachi='$diachi',nghenghiep='$nghenghiep',gioitinh='$gioitinh',mucthunhap='$mucthunhap',mucdenghivay='$mucdenghivay',mucdich='$mucdich',mucvayduocduyet='$mucvayduocduyet',macdcs='$macdcs'
					 WHERE makh='$makh'";
			mysqli_query($con,$sql);
			header('location: ../data/insert-khachhang.php');
		}

		$id=intval($_GET['makh']);
		$sql = "SELECT * FROM khachhang WHERE makh = '$id'";
		$query=mysqli_query($con,$sql);
		$data=mysqli_fetch_array($query);
			$tenkhachhang=$data['tenkhachhang'];
			$diachi=$data['diachi'];
			$nghenghiep=$data['nghenghiep'];
			$gioitinh=$data['gioitinh'];
			$mucthunhap=$data['mucthunhap'];
			$mucdenghivay=$data['mucdenghivay'];
			$mucdich=$data['mucdich'];
			$mucvayduocduyet=$data['mucvayduocduyet'];
			$macdcs=$data['macdcs'];
	 ?>



<div>

	<div  class="header">
      <h2>Cảnh báo</h2>
   
    <div class="input-group">
      <p>Thao tác này có thể làm thay đổi dữ liệu </p>
    </div>
    <div class="input-group">
		<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn">Chấp nhận</button>

      <a href="test2.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Cancel</button></a>
    
	</div>
 </div>


<div id="id01" class="modal">
  
<form class="modal-content animate" method="post" action="edit-khachhang.php">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
	<?php include('../errors.php'); ?>
	<div class="imgcontainer">
	<h2>Sửa dữ liệu khách hàng</h2>
</div>
<form method="post" action="edit-khachhang.php">
	<?php include('../errors.php'); ?>
	<div>
		<label>Chọn CĐCS:</label>
		<select id="macdcs" name="macdcs" value="<?php echo "$macdcs" ?>">
			<?php 
			$sql = "SELECT * FROM cdcs ORDER BY tencdcs ASC";
			 $rs = mysqli_query($con, $sql);
			 $cdct_list="";
				while ($row = mysqli_fetch_array($rs)) {
			
				$cdcs_list.='<option value="'.$row['macdct'].'">'.$row['tencdcs'].'</option>';
			 } 
				echo $cdcs_list;

			 ?>
				
		</select>
	</div>
	<div>
		<input type="hidden" name="makh" value="<?php echo $id; ?>">
	</div>
	<div> 
		<label>Tên khách hàng:</label>
		<input type="text" name="tenkhachhang"  value="<?php echo "$tenkhachhang" ?>">
	</div>
	<div>
		<label>Địa chỉ:</label>
		<input type="text" name="diachi" value="<?php echo $diachi; ?>">
	</div>
	<div>
		<label>Nghề nghiệp:</label>
		<input type="text" name="nghenghiep" value="<?php echo "$nghenghiep" ?>">
	</div>
	<div>
		<label>Giới tính:</label>
		<select name="gioitinh" id="gioitinh" value="<?php echo "$gioitinh" ?>">
			<option value="0">Nam</option>
			<option value="1">Nữ</option>
		</select>
	</div>
	<div>
		<label>Mức thu nhập:</label>
		<input type="text" name="mucthunhap" value="<?php echo "$mucthunhap" ?>">
	</div>
	<div>
		<label>Mức đề nghị vay:</label>
		<input type="text" name="mucdenghivay" value="<?php echo "$mucdenghivay" ?>">
	</div>
	<div>
		<label>Mục đích:</label>
		<input type="text" name="mucdich" value="<?php echo "$mucdich" ?>">
	</div>
	<div>
		<label>Mức vay được duyệt:</label>
		<input type="text" name="mucvayduocduyet" value="<?php echo "$mucvayduocduyet" ?>">
	</div>
	
		<div class="container">
			<button class="btn" type="submit" name="save-kh"  >Save</button>

      <a href="test1.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button></a>
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
        url: "test2.php";
    }
    
}
</script>


</html>