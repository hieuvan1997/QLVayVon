<?php session_start() ?>
<?php
if (isset($_GET['id_logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: http://localhost:81/vayvon/index.php');
}
?>
<?php require_once('../include/connection.php');
include '../Classes/PHPExcel/IOFactory.php'; ?>
<?php
$sql = "SELECT* FROM v_tonghop_chi_10";
$query = mysqli_query($con, $sql);

if (isset($_POST['btnExport'])) {
    $objExcel = new PHPExcel;
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('name');
    $rowCount = 1;
    $sheet->setCellValue('A' . $rowCount, 'Tên công đoàn cấp trên');
    $sheet->setCellValue('B' . $rowCount, 'Tổng số công đoàn cơ sở');
    $sheet->setCellValue('C' . $rowCount, 'Số vốn vay');
    $sheet->setCellValue('D' . $rowCount, 'Số tiền lãi thu được');
    $sheet->setCellValue('E' . $rowCount, 'Sô tiền nhận được 10% lãi');

    $sql1 = "SELECT* FROM v_tonghop_chi_10";
    $query1 = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_array($query1)) {
        $rowCount++;
        $sheet->setCellValue('A' . $rowCount, $row['ten_cdct']);
        $sheet->setCellValue('B' . $rowCount, $row['tongcdcs']);
        $sheet->setCellValue('C' . $rowCount, $row['tongsovonvay']);
        $sheet->setCellValue('D' . $rowCount, $row['tongsotienlaithuduoc']);
        $sheet->setCellValue('E' . $rowCount, $row['sotiennhanduoc']);
    }
    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'kokomi.xlsx';
    $objWriter->save($filename);
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
    return;
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
                <div class="col-lg-12">
                    <h1 style="text-align: center" class="page-header">Bảng tổng hợp chi 10% lãi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form method="POST">
                                <button name="btnExport" type="submit">Tải dữ liệu</button>
                            </form>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên CDCT</th>
                                        <th>Tổng số CDCS</th>
                                        <th>Tổng số vốn vay</th>
                                        <th>Số tiền lãi thu được</th>
                                        <th>Số tiền nhận được 10% lãi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 0;
                                    while ($data = mysqli_fetch_array($query)) {
                                        $stt++;
                                        ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $stt; ?></td>
                                            <td><?php echo $data['ten_cdct']; ?></td>
                                            <td><?php echo $data['tongcdcs']; ?></td>
                                            <td><?php echo $data['tongsovonvay']; ?></td>
                                            <td><?php echo $data['tongsotienlaithuduoc']; ?></td>
                                            <td><?php echo $data['sotiennhanduoc']; ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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