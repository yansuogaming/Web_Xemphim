<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require("menu.php");
    require("head.php");
    $url = $_GET['url'];
    $tap = $_GET['tap'];
    $id = $_GET['id'];

    $url = mysqli_real_escape_string($Nhan_connect, $url);
    $tap = mysqli_real_escape_string($Nhan_connect, $tap);
    $id = mysqli_real_escape_string($Nhan_connect, $id);

    ?>
    <div class="br-mainpanel">
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <?php
                $sql4 = "SELECT * FROM tap WHERE id = '$id'";
                if ($result1 = mysqli_query($Nhan_connect, $sql4)) {
                    if (mysqli_num_rows($result1) > 0) {
                        $row = mysqli_fetch_array($result1);
                        // Lấy slug hiện tại
                        $currentSlug = $row['slug'];
                        ?>
                        <form id="loginForm" method="" action="" novalidate="novalidate">
                            <div class="row">
                                <div class="col-lg">
                                    <label for="tap">Tập:</label>
                                    <input type="text" class="form-control" id="tap" name="tap"
                                           value="<?php echo $row["tap"]; ?>" required="" placeholder="">
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="player">Player:</label>
                                    <input type="text" class="form-control" id="player" name="player"
                                           value="<?php echo $row["player"]; ?>" required="" placeholder="">
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0" style="display:none">
                                    <label for="id">ID:</label>
                                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" id="link" name="link"
                                           value="<?php echo $url; ?>" required="" placeholder="">
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="slug">Slug:</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                           value="<?php echo $currentSlug; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mg-t-20">
                                <button class="btn btn-success btn-block" type="button" onclick="EditTap()">Sửa tập
                                    <?php echo $row["tap"] ?>
                                </button>
                            </div>
                        </form>
                        <div id="message"></div>

                        <?php
                    } else {
                        echo "<p>Không tìm thấy tập phim có ID: $id</p>";
                    }
                } else {
                    echo "<p>Lỗi truy vấn: " . mysqli_error($Nhan_connect) . "</p>";
                }
                ?>

            </div>
        </div>
    </div> </body>

    <script type="text/javascript">
        // Hàm tạo slug từ chuỗi
        function createSlug(str) {
            var search = ['(Full)', 'Full', 'Tập '];
            var replace = ['', '', ''];
            var newStr = str.replace(new RegExp(search.join('|'), 'g'), (matched) => {
                return replace[search.indexOf(matched)];
            });
            newStr = newStr.replace(/\s+/g, ''); // Xóa tất cả khoảng trắng
            return 'tap-' + newStr;
        }

        // Cập nhật slug khi tap thay đổi
        $(document).ready(function() {
            $("#tap").on("input", function() {
                var tapValue = $(this).val();
                var newSlug = createSlug(tapValue);
                $("#slug").val(newSlug);
            });
        });

        function EditTap() {
            var tap = $("#tap").val();
            var player = $("#player").val();
            var link = $("#link").val();
            var id = $("#id").val();
            var slug = $("#slug").val();

            $.ajax({
                type: "POST",
                url: "api.php",
                data: {action: 'EditTap', tap: tap, player: player, link: link, id: id, slug: slug},
                dataType: "JSON",
                success: function (data) {
                    $("#message").html(data);
                    $("p").addClass("alert alert-success");

                    // Lấy url từ input ẩn
                    var url = $("#link").val();

                    // Chuyển hướng sau khi sửa thành công
                    setTimeout(function() {
                        window.location.href = "tap.php?url=" + url;
                    }, 1000); // Chuyển hướng sau 1 giây (1000 milliseconds)
                },
                error: function (err) {
                    console.log(err);
                    alert("Lỗi");
                }
            });
        }
    </script>


    </html>
    <?php
} else {
    header('Location: /');
    exit;
}
?>