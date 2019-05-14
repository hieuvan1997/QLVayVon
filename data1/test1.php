<?php include "../include/header.php" ?>
<!-- <?php include('../include/connection.php') ?> -->

<?php 
if (isset($_POST['action'])=="add") {
    $tencdcs = mysqli_real_escape_string($con, $_POST['tencdcs']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $diachi = mysqli_real_escape_string($con,$_POST['diachi']);
    $sdt = mysqli_real_escape_string($con, $_POST['sdt']);
    $macdct =mysqli_real_escape_string($con,$_POST['macdct']);
     if (empty($tencdcs)) { array_push($errors, "Bạn chưa nhập tên CĐCs"); }

    $user_check_query = "SELECT * FROM cdcs WHERE tencdcs='$tencdcs' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);
   if ($user) { // if user exists
      if ($user['tencdcs'] === $tencdcs) {
        array_push($errors, "CĐCS nay da ton tai!");
      }
    }
    if (count($errors) == 0) {
      $query = "INSERT INTO cdcs(tencdcs, email, diachi, sdt,macdct) 
            VALUES('$tencdcs', '$email', '$diachi', '$sdt','$macdct')";
      mysqli_query($con, $query);
      while ( $data = mysqli_fetch_array($result) ) {
         $_SESSION["macdcs"] = $data["macdcs"];
         $_SESSION['tencdcs'] = $data["tencdcs"];
         $_SESSION["diachi"] = $data["diachi"];
         $_SESSION["email"] = $data["email"];
         $_SESSION["sdt"] = $data["sdt"];
         $_SESSION["macdct"] = $data["macdct"];
        }
      $_SESSION['success'] = "Bạn đã nhập dữ liệu thành công!";
  }
}
   
?>

<body>
<div>


<div id="id01" class="modal">
  
<form class="modal-content animate" method="post" action="test1.php">
	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	<?php include('f:/xampp/htdocs/vayvon/errors.php'); ?>
	<div class="imgcontainer">
	<h2>Nhập dữ liệu công đoàn cơ sở</h2>
</div>
<div>
    <label>Chọn CĐCT:</label>
    <select id="macdct" name="macdct">
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
    <label>Nhập tên CĐCS:</label>
    <input type="text" name="tencdcs" value="<?php echo "$tencdcs" ?>">
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

  <div class="container" >
    <input type="hidden" name="action" id="action" value="add">
    <input type="submit" name="Save" id="save" class="btn btn-success" value="Save">

      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
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
 $sql = "SELECT * FROM cdcs";
 $query = mysqli_query($con,$sql);
?>

  <div align="center">
      <h2>Danh sách CĐCS</h2>
    </div>
    <div>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;margin-left: 77%; margin-bottom: 0px"><i class="fa fa-plus" style="color: #00CC00" >Thêm mới </i></button>
    </div>
    <table align="center" class="table">
      <thead >
        <tr>
          <th>STT</th>
          <th>Tên CĐCS</th>
          <th>Email</th>
          <th>Địa chỉ</th>
          <th>SĐT</th>
          <th>Mã CĐCT </th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $stt=0;
        while ($data=mysqli_fetch_array($query)) {
          $id=$data['macdcs'];
          $stt++;
         ?>
         <tr>
          <td><?php echo $stt; ?></td>
          <td><?php echo $data['tencdcs'] ?></td>
          <td><?php echo $data['email'] ?></td>
          <td><?php echo $data['diachi'] ?></td>
          <td><?php echo $data['sdt'] ?></td>
          <td><?php echo $data['macdct'] ?></td>
          <td>
            <button >
            <a  href="edit-cdcs.php?macdcs=<?php echo $id; ?>"><i class="fa fa-edit" style="color: #FF9900" >edit </i></a>
            </button> |
            <button>
            <a href="delete-cdcs.php?macdcs=<?php echo $id; ?>"> <i class=" fa fa-trash" style="color: red">delete  </i></a>
            </button>
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
  
    $('#macdct').editableSelect();

    $('#sample_form').on('submit', function(event){
      event.preventDefault();
      if ($('#macdct option:select').val()=='') {
        alert("Chọn CĐCT");
        return false;
      }
      else {
        $.ajax({
          url:"test1.php",
          method:"POST",
          data:$(this).serialize(),
          success: function(data){
            alert(data);
            $('#sample_form')[0].reset();
          }
        });
      }
    });


  });
</script>


