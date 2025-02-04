<?php
session_start();
if (isset($_SESSION['user_id'])) {
require("head.php");
require("menu.php");
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
            <form id="loginForm" method="" action="" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg">
                        <input type="text" class="form-control" id="tenphim" name="tenphim" value="" required=""
                               placeholder="Vui lòng nhập tên phim" onkeyup="ChangeToSlug();">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input type="text" class="form-control" id="tenkhac" name="tenkhac" value="" required=""
                               placeholder="Tên tiếng Việt/Tiếng Anh của phim">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg">
                        <input type="text" class="form-control" id="tongsotap" name="tongsotap" value="" required=""
                               placeholder="Tổng số tập (số hoặc 'Full')">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input type="text" class="form-control" id="thoiluong" name="thoiluong" value="" required=""
                               placeholder="Thời lượng phim">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input type="text" class="form-control" id="link" name="link" value="" required=""
                               placeholder="Link" readonly>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg">
                        <textarea rows="5" placeholder="Mô tả phim" class="form-control" id="mota" name="mota"></textarea>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input type="text" class="form-control" id="thumbnail" name="thumbnail" value="" required=""
                               placeholder="Link thumbnail của phim">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <textarea rows="5" class="form-control" id="tag" name="tag"
                                  placeholder="date a live, date a live season1, cuộc hẹn sống còn,..."></textarea>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg">
                        <input type="text" class="form-control" id="namphim" name="namphim" value="" required=""
                               placeholder="Năm phim">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <select id="loaiphim" name="loaiphim" class="form-control" required>
                            <option value="">-- Chọn Loại Phim --</option>
                            <?php
                            $sql_loaiphim = "SELECT id, ten_loai FROM loaiphim";
                            $result_loaiphim = mysqli_query($Nhan_connect, $sql_loaiphim);
                            if ($result_loaiphim && mysqli_num_rows($result_loaiphim) > 0) {
                                while ($row_loaiphim = mysqli_fetch_assoc($result_loaiphim)) {
                                    echo '<option value="' . htmlspecialchars($row_loaiphim["id"]) . '">' . htmlspecialchars($row_loaiphim["ten_loai"]) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <select id="theloai" name="theloai" class="form-control" required>
                            <option value="">-- Chọn Thể Loại --</option>
                            <?php
                            $result = mysqli_query($Nhan_connect, "SELECT id, ten_theloai FROM theloai ORDER BY ten_theloai ASC");
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['ten_theloai']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <button class="btn btn-success btn-block" type="button" onclick="ThemPhim()">Thêm phim</button>
                </div>
            </form>
            <div id="message"></div>
        </div>
    </div>
    <script language="javascript">
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("tenphim").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('link').value = slug;
        }
    </script>

    <script>
        function ThemPhim() {
            var theloai = $("#theloai").val();
            var loaiphim = $("#loaiphim").val();
            if (!theloai || !loaiphim) {
                alert("Vui lòng chọn thể loại và loại phim.");
                return;
            }
            var tongsotap = $("#tongsotap").val().trim();

            // Kiểm tra và xử lý tổng số tập
            if (tongsotap.toLowerCase() === "full") {
                tongsotap = "Full"; // Giữ nguyên chữ "Full"
            } else if (!isNaN(tongsotap)) {
                tongsotap = parseInt(tongsotap); // Chuyển thành số nếu là số
            } else {
                alert("Tổng số tập không hợp lệ. Vui lòng nhập số hoặc 'Full'.");
                return;
            }

            $.ajax({
                type: "POST",
                url: "api.php",
                data: {
                    action: 'ThemPhim',
                    tenphim: $("#tenphim").val(),
                    thumbnail: $("#thumbnail").val(),
                    mota: $("#mota").val(),
                    link: $("#link").val(),
                    theloai: theloai,
                    namphim: $("#namphim").val(),
                    loaiphim: loaiphim,
                    tenkhac: $("#tenkhac").val(),
                    tag: $("#tag").val(),
                    thoiluong: $("#thoiluong").val(),
                    tongsotap: tongsotap
                },
                dataType: "JSON",
                success: function (data) {
                    $("#message").html(data);
                    $("p").addClass("alert alert-success");
                },
                error: function (err) {
                    alert("Đã xảy ra lỗi: " + err.responseText);
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var spinner = document.getElementById('loading-spinner');
            if (spinner) {
                spinner.style.display = 'none';
            }
        });
    </script>
    <?php
    } else {
        header('Location: /');
        exit;
    }
    ?>
