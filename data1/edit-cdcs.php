<?php include "../include/header.php" ?>
<?php include('../include/connection.php') ?>
<?php 
		if (isset($_POST['save-cdcs'])) {
			$macdcs=mysqli_real_escape_string($con, $_POST['macdcs']);
			$tencdcs=mysqli_real_escape_string($con, $_POST['tencdcs']);
			$diachi=mysqli_real_escape_string($con, $_POST['diachi']);
			$email=mysqli_real_escape_string($con, $_POST['email']);
			$sdt=mysqli_real_escape_string($con, $_POST['sdt']);
			$macdct =mysqli_real_escape_string($con,$_POST['macdct']);
			$sql="UPDATE cdcs SET tencdcs='$tencdcs',diachi='$diachi',sdt='$sdt',email='$email',macdct='$macdct' WHERE macdcs='$macdcs'";
			mysqli_query($con,$sql);
			header('location: ../data/insert-cdcs.php');
		}

		$id=intval($_GET['macdcs']);
		$sql = "SELECT * FROM cdcs WHERE macdcs = '$id'";
		$query=mysqli_query($con,$sql);
		$data=mysqli_fetch_array($query);
			$tencdcs=$data['tencdcs'];
			$diachi=$data['diachi'];
			$email=$data['email'];
			$sdt=$data['sdt'];
			$macdct=$data['macdct'];
	 ?>


<div>

	<div  class="header">
      <h2>Cảnh báo</h2>
   
    <div class="input-group">
      <p>Thao tác này có thể làm thay đổi dữ liệu </p>
    </div>
    <div class="input-group">
		<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn">Chấp nhận</button>

      <a href="test1.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Cancel</button></a>
    
	</div>
 </div>


<div id="id01" class="modal">
  
<form class="modal-content animate" method="post" action="edit-cdcs.php">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
	<?php include('../errors.php'); ?>
	<div class="imgcontainer">
	<h2>Sửa dữ liệu công đoàn cơ sở</h2>
</div>
<form method="post" action="edit-cdcs.php">
	<?php include('../errors.php'); ?>
	<div>
		<label>Chọn CĐCT:</label>
		<select id="macdct" name="macdct" value="<?php echo "$macdct" ?>">
			<?php 
			$sql = "SELECT * FROM cdct ORDER BY tencdct ASC";
			 $rs = mysqli_query($con, $sql);
			 $cdct_list="";
				while ($row = mysqli_fetch_array($rs)) {
			
				$cdct_list.='<option value="'.$row['macdct'].'">'.$row['tencdct'].'</option>';
			 } 
				echo $cdct_list;

			 ?>
				
		</select>
	</div>
	<div>
		<input type="hidden" name="macdcs" value="<?php echo $id; ?>">
	</div>
	<div> 
		<label>Tên CĐCS:</label>
		<input type="text" name="tencdcs"  value="<?php echo "$tencdcs" ?>">
	</div>
	<div>
		<label>Địa chỉ:</label>
		<input type="text" name="diachi" value="<?php echo $diachi; ?>">
	</div>
	<div>
		<label>Email:</label>
		<input type="email" name="email" value="<?php echo "$email" ?>">
	</div>
	<div>
		<label>SĐT:</label>
		<input type="text" name="sdt" value="<?php echo "$sdt" ?>">
	</div>
	
		<div class="container">
			<button class="btn" type="submit" name="save-cdcs"  >Save</button>

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
        url: "test1.php";
    }
    
}
</script>


</html>