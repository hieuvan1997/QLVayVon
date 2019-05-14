
<?php include "../include/header.php" ?>
<?php include('../include/connection.php') ?>
<?php 
		if (isset($_POST['save'])) {
			$macdct=mysqli_real_escape_string($con, $_POST['macdct']);
			$tencdct=mysqli_real_escape_string($con, $_POST['tencdct']);
			$diachi=mysqli_real_escape_string($con, $_POST['diachi']);
			$email=mysqli_real_escape_string($con, $_POST['email']);
			$sdt=mysqli_real_escape_string($con, $_POST['sdt']);
			$sql="UPDATE cdct SET tencdct='$tencdct',diachi='$diachi',sdt='$sdt',email='$email' WHERE macdct='$macdct'";
			mysqli_query($con,$sql);
			header('location: ../data/test.php');
		}

		$id=intval($_GET['macdct']);
		$sql = "SELECT * FROM cdct WHERE macdct = '$id'";
		$query=mysqli_query($con,$sql);
		$data=mysqli_fetch_array($query);
			$tencdct=$data['tencdct'];
			$diachi=$data['diachi'];
			$email=$data['email'];
			$sdt=$data['sdt'];
	 ?>


<div>

	<div  class="header">
      <h2>Cảnh báo</h2>
   
    <div class="input-group">
      <p>Thao tác này có thể làm thay đổi dữ liệu </p>
    </div>
    <div class="input-group">
		<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn">Chấp nhận</button>

      <a href="test.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Cancel</button></a>
    
	</div>
 </div>


<div id="id01" class="modal">
  
<form class="modal-content animate" method="post" action="edit-cdct.php">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
	<?php include('../errors.php'); ?>
	<div class="imgcontainer">
	<h2>Sửa dữ liệu cấp trên</h2>
</div>
	<div>
		<input type="hidden" name="macdct" value="<?php echo $id; ?>">
	</div>
	<div> 
		<label>Tên CĐCT:</label>
		<input type="text" name="tencdct"  value="<?php echo "$tencdct" ?>">
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
			<button class="btn" type="submit" name="save" >Save</button>

      <a href="test.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button></a>
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
        url: "test.php";
    }
    
}
</script>

</html>