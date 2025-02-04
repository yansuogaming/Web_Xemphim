<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require("head.php");
    require("menu.php");
    $url = $_GET['url'];
    ?>
    <div class="br-mainpanel">
    <div class="br-pagebody">
    <div class="br-section-wrapper">
        <form id="loginForm" method="" action="" novalidate="novalidate">
            <div class="row">
                <div class="col-lg">
                    <label for="tap">Tập:</label>
                    <input type="text" class="form-control" id="tap" name="tap" value="" required=""
                           placeholder="Vui lòng nhập tên hoặc số tập">
                </div><div class="col-lg mg-t-10 mg-lg-t-0">
                    <label for="player">Player:</label>
                    <input type="text" class="form-control" id="player" name="player" value="" required=""
                           placeholder="Nhập link player (Google drive, MP4)">

                </div><div style="display:none" class="col-lg mg-t-10 mg-lg-t-0">
                    <input type="text" class="form-control" id="link" name="link" required=""
                           value="<?php echo $url; ?>">
                </div></div><br>
            <center>
                <button type="button" class="btn btn-success" name="insert-data" id="insert-data"
                        onclick="ThemTap()">Thêm tập
                </button>
            </center>

        </form>

        <div id="message"></div>

    </div>
    <?php require("footer.php"); ?>
    </body>

    <script type="text/javascript">

        function ThemTap() {
            var tap = $("#tap").val();
            var player = $("#player").val();
            var link = $("#link").val();

            $.ajax({
                type: "POST",
                url: "api.php",
                data: {action: 'ThemTap', tap: tap, player: player, link: link},
                dataType: "JSON",
                success: function (data) {
                    $("#message").html(data);
                    $("p").addClass("alert alert-success");
                },
                error: function (err) {
                    console.log(err); // Log lỗi ra console
                    alert("Có lỗi xảy ra: " + err.responseText); // Hiển thị thông báo lỗi
                }
            });

        }

    </script>

    </html>
    <?php
} else {
    header('Location: /');
    exit;
} ?>