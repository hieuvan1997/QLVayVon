<?php session_start() ?>
<?php
if (isset($_GET['id_logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: http://localhost:81/vayvon/index.php');
}
?>
<?php require_once('../include/connection.php');
?>
<?php
if (isset($_POST['save-duyet'])) {
    $ma = mysqli_real_escape_string($con, $_POST['ma']);
    $ten_khachhang = mysqli_real_escape_string($con, $_POST['ten_khachhang']);
    $diachi = mysqli_real_escape_string($con, $_POST['diachi']);
    $nghenghiep = mysqli_real_escape_string($con, $_POST['nghenghiep']);
    $gioitinh = mysqli_real_escape_string($con, $_POST['gioitinh']);
    $mucthunhap = mysqli_real_escape_string($con, $_POST['mucthunhap']);
    $mucdenghivay = mysqli_real_escape_string($con, $_POST['mucdenghivay']);
    $mucdich = mysqli_real_escape_string($con, $_POST['mucdich']);
    $mucvayduocduyet = mysqli_real_escape_string($con, $_POST['mucvayduocduyet']);
    $thoigianvay = mysqli_real_escape_string($con, $_POST['thoigianvay']);
    // $ngayvay= mysqli_real_escape_string($con, $_POST['ngayvay']);
    $macdcs = mysqli_real_escape_string($con, $_POST['macdcs']);
    $sql = "INSERT INTO khachhang (ten_khachhang,diachi,nghenghiep,gioitinh,mucthunhap,mucdenghivay,mucdich,mucvayduocduyet,macdcs,thoigianvay,ngayvay) 
          VALUES('$ten_khachhang', '$diachi','$nghenghiep','$gioitinh','$mucthunhap','$mucdenghivay','$mucdich','$mucvayduocduyet','$macdcs','$thoigianvay',now())";

    // $sql="UPDATE khachhang 
    // 		SET tenkhachhang='$tenkhachhang',diachi='$diachi',nghenghiep='$nghenghiep',gioitinh='$gioitinh',mucthunhap='$mucthunhap',mucdenghivay='$mucdenghivay',mucdich='$mucdich',mucvayduocduyet='$mucvayduocduyet',macdcs='$macdcs',thoigianvay='$thoigianvay',ngayvay=date('d/m/Y')";
    mysqli_query($con, $sql);

    header('location: ../pages/test3.php');

    $sqli = "DELETE FROM hoso WHERE ma = '$ma'";
    $query = mysqli_query($con, $sqli);
}

$id = intval($_GET['ma']);
$sql = "SELECT * FROM hoso WHERE ma = '$id'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);
$ma = $data['ma'];
$ten_khachhang = $data['ten'];
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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản lý vay vốn</title>

    <!-- Bootstrap Core CSS -->
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
                            <h2>Duyệt vay</h2>
                            <h3>Khách hàng: <?php echo "$ten_khachhang"; ?></h3>

                            <div class="input-group">
                                <p>Thao tác này có thể làm thay đổi dữ liệu </p>
                            </div>
                            <div class="input-group">
                                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn">Chấp nhận</button>

                                <a href="test2.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancel">Cancel</button></a>

                            </div>
                        </div>


                        <div id="id01" class="modal">

                            <form class="modal-content animate" method="post" action="duyet-hoso.php">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <?php include('../errors.php'); ?>
                                <div class="imgcontainer">
                                    <h2>Sửa dữ liệu khách hàng</h2>
                                </div>
                                <form method="post" action="duyet-hoso.php">
                                    <?php include('../errors.php'); ?>

                                    <div>
                                        <div>
                                            <label class="label">Mã hồ sơ:</label>
                                            <input id="l2" type="text" name="ma" value="<?php echo "$ma" ?>" readonly>
                                        </div>
                                        <div>
                                            <label class="label">Chọn đơn vị công tác:</label>
                                            <select id="macdcs" name="macdcs" value="<?php echo "$macdcs" ?>" readonly>
                                                <?php
                                                $sql = "SELECT * FROM cdcs where macdcs=$macdcs";
                                                $rs = mysqli_query($con, $sql);
                                                $cdcs = "";
                                                while ($row = mysqli_fetch_array($rs)) {

                                                    $cdcs .= '<option value="' . $row['macdcs'] . '" readonly>' . $row['ten_cdcs'] . '</option>';
                                                }

                                                echo  $cdcs;
                                                ?>


                                            </select>
                                        </div>

                                        <div>
                                            <label class="label">Tên khách hàng:</label>
                                            <input id="ten" type="text" name="ten_khachhang" value="<?php echo "$ten_khachhang" ?>" readonly>

                                            <label id="gt" class="label">Giới tính:</label>
                                            <select name="gioitinh" id="gioitinh" value="<?php echo "$gioitinh" ?>">
                                                <option value="<?php echo "$gioitinh" ?>"><?php if ($gioitinh == 0) {
                                                                                                echo "Nam";
                                                                                            } else {
                                                                                                echo "Nữ";
                                                                                            } ?></option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="label">Địa chỉ:</label>
                                            <input type="text" name="diachi" value="<?php echo "$diachi" ?>" readonly>
                                        </div>
                                        <div>
                                            <label class="label">Nghề nghiệp:</label>
                                            <input id="l1" type="text" name="nghenghiep" value="<?php echo "$nghenghiep" ?>" readonly>

                                            <label id="mv" class="label">Mức thu nhập:</label>
                                            <input id="l3" type="text" name="mucthunhap" value="<?php echo "$mucthunhap" ?>" readonly>
                                        </div>
                                        <div>
                                            <label class="label">Mức đề nghị vay:</label>
                                            <input id="l1" type="text" name="mucdenghivay" value="<?php echo "$mucdenghivay" ?>" readonly>
                                        </div>
                                        <div>
                                            <label class="label">Mục đích:</label>
                                            <input type="text" name="mucdich" value="<?php echo "$mucdich" ?>">
                                        </div>
                                        <div>
                                            <label class="label">Mức vay được duyệt:</label>
                                            <input id="l1" type="text" name="mucvayduocduyet" required>

                                            <label id="mv" class="label">Số tháng vay:</label>
                                            <input id="l3" type="text" name="thoigianvay" required>
                                        </div>
                                        <div>
                                            <label class="label">Ngày bắt đầu vay:</label>
                                                <input id="l1" type="text" name="ngayvay" value="<?php echo  date('d/m/Y') ?>">
                                        </div>

                                        <div class="container">
                                            <button class="btn" type="submit" name="save-duyet">Lưu</button>

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
                                    url: "../pages/test3.php";
                                }

                            }
                        </script>
                        <!-- /.table-responsive -->
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

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>