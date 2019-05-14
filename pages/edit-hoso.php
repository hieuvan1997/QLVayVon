<?php include('../include/connection.php') ?>

<?php
if (isset($_POST['save-hs'])) {
	$ma = mysqli_real_escape_string($con, $_POST['ma']);
	$ten = mysqli_real_escape_string($con, $_POST['ten']);
	$diachi = mysqli_real_escape_string($con, $_POST['diachi']);
	$nghenghiep = mysqli_real_escape_string($con, $_POST['nghenghiep']);
	$gioitinh = mysqli_real_escape_string($con, $_POST['gioitinh']);
	$mucthunhap = mysqli_real_escape_string($con, $_POST['mucthunhap']);
	$mucdenghivay = mysqli_real_escape_string($con, $_POST['mucdenghivay']);
	$mucdich = mysqli_real_escape_string($con, $_POST['mucdich']);
	$mucvayduocduyet = mysqli_real_escape_string($con, $_POST['mucvayduocduyet']);
	$macdcs = mysqli_real_escape_string($con, $_POST['macdcs']);
	$sql = "UPDATE hoso
					SET ten='$ten',diachi='$diachi',nghenghiep='$nghenghiep',gioitinh='$gioitinh',mucthunhap='$mucthunhap',mucdenghivay='$mucdenghivay',mucdich='$mucdich',mucvayduocduyet='$mucvayduocduyet',macdcs='$macdcs'
					 WHERE ma='$ma'";
	mysqli_query($con, $sql);
	header('location: ../data/test2.php');
}

