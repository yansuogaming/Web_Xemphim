<?php require("../inc/config.php") ?>
<div class="widget hotest">
    <div class="container">
        <!-- Wrapper cho Owl Carousel -->
        <div class="items owl-carousel owl-theme">
            <?php
            // Truy vấn lấy danh sách phim cùng thông tin loại phim
            $sql_phim = "
                SELECT p.*, l.ten_loai 
                FROM phim p
                LEFT JOIN loaiphim l ON p.loaiphim = l.id
                ORDER BY RAND()
            ";
            $result = mysqli_query($Nhan_connect, $sql_phim);

            // Kiểm tra nếu truy vấn trả về dữ liệu
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Đếm số tập của phim
                    $tap_sql = "SELECT COUNT(id) AS tap_count FROM tap WHERE link = '".$row['link']."'";
                    $tap_result = mysqli_query($Nhan_connect, $tap_sql);
                    $tap_row = mysqli_fetch_assoc($tap_result);
                    $tap = $tap_row['tap_count'];

                    // Hiển thị dữ liệu phim
                    echo '<div class="item">
                        <div class="poster">
                            <a title="'.htmlspecialchars($row['mota']).'" href="/phim/'.htmlspecialchars($row['link']).'">
                                <img alt="'.htmlspecialchars($row['tenphim']).'" src="'.htmlspecialchars($row['thumbnail']).'">
                            </a>
                        </div>
                        <div class="status">Tập '.$tap.' Vietsub</div>
                        <div class="info">
                            <a title="'.htmlspecialchars($row['mota']).'" href="/phim/'.htmlspecialchars($row['link']).'">'.htmlspecialchars($row['tenphim']).'</a>
                            <dfn>'.htmlspecialchars($row['ten_loai']).'</dfn>
                        </div>
                    </div>';
                }
            } else {
                // Nếu không có dữ liệu, hiển thị thông báo
                echo '<div class="item"><p>Không có phim nào phù hợp.</p></div>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        $(".owl-carousel").owlCarousel({
            items: 5,
            loop: false,
            margin: 30,
            nav: true,
            navigation: true,
            navigationText: ['<div class="control prev"></div>', '<div class="control next"></div>'],
            lazyLoad: true,
            scrollPerPage: true,
            slideSpeed: 800,
            paginationSpeed: 400,
            stopOnHover: true,
            pagination: false,
            autoPlay: 8000,
            responsive: {
                0: {
                    items: 2
                },
                479: {
                    items: 2
                },
                700: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    };


</script>
