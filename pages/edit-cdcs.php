<?php include('../include/connection.php') ?>
<?php
if (isset($_POST['save-cdcs'])) {
	$macdcs = mysqli_real_escape_string($con, $_POST['macdcs']);
	$ten_cdcs = mysqli_real_escape_string($con, $_POST['ten_cdcs']);
	$diachi = mysqli_real_escape_string($con, $_POST['diachi']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$sdt = mysqli_real_escape_string($con, $_POST['sdt']);
	$macdct = mysqli_real_escape_string($con, $_POST['macdct']);
	$sql = "UPDATE cdcs SET ten_cdcs='$ten_cdcs',diachi='$diachi',sdt='$sdt',email='$email',macdct='$macdct' WHERE macdcs='$macdcs'";
	mysqli_query($con, $sql);
	header('location: test1.php');
}

$id = intval($_GET['macdcs']);
$sql = "SELECT * FROM cdcs WHERE macdcs = '$id'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);
$ten_cdcs = $data['ten_cdcs'];
$diachi = $data['diachi'];
$email = $data['email'];
$sdt = $data['sdt'];
$macdct = $data['macdct'];
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
								<h3>Sửa dữ liệu CĐCS: <br><?php echo "$ten_cdcs"; ?></h3>

								<div class="input-group">
									<h4>Thao tác này có thể làm thay đổi dữ liệu </h4>
								</div>
								<div>
									<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn1">Chấp nhận</button>

									<a href="test2.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Hủy</button></a>

								</div>
							</div>



							<div id="id01" class="modal">

								<form class="modal-content animate" method="post" action="edit-cdcs.php">
									<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
									<?php include('../errors.php'); ?>
									<div class="imgcontainer">
										<h2>Sửa dữ liệu công đoàn cơ sở</h2>
									</div>
									<form method="post" action="edit-cdcs.php">
										<?php include('../errors.php'); ?>
										<div>
											<label class="label">Chọn CĐCT:</label>
											<select id="macdct" name="macdct" value="<?php echo "$macdct" ?>">
												<?php
												$sql = "SELECT * FROM cdct where macdct=$macdct";
												$rs = mysqli_query($con, $sql);
												$cdct = "";
												while ($row = mysqli_fetch_array($rs)) {

													$cdct .= '<option value="' . $row['macdct'] . '" readonly>' . $row['ten_cdct'] . '</option>';
												}

												echo  $cdct;
												?>

												<?php
												$sql = "SELECT * FROM cdct ORDER BY ten_cdct ASC";
												$rs = mysqli_query($con, $sql);
												$cdct_list = "";
												while ($row = mysqli_fetch_array($rs)) {

													$cdct_list .= '<option value="' . $row['macdct'] . '">' . $row['ten_cdct'] . '</option>';
												}
												echo $cdct_list;

												?>

											</select>
										</div>
										<div>
											<input type="hidden" name="macdcs" value="<?php echo $id; ?>">
										</div>
										<div>
											<label class="label">Tên CĐCS:</label>
											<input type="text" name="ten_cdcs" value="<?php echo "$ten_cdcs" ?>">
										</div>
										<div>
											<label class="label">Địa chỉ:</label>
											<input type="text" name="diachi" value="<?php echo $diachi; ?>">
										</div>
										<div>
											<label class="label">Email:</label>
											<input type="email" name="email" value="<?php echo "$email" ?>">
										</div>
										<div>
											<label class="label">SĐT:</label>
											<input type="text" name="sdt" value="<?php echo "$sdt" ?>">
										</div>

										<div class="container">
											<button class="btn" type="submit" name="save-cdcs">Lưu</button>

											<a href="test1.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Hủy</button></a>
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