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
$ten = "";
$diachi    = "";
$nghenghiep    = "";
$gioitinh    = "";
$diachi    = "";
$mucthunhap    = "";
$macdcs    = "";

if (isset($_POST['action']) == "them") {
    $ten = mysqli_real_escape_string($con, $_POST['ten']);
    $diachi = mysqli_real_escape_string($con, $_POST['diachi']);
    $nghenghiep = mysqli_real_escape_string($con, $_POST['nghenghiep']);
    $gioitinh = mysqli_real_escape_string($con, $_POST['gioitinh']);
    $mucthunhap = mysqli_real_escape_string($con, $_POST['mucthunhap']);
    $mucdenghivay = mysqli_real_escape_string($con, $_POST['mucdenghivay']);
    $mucdich = mysqli_real_escape_string($con, $_POST['mucdich']);
    $mucvayduocduyet = mysqli_real_escape_string($con, $_POST['mucvayduocduyet']);
    $macdcs = mysqli_real_escape_string($con, $_POST['macdcs']);

    if (empty($ten)) {
        array_push($errors, "<script type='text/javascript'>alert('Bạn chưa nhập tên khách hàng!');</script>");
    }

    $user_check_query = "SELECT * FROM hoso WHERE ten='$ten' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        if (
            $user['ten'] === $ten and $user['diachi'] === $diachi and $user['nghenghiep'] === $nghenghiep and
            $user['gioitinh'] === $gioitinh and $user['mucthunhap'] === $mucthunhap and $user['macdcs'] === $macdcs
        ) {
            array_push($errors, "<script type='text/javascript'>alert('Khách hàng này đã tồn tại!');</script>");
        }
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO hoso(ten,diachi,nghenghiep,gioitinh,mucthunhap,mucdenghivay,mucdich,mucvayduocduyet,macdcs) 
            VALUES('$ten', '$diachi','$nghenghiep','$gioitinh','$mucthunhap','$mucdenghivay','$mucdich','$mucvayduocduyet','$macdcs')";
        mysqli_query($con, $query);
        while ($data = mysqli_fetch_array($result)) {
            $_SESSION["ma"] = $data["ma"];
            $_SESSION['ten'] = $data["ten"];
            $_SESSION["diachi"] = $data["diachi"];
            $_SESSION["nghenghiep"] = $data["nghenghiep"];
            $_SESSION["gioitinh"] = $data["gioitinh"];
            $_SESSION["mucthunhap"] = $data["mucthunhap"];
            $_SESSION["mucdenghivay"] = $data["mucdenghivay"];
            $_SESSION["mucdich"] = $data["mucdich"];
            $_SESSION["mucvayduocduyet"] = $data["mucvayduocduyet"];
            $_SESSION["macdcs"] = $data["macdcs"];
        }
        $_SESSION['success'] = "Bạn đã nhập dữ liệu thành công!";
    }
}
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
                            <div align="center">
                                <h2>Danh sách khách hàng đang chờ duyệt vay</h2>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>

                                <div id="id01" class="modal">

                                    <form class="modal-content animate" method="post" action="test2.php" id="sample_formkh">
                                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                        <?php include('../errors.php'); ?>
                                        <div class="imgcontainer">
                                            <h2>Nhập dữ liệu khách hàng</h2>
                                        </div>
                                        <div>
                                            <label class="label">Chọn đơn vị công tác:</label>
                                            <select id="macdcs" name="macdcs" value="<?php echo "$macdcs" ?>">
                                                <?php
                                                $sql = "SELECT * FROM cdcs ORDER BY ten_cdcs ASC";
                                                $rs = mysqli_query($con, $sql);
                                                $cdcs_list = "";
                                                while ($row = mysqli_fetch_array($rs)) {

                                                    $cdcs_list .= '<option value="' . $row['macdcs'] . '">' . $row['ten_cdcs'] . '</option>';
                                                }
                                                echo $cdcs_list;

                                                ?>

                                            </select>
                                        </div>
                                        <div>

                                            <label class="label">Tên khách hàng:</label>
                                            <input id="ten" type="text" name="ten" value="<?php echo "$ten" ?>" required>

                                            <label id="gt" class="label">Giới tính:</label>
                                            <select name="gioitinh" id="gioitinh">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>

                                            <div>
                                                <label class="label">Địa chỉ:</label>
                                                <input type="text" name="diachi" required>
                                            </div>
                                            <div>
                                                <label class="label">Nghề nghiệp:</label>
                                                <input id="l1" type="text" name="nghenghiep" required>

                                                <label id="mv" class="label">Mức thu nhập:</label>
                                                <input id="l3" type="text" name="mucthunhap" required>
                                            </div>
                                            <div>
                                                <label class="label">Mức đề nghị vay:</label>
                                                <input id="l1" type="text" name="mucdenghivay" required>
                                            </div>
                                            <div>
                                                <label class="label">Mục đích:</label>
                                                <input type="text" name="mucdich" required>
                                            </div>
                                            <div>
                                                <label class="label">Mức vay được duyệt:</label>
                                                <input id="l1" type="text" name="mucvayduocduyet" readonly>
                                            </div>
                                        </div>

                                        <div>
                                            <input type="hidden" name="action" id="action" value="them" />
                                            <input type="submit" name="Save" id="savekh" class="btn btn-success" value="Lưu" />

                                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Hủy</button>
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
                            $sql = "SELECT * FROM hoso";
                            $query = mysqli_query($con, $sql);
                            ?>


                            <div>
                                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;margin-left: 85%;margin-bottom: 3px "><i class="fa fa-plus" style="color: #00CC00">Thêm mới </i></button>
                            </div>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>Đơn vị công tác </th>
                                        <th>Nghề nghiệp</th>
                                        <th>Giới tính</th>
                                        <th>Mức thu nhập </th>
                                        <th>Mức đề nghị vay </th>
                                        <th>Mục đích </th>
                                        <th>Mức vay được duyệt </th>
                                        <th>Hành động</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_array($query)) {
                                        $id = $data['ma'];

                                        ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $data['ten'] ?></td>
                                            <td><?php echo $data['diachi'] ?></td>
                                            <td><?php
                                                $ten = $data['macdcs'];
                                                $sql = "SELECT * FROM cdcs where macdcs='$ten'";
                                                $rs = mysqli_query($con, $sql);
                                                $cdcs = "";
                                                while ($row = mysqli_fetch_array($rs)) {

                                                    $cdcs = $row['ten_cdcs'];
                                                }
                                                echo  $cdcs;

                                                ?></td>
                                            <td><?php echo $data['nghenghiep'] ?></td>
                                            <td><?php if (($data['gioitinh']) == 0) {
                                                    echo "Nam";
                                                } else echo "Nữ"; ?></td>
                                            <td><?php echo $data['mucthunhap'] ?></td>
                                            <td><?php echo $data['mucdenghivay'] ?></td>
                                            <td><?php echo $data['mucdich'] ?></td>
                                            <td><?php echo $data['mucvayduocduyet'] ?></td>

                                            <td>
                                                <button>
                                                    <a href="edit-hoso.php?ma=<?php echo $id; ?>"><i class="fa fa-edit" style="color: #FF9900">Sửa </i></a>
                                                </button>
                                                <button>
                                                    <a href="delete-hoso.php?ma=<?php echo $id; ?>"> <i class=" fa fa-trash" style="color: red">Xóa </i></a>
                                                </button>



                                            </td>

                                            <td>
                                                <button>
                                                    <a href="duyet-hoso.php?ma=<?php echo $id; ?>"> <i class=" fa fa-check-square-o" style="color: blue">duyệt </i></a>
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
    $(document).ready(function() {

        $('#macdcs').editableSelect();

        $('#sample_formkh').on('hidden', function(event) {
            event.preventDefault();
            if ($('#macdcs option:select').val() == '') {
                alert("Chọn CĐCs");
                return false;
            } else {
                $.ajax({
                    url: "test2.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        alert(data);
                        $('#sample_formkh')[0].reset();
                    }
                });
            }
        });


    });
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