<?php
session_start();
require("../inc/config.php");
if (isset($_SESSION['user_id'])) {
    require("head.php");
    require("menu.php");
    $phim = mysqli_num_rows(mysqli_query($Nhan_connect, "SELECT `id` FROM phim"));
    $tap = mysqli_num_rows(mysqli_query($Nhan_connect, "SELECT `id` FROM tap"));
    $taikhoan = mysqli_num_rows(mysqli_query($Nhan_connect, "SELECT `id` FROM taikhoan"));
    ?>

    <div class="br-mainpanel" style="position: relative;">
        <div class="pd-30">

        </div>
        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-teal rounded overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-13 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Tổng số
                                    phim</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $phim ?></p>

                            </div>
                        </div>
                    </div>
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                    <div class="bg-danger rounded overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-13 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Tổng số
                                    tập</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $tap ?></p>

                            </div>
                        </div>
                    </div>
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="bg-primary rounded overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-13 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Số người
                                    dùng</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $taikhoan ?></p>

                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">-->
                <!--                    <div class="bg-br-primary rounded overflow-hidden">-->
                <!--                        <div class="pd-25 d-flex align-items-center">-->
                <!--                            <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>-->
                <!--                            <div class="mg-l-20">-->
                <!--                                <p class="tx-13 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Bounce-->
                <!--                                    Rate</p>-->
                <!--                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">32.16%</p>-->
                <!--                                <span class="tx-11 tx-roboto tx-white-6">65.45% on average time</span>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>

            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card bd-0 shadow-base pd-30 mg-t-20">
                        <div class="d-flex align-items-center justify-content-between mg-b-30">
                            <div>
                                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Phim mới cập
                                    nhật</h6>
                            </div>
                        </div><!-- d-flex -->

                        <table class="table table-valign-middle mg-b-0">
                            <tbody>
                            <?php
                            $result = mysqli_query($Nhan_connect, "SELECT * FROM phim ORDER BY thoigian DESC limit 0,5");
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>

                                    <td>
                                        <h6 class="tx-inverse tx-14 mg-b-0"><?php echo $row['tenphim']; ?></h6>
                                        <span class="tx-12"><?php echo $row['tenkhac']; ?></span>
                                    </td>
                                    <td><?php echo $row['thoigian']; ?></td>

                                    </tr><?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <?php require("footer.php");
} else { ?>

    <head>
        <!--        <link rel="stylesheet" href="templates/bracket/css/bracket.css">-->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="templates/skin/css/style.css?v=<?php echo time(); ?>">
        <title>Đăng nhập</title>
    </head>

    <?php
    if (isset($_POST['login'])) {
        ob_start();
        include_once("../inc/config.php");
        session_start();

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
            header("Location: index.php");
            exit();
        }

        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $result = mysqli_query($conn, "SELECT * FROM taikhoan WHERE username = '$username' and password = '$password'");

            if ($row = mysqli_fetch_array($result)) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                // Chuyển hướng ngay lập tức mà không cần hiển thị thông báo
                header("Location: index.php");
                exit();
            } else {
                // Lưu thông báo lỗi vào session để hiển thị trong form
                $_SESSION['error'] = "Đù đù ! Sai pass rồi bạn ei !!!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }
    }

// Kiểm tra và hiển thị thông báo lỗi
    $error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['error']); // Xóa thông báo sau khi đã hiển thị

    ?>

    <div class="container-fluid" style="max-width:100%">
        <div class="row no-gutter">
            <div class="col-md-7 d-none d-md-flex bg-image"></div>
            <div class="col-md-5 bg-light form_login_center">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="form_login_admin mx-auto">
                            <img src="https://khothietke.net/wp-content/uploads/2021/03/PNG00487-em-be-cute-chibi-png-3.png"
                                 class="img-fluid"
                                 style="width: 150px; display: block; margin-left: auto; margin-right: auto; margin-bottom: 20px;">
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <input id="username" type="text" placeholder="Tài khoản" autofocus=""
                                           class="form-control rounded-pill border-0 shadow-sm px-4" name="username"
                                           required="">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="password" type="password" placeholder="Mật khẩu"
                                           class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
                                           name="password" required="">
                                </div>
                                <?php if ($error_message): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error_message; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="button_login_submit">
                                    <button id="btn-login" type="submit" name="login"
                                            class="btn btn-info btn-block btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">
                                        Đăng nhập
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php } ?>
<?php require("footer.php"); ?>