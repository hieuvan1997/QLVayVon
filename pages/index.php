<?php session_start() ?>
<?php
if (isset($_GET['id_logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: http://localhost:81/vayvon/index.php');
}
?>
<?php require_once('../include/connection.php'); ?>
<?php
$sql = "SELECT count(*) tongkhachhang FROM khachhang";
$query = mysqli_query($con, $sql);

$sql1 = "SELECT count(*) tongcdcs FROM cdcs";
$query1 = mysqli_query($con, $sql1);

$sql2 = "SELECT count(*) tongcdct FROM cdct";
$query2 = mysqli_query($con, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản lý vay vốn</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

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
                <a class="navbar-brand" href="index.php">Trang quản trị</a>
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
                                <p style="color: #000000; align:center"><a class="fa fa-user fa-fw"></a>Chào mừng <?php echo $_SESSION['username']; ?></p>
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
                                    <a href="#"><i class="fa fa-male"></i>  Khách hàng<span class="fa arrow"></span></a>
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
                    <h1 class="page-header">Trang quản lý vay vốn của liên đoàn lao động thành phố Hải Phòng</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $stt = 0;
                                        while ($data = mysqli_fetch_array($query)) {
                                            $stt++;

                                            echo $data['tongkhachhang'];
                                        } ?>
                                    </div>
                                    <div>Khách hàng</div>
                                </div>
                            </div>
                        </div>
                        <a href="test3.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $stt = 0;
                                        while ($data = mysqli_fetch_array($query1)) {
                                            $stt++;

                                            echo $data['tongcdcs'];
                                        } ?>
                                    </div>
                                    <div>Công đoàn cơ sở</div>
                                </div>
                            </div>
                        </div>
                        <a href="test1.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $stt = 0;
                                        while ($data = mysqli_fetch_array($query2)) {
                                            $stt++;

                                            echo $data['tongcdct'];
                                        } ?>
                                    </div>
                                    <div>Công đoàn cấp trên</div>
                                </div>
                            </div>
                        </div>
                        <a href="test.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <pre>
        Biết điều tôn trọng người lớn đấy là kính lão đắc thọ
        Đánh 83 mà ra 38 thì đấy là số mày max nhọ
        Nhưng mà thôi không sao tiền thì mất rồi thì không việc gì phải nhăn nhó
        Nếu mà cảm thấy cuộc sống bế tắc hãy bốc cho mình 1 bát họ
        Mày chỉ cần photo cái chứng minh thư và sổ hộ khẩu
        Mang qua tiệm cầm đồ không có vấn đề gì về độ trẩu
        Đọc cái địa chỉ nhà tao cho đàn em qua nhà mày check đã
        Đưa cho mày tờ giấy mày chỉ việc ký là mày có tiền mặt à
        Nếu mà nó có hỏi thì mày cứ bảo là anh Bình giới thiệu
        Bốc cái bát 20 mà mày được cầm về tận 16 triệu
        Đường đường là 1 dân chơi cái gì chứ tiền chứ ko được thiếu
        Mày cứ chơi đồ hiệu kiểu gì mà chẳng có nhiều đứa yêu
        (Mày có hiểu ý anh nói không)
        Bốc bát họ, bốc bát họ đê, bốc bát họ là anh em mình bốc bát họ đê
        Bốc bát họ, bốc bát họ đê, bốc bát họ là anh em mình bốc bát họ đê
        Người người bốc họ, nhà nhà bát họ
        Alo là có tiền chỉ có thể là bốc bát họ
        Bốc bát họ, bốc bát họ đê, bốc bát họ là anh em mình bốc bát họ đê
        Tất cả những bạn trẻ tuổi từ 18 vv... Làm ăn có lỗ hay nếu có bễ thì có bát họ là ân nhân
        Lời nói thân mật cử chỉ ân cần giải ngân nhanh bảo mật thân phận
        Mấy ông làm tiền mà làm lãnh đạo có khi là yêu nước thương dân
        Đặc biệt là chế độ rất ưu tiên chế độ chị em trong ngành
        Giai đoạn khởi nghiệp cần tiền phi lơ trong trắng cho thật ngon lành
        Gặp bé nào ngon canh thì có khả năng là anh em giúp
        Giúp thì phải được hút nói thẳng con mẹ nó thế cho nhanh (Chứ còn gì nữa)
        Thủ tục đơn giản mà không thế chấp tài sản mà nó vẫn được vay tiền
        Có khi phải gọi cho mấy thằng bạn rủ mấy em gái đi bay liền
        Giờ là người có tiền phải nhân cơ hội tranh thủ ăn chơi mà lấy tiếng
        Phải đặt phòng vip karaoke xong là phải gọi cả nhân viên
        Có khả năng nữa bốc thêm cái bát nữa mua I Phone X nhở
        Bốc cái bát to to dư ra để mua thêm xích vàng
        Đóng ngay bộ D&G, mũ Gucci đôi giầy philip vào
        Mấy chị em nhìn thấy mày cẩn thận lại tranh giành chém giết nhau (Ông anh bảo thật đấy)
        </pre>
            <hr>
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

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>