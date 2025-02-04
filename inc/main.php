<?php
require("../inc/config.php"); // Kết nối cơ sở dữ liệu

// Truy vấn lấy danh sách loại phim
$sqlLoaiPhim = "SELECT id, ten_loai FROM loaiphim";
$resultLoaiPhim = $conn->query($sqlLoaiPhim);

// Kiểm tra dữ liệu trả về
$loaiPhim = [];
if ($resultLoaiPhim->num_rows > 0) {
    while ($row = $resultLoaiPhim->fetch_assoc()) {
        $loaiPhim[] = $row;
    }
}
?>
<div class="widget update">
    <div class="widget-title">
        <h3 class="title">Phim mới cập nhật</h3>
        <div class="tabs" data-target=".widget.update .widget-body .content">
            <!-- Tab Tất cả phim -->
            <div class="tab active" data-name="all"><span>Tất cả phim</span></div>
            <!-- Tạo các tab động từ danh sách loại phim -->
            <?php foreach ($loaiPhim as $loai) : ?>
                <div class="tab" data-name="loai-<?php echo $loai['id']; ?>">
                    <span><?php echo htmlspecialchars($loai['ten_loai']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="widget-body">
        <!-- Nội dung Tab Tất cả phim -->
        <div class="content" id="all" data-name="all">
            <ul class="list-film">
                <?php
                // Truy vấn danh sách phim mới nhất
                $sqlPhim = "SELECT * FROM phim ORDER BY thoigian DESC";
                $result = mysqli_query($Nhan_connect, $sqlPhim);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Đếm số tập của phim
                        $tap_sql = "SELECT COUNT(id) AS tap_count FROM tap WHERE link = '" . $row['link'] . "'";
                        $tap_result = mysqli_query($Nhan_connect, $tap_sql);
                        $tap_row = mysqli_fetch_assoc($tap_result);
                        $tap = $tap_row['tap_count'];

                        // Hiển thị thông tin phim
                        echo '<li class="nhan-anime">
                            <div class="poster">
                                <a title="' . htmlspecialchars($row['mota']) . '" href="/phim/' . htmlspecialchars($row['link']) . '">
                                    <img alt="' . htmlspecialchars($row['tenphim']) . '" src="' . htmlspecialchars($row['thumbnail']) . '">
                                </a>
                                <span class="mli-eps">TẬP <i>' . $tap . '</i></span>                           
                            </div>
                            <div class="name">
                                <h4>
                                    <a title="' . htmlspecialchars($row['mota']) . '" href="/phim/' . htmlspecialchars($row['link']) . '">' . htmlspecialchars($row['tenphim']) . ' (' . htmlspecialchars($row['namphim']) . ')</a>
                                </h4>
                                <dfn>' . htmlspecialchars($row['tenkhac']) . '</dfn>
                            </div>
                        </li>';
                    }
                } else {
                    echo '<li class="nhan-anime">Không có phim nào được tìm thấy.</li>';
                }
                ?>
            </ul>
        </div>

        <!-- Nội dung các tab động theo loại phim -->
        <?php foreach ($loaiPhim as $loai) : ?>
            <div class="content hide" id="loai-<?php echo $loai['id']; ?>" data-name="loai-<?php echo $loai['id']; ?>">
                <ul class="list-film">
                    <?php
                    // Truy vấn danh sách phim theo loại
                    $sqlMoviesByType = "SELECT * FROM phim WHERE loaiphim = " . intval($loai['id']) . " ORDER BY thoigian DESC LIMIT 10";
                    $resultMoviesByType = mysqli_query($Nhan_connect, $sqlMoviesByType);

                    if ($resultMoviesByType) {
                        while ($row = mysqli_fetch_assoc($resultMoviesByType)) {
                            // Đếm số tập của phim
                            $tap_sql = "SELECT COUNT(id) AS tap_count FROM tap WHERE link = '" . $row['link'] . "'";
                            $tap_result = mysqli_query($Nhan_connect, $tap_sql);
                            $tap_row = mysqli_fetch_assoc($tap_result);
                            $tap = $tap_row['tap_count'];

                            // Hiển thị thông tin phim
                            echo '<li class="nhan-anime">
                                <div class="poster">
                                    <a title="' . htmlspecialchars($row['mota']) . '" href="/phim/' . htmlspecialchars($row['link']) . '">
                                        <img alt="' . htmlspecialchars($row['tenphim']) . '" src="' . htmlspecialchars($row['thumbnail']) . '">
                                    </a>
                                    <span class="mli-eps">TẬP <i>' . $tap . '</i></span>
                                </div>
                                <div class="name">
                                    <h4>
                                        <a title="' . htmlspecialchars($row['mota']) . '" href="/phim/' . htmlspecialchars($row['link']) . '">' . htmlspecialchars($row['tenphim']) . ' (' . htmlspecialchars($row['namphim']) . ')</a>
                                    </h4>
                                    <dfn>' . htmlspecialchars($row['tenkhac']) . '</dfn>
                                </div>
                            </li>';
                        }
                    } else {
                        echo '<li class="nhan-anime">Không có phim nào thuộc loại này.</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Ẩn tất cả nội dung tab khi trang vừa tải, trừ tab mặc định
        $('.widget .widget-body .content').addClass('hide');
        $('.widget .widget-body .content[data-name="all"]').removeClass('hide');

        // Đặt tab mặc định là 'active'
        $('.widget .tabs .tab').removeClass('active');
        $('.widget .tabs .tab[data-name="all"]').addClass('active');

        // Bắt sự kiện click vào tab
        $('.widget .tabs .tab').on('click', function () {
            // Xóa class 'active' khỏi tất cả các tab
            $('.widget .tabs .tab').removeClass('active');

            // Thêm class 'active' cho tab được nhấp
            $(this).addClass('active');

            // Ẩn tất cả các nội dung tab
            $('.widget .widget-body .content').addClass('hide');

            // Hiển thị nội dung của tab được chọn ngay lập tức
            const targetName = $(this).data('name'); // Lấy giá trị data-name của tab
            $(`.widget .widget-body .content[data-name="${targetName}"]`).removeClass('hide');
        });
    });
</script>