$id = intval($_GET['ma']);
$sql = "SELECT * FROM hoso WHERE ma= '$id'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);
$ten = $data['ten'];
$diachi = $data['diachi'];
$nghenghiep = $data['nghenghiep'];
$gioitinh = $data['gioitinh'];
$mucthunhap = $data['mucthunhap'];
$mucdenghivay = $data['mucdenghivay'];
$mucdich = $data['mucdich'];
$mucvayduocduyet = $data['mucvayduocduyet'];
$macdcs = $data['macdcs'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../dist/css/style.css">
	<title></title>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="../dist/css/style.css">
</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Vay vốn v2.0</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<?php if (!isset($_SESSION['username']) || $SESSION['username'] = '') {
								echo '<a  class="fa fa-user fa-fw" href="http://localhost:81/vayvon/pages/login.php">Đăng nhập</a>';
							}
							if (isset($_SESSION['username'])) : ?>
								<p class="right" style="color: #000000">Chào mừng <?php echo $_SESSION['username']; ?></p>
							<?php endif ?>
							<?php if (isset($_SESSION['username'])) {
								echo '<a class="fa fa-sign-out fa-fw" href="http://localhost:81/vayvon/pages/index.php?id_logout">Đăng xuất</a>';
							} ?>

						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">

						<li>
							<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Trang chủ</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="#"><i class="fa fa-male"></i> Khách hàng<span class="fa arrow"></span></a>
									<ul class="nav nav-second-level">
										<li>
											<a href="test2.php">Khách hàng chờ duyệt</a>
										</li>
										<li>
											<a href="test3.php">Khánh hàng đang vay</a>
										</li>

									</ul>
								</li>
								<li>
									<a href="test1.php">Công đoàn cơ sở</a>
								</li>
								<li>
									<a href="test.php">Công đoàn cấp trên</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-table fa-fw"></i> Tình hình theo dõi<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="v_th_vay_tra_thu.php">Bảng tổng hợp gốc vay vốn đã trả còn phải thu</a>
								</li>
								<li>
									<a href="v_tonghop_chi_10.php">Bảng tổng hợp chi 10% lãi</a>
								</li>
								<li>
									<a href="v_tonghop_chi_5.php">Bảng tổng hợp chi 5% lãi</a>
								</li>
								<li>
									<a href="v_bangtonghop.php">Bảng tổng hợp tên người vay</a>
								</li>
								<li>
									<a href="v_tinhlai_theo_nguoi.php">Bảng tính lãi từng tháng theo kỳ</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>

					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
		<div>
			<div id="page-wrapper">
				<div class="row">
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
							</div>
							<!-- /.panel-heading -->
							<div class="header">
								<h2 style="color:orangered">Cảnh báo</h2>
								<h3>Sửa dữ liệu khách hàng: <br><?php echo "$ten"; ?></h3>

								<div class="input-group">
									<h4>Thao tác này có thể làm thay đổi dữ liệu </h4>
								</div>
								<div>
									<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn1">Chấp nhận</button>

									<a href="test2.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Hủy</button></a>

								</div>
							</div>


							<div id="id01" class="modal">

								<form class="modal-content animate" method="post" action="edit-hoso.php">
									<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
									<?php include('../errors.php'); ?>
									<div class="imgcontainer">
										<h2>Sửa dữ liệu khách hàng</h2>
									</div>
									<form method="post" action="edit-hoso.php">
										<?php include('../errors.php'); ?>
										<div>
											<label class="label">Chọn CĐCS:</label>
											<select id="macdcs" name="macdcs" value="<?php echo "$macdcs" ?>">

												<?php
												$sql = "SELECT * FROM cdcs where macdcs=$macdcs";
												$rs = mysqli_query($con, $sql);
												$cdcs = "";
												while ($row = mysqli_fetch_array($rs)) {

													$cdcs .= '<option value="' . $row['macdcs'] . '" readonly>' . $row['ten_cdcs'] . '</option>';
												}

												echo  $cdcs;
												?>


												<?php
												$sql = "SELECT * FROM cdcs ORDER BY tencdcs ASC";
												$rs = mysqli_query($con, $sql);
												$cdcs_list = "";
												while ($row = mysqli_fetch_array($rs)) {

													$cdcs_list .= '<option value="' . $row['macdcs'] . '">' . $row['tencdcs'] . '</option>';
												}

												echo  $cdcs_list;

												?>

											</select>
										</div>
										<div>
											<input type="hidden" name="ma" value="<?php echo $id; ?>">
										</div>
										<div>
											<label class="label">Tên khách hàng:</label>
											<input id="ten" type="text" name="ten" value="<?php echo "$ten" ?>">

											<label id="gt" class="label">Giới tính:</label>
											<select name="gioitinh" id="gioitinh" value="<?php echo "$gioitinh" ?>">
												<option value="<?php echo "$gioitinh" ?>"><?php if ($gioitinh == 0) {
																								echo "Nam";
																							} else {
																								echo "Nữ";
																							} ?></option>
												<option value="0">Nam</option>
												<option value="1">Nữ</option>
											</select>
										</div>
										<div>
											<label class="label">Địa chỉ:</label>
											<input type="text" name="diachi" value="<?php echo $diachi; ?>">
										</div>
										<div>
											<label class="label">Nghề nghiệp:</label>
											<input id="l1" type="text" name="nghenghiep" value="<?php echo "$nghenghiep" ?>">

											<label id="mv" class="label">Mức thu nhập:</label>
											<input id="l3" type="text" name="mucthunhap" value="<?php echo "$mucthunhap" ?>">
										</div>
										<div>
											<label class="label">Mức đề nghị vay:</label>
											<input id="l1" type="text" name="mucdenghivay" value="<?php echo "$mucdenghivay" ?>">
										</div>
										<div>
											<label class="label">Mục đích:</label>
											<input type="text" name="mucdich" value="<?php echo "$mucdich" ?>">
										</div>
										<div>
											<label class="label">Mức vay được duyệt:</label>
											<input id="l1" type="text" name="mucvayduocduyet" value="<?php echo "$mucvayduocduyet" ?>">
										</div>

										<div class="container">
											<button class="btn" type="submit" name="save-hs">Lưu</button>

											<a href="test2.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Hủy</button></a>
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
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->

</body>

</html>