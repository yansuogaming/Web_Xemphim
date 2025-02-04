<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require("menu.php");
    require("head.php");
    $url = $_GET['url'];
    ?>
    <!-- Spinner loading -->
    <div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; height: 100vh; position: fixed; top: 0; left: 0; width: 100%; background-color: rgba(255, 255, 255, 0.9); z-index: 9999;">
        <div>
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
            <p style="text-align: center; font-size: 1.2rem; margin-top: 1rem;">Đang tải, vui lòng chờ...</p>
        </div>
    </div>


    <div class="br-mainpanel">
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <?php
                $sql4 = "SELECT * FROM phim WHERE link = '$url'";
                if ($result1 = mysqli_query($Nhan_connect, $sql4)) {
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row = mysqli_fetch_array($result1)) {
                            ?>
                            <form id="loginForm" method="" action="" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-lg">
                                        <input type="text" class="form-control" id="tenphim" name="tenphim"
                                               value="<?php echo htmlspecialchars($row["tenphim"]); ?>" required=""
                                               placeholder="Vui lòng nhập tên phim">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input type="text" class="form-control" id="tenkhac" name="tenkhac"
                                               value="<?php echo htmlspecialchars($row["tenkhac"]); ?>" required=""
                                               placeholder="Tên tiếng Việt/Tiếng anh của phim">
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <div class="col-lg">
                                        <input type="text" class="form-control" id="tongsotap" name="tongsotap"
                                               value="<?php echo htmlspecialchars($row["tongsotap"]); ?>" required=""
                                               placeholder="Tổng số tập">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input type="text" class="form-control" id="thoiluong" name="thoiluong"
                                               value="<?php echo htmlspecialchars($row["thoiluong"]); ?>" required=""
                                               placeholder="Thời lượng phim">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input type="text" class="form-control" id="link" name="link"
                                               value="<?php echo htmlspecialchars($row["link"]); ?>" readonly
                                               placeholder="Link">
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <div class="col-lg">
                                <textarea rows="5" placeholder="Mô tả phim" class="form-control" id="mota"
                                          name="mota"><?php echo htmlspecialchars($row["mota"]); ?></textarea>
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input type="text" class="form-control" id="thumbnail" name="thumbnail"
                                               value="<?php echo htmlspecialchars($row["thumbnail"]); ?>" required=""
                                               placeholder="Link thumbnail của phim">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                <textarea rows="5" class="form-control" id="tag" name="tag"
                                          placeholder="date a live, date a live season1, cuộc hẹn sống còn,..."><?php echo htmlspecialchars($row["tag"]); ?></textarea>
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <div class="col-lg">
                                        <input type="text" class="form-control" id="namphim" name="namphim"
                                               value="<?php echo htmlspecialchars($row["namphim"]); ?>" required=""
                                               placeholder="Năm phim">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <select id="loaiphim" name="loaiphim" class="form-control" required>
                                            <option value="">-- Chọn Loại Phim --</option>
                                            <?php
                                            // Lấy dữ liệu từ bảng loaiphim
                                            $sql_loaiphim = "SELECT id, ten_loai FROM loaiphim";
                                            $result_loaiphim = mysqli_query($Nhan_connect, $sql_loaiphim);

                                            if ($result_loaiphim && mysqli_num_rows($result_loaiphim) > 0) {
                                                while ($row_loaiphim = mysqli_fetch_assoc($result_loaiphim)) {
                                                    $selected = ($row["loaiphim"] == $row_loaiphim["id"]) ? "selected" : ""; // So sánh ID
                                                    echo '<option value="' . htmlspecialchars($row_loaiphim["id"]) . '" ' . $selected . '>';
                                                    echo htmlspecialchars($row_loaiphim["ten_loai"]);
                                                    echo '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <select class="form-control" id="theloai" name="theloai" required>
                                            <option value="">-- Chọn Thể Loại --</option>
                                            <?php
                                            $result_theloai = mysqli_query($Nhan_connect, "SELECT id, ten_theloai FROM theloai ORDER BY ten_theloai ASC");
                                            if ($result_theloai && mysqli_num_rows($result_theloai) > 0) {
                                                while ($row_theloai = mysqli_fetch_assoc($result_theloai)) {
                                                    $selected = ($row["theloai"] == $row_theloai["id"]) ? "selected" : "";
                                                    echo '<option value="' . htmlspecialchars($row_theloai["id"]) . '" ' . $selected . '>' . htmlspecialchars($row_theloai["ten_theloai"]) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <button class="btn btn-success btn-block" type="button" onclick="EditPhim()">Sửa
                                        phim
                                    </button>
                                </div>
                            </form>
                            <div id="message"></div>

                        <?php }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function EditPhim() {
            var tenphim = $("#tenphim").val();
            var thumbnail = $("#thumbnail").val();
            var mota = $("#mota").val();
            var link = $("#link").val();
            var theloai = $("#theloai").val();
            var namphim = $("#namphim").val();
            var loaiphim = $("#loaiphim").val();
            var tenkhac = $("#tenkhac").val();
            var tag = $("#tag").val();
            var thoiluong = $("#thoiluong").val();
            var tongsotap = $("#tongsotap").val();
            $.ajax({
                type: "POST",
                url: "api.php",
                data: {
                    action: 'EditPhim',
                    tenphim: tenphim,
                    thumbnail: thumbnail,
                    mota: mota,
                    link: link,
                    theloai: theloai,
                    namphim: namphim,
                    loaiphim: loaiphim,
                    tenkhac: tenkhac,
                    tag: tag,
                    thoiluong: thoiluong,
                    tongsotap: tongsotap
                },
                dataType: "JSON",
                success: function (data) {
                    $("#message").html(data);
                    $("p").addClass("alert alert-success");
                },
                error: function (err) {
                    alert(err);
                }
            });
        }
    </script>

    <script>
        // Hiển thị nội dung chính sau khi toàn bộ trang tải xong
        window.onload = function () {
            var spinner = document.getElementById('loading-spinner');
            var mainPanel = document.querySelector('.br-mainpanel');
            if (spinner) {
                spinner.style.display = 'none'; // Ẩn spinner
            }
            if (mainPanel) {
                mainPanel.style.display = 'block'; // Hiển thị nội dung chính
            }
        };
    </script>


    <style>
    #loading-spinner {
        display: flex; /* Hiển thị spinner mặc định */
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        z-index: 9999;
    }

    .br-mainpanel {
        display: none; /* Ẩn nội dung chính mặc định */
    }

</style>
    <?php
} else {
    header('Location: /');
    exit;
}
?>
