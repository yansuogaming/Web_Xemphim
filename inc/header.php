 <div id="header">
    <div class="container">
        <div class="fixed">
            <i class="menu-trigger"></i>
            <a id="logo-nhandz" href="<?php echo $trangchu ?>" title="<?php echo $tieude ?>">
                <img src="https://upload.wikimedia.org/wikipedia/vi/c/cf/Phim_M%E1%BB%9Bi_Transparent_Background_Logo.png" title="logo_phimmoi" width="150" height="50">
            </a>
        </div>
        <div class="search-wapper">
            <form method="post" onsubmit="return false;" action class="style2" id="search">
                <input type="text" class="keyword" name="keyword" placeholder="Gõ tên phim, diễn viên cần tìm..." autocomplete="off">
                <input type="submit" class="submit" value="Tìm" title="Bấm nhẹ">
            </form>
        </div>
        <div class="box-favorite">
            <div class="toggle"><i></i> Box phim</div>
            <div class="list"></div>
        </div>
        <div class="request-film">
            <a rel="nofollow" href="https://goo.gl/QeJjXk" target="_blank"><span ><i></i> Yêu cầu phim</span></a>
        </div>
        <div class="user">
            <a rel="nofollow" href="javascript:alert('Chức năng đang được hoàn thiện. Bạn vui lòng thử lại sau !')" class="btn btn-login">Đăng nhập</a>
            <a rel="nofollow" href="javascript:alert('Chức năng đang được hoàn thiện. Bạn vui lòng thử lại sau !')" class="register">Chưa có tài khoản ?<span>Đăng ký ngay<i></i></span></a>
        </div>
    </div>
</div>

 <div id="menu">
     <ul class="container">
         <!-- Tab Trang chủ -->
         <li class="active home">
             <a href="<?php echo $trangchu; ?>"><i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a>
         </li>

         <!-- Tab Thể loại -->
         <li>
             <a title="Thể loại">Thể loại</a>
             <ul class="sub" style="width: 125px;">
                 <?php
                 // Kết nối cơ sở dữ liệu
                 require("../inc/config.php");

                 // Truy vấn danh sách thể loại
                 $sqlTheLoai = "SELECT id, ten_theloai, slug, mo_ta FROM theloai ORDER BY ten_theloai ASC";
                 $resultTheLoai = $conn->query($sqlTheLoai);

                 // Hiển thị danh sách thể loại
                 if ($resultTheLoai->num_rows > 0) {
                     while ($row = $resultTheLoai->fetch_assoc()) {
                         echo '<li>
                                <a href="' . $trangchu . '/the-loai/' . htmlspecialchars($row['slug']) . '" 
                                   title="' . htmlspecialchars($row['mo_ta']) . '">' . htmlspecialchars($row['ten_theloai']) . '</a>
                              </li>';
                     }
                 } else {
                     echo '<li>Không có thể loại nào</li>';
                 }
                 ?>
             </ul>
         </li>

         <?php
         // Truy vấn phim lẻ
         $sql_single = "
SELECT phim.*, loaiphim.ten_loai, loaiphim.slug AS loaiphim_slug 
FROM phim 
LEFT JOIN loaiphim ON phim.loaiphim = loaiphim.id 
WHERE phim.loaiphim = 9"; // Lọc phim lẻ

         // Truy vấn phim bộ
         $sql_series = "
SELECT phim.*, loaiphim.ten_loai, loaiphim.slug AS loaiphim_slug 
FROM phim 
LEFT JOIN loaiphim ON phim.loaiphim = loaiphim.id 
WHERE phim.loaiphim = 8"; // Lọc phim bộ

         // Thực thi truy vấn phim lẻ
         $result_single = $conn->query($sql_single);
         // Thực thi truy vấn phim bộ
         $result_series = $conn->query($sql_series);


         // Hiển thị phim lẻ
         if ($result_single->num_rows > 0) {
             // Sử dụng $row['loaiphim'] để tạo link động
             $row = $result_single->fetch_assoc();
             echo '<li>';
             echo '<a href="' . $trangchu . '/danh-sach/' . $row['loaiphim'] . '">'; // Đường dẫn tới danh sách phim lẻ (dùng giá trị loaiphim từ CSDL)
             echo '<span>' . $row['ten_loai'] . '</span>'; // Hiển thị tên thể loại
             echo '</a>';
             echo '</li>';
         }

         // Hiển thị phim bộ
         if ($result_series->num_rows > 0) {
             // Sử dụng $row['loaiphim'] để tạo link động
             $row = $result_series->fetch_assoc();
             echo '<li>';
             echo '<a href="' . $trangchu . '/danh-sach/' . $row['loaiphim'] . '">'; // Đường dẫn tới danh sách phim bộ (dùng giá trị loaiphim từ CSDL)
             echo '<span>' . $row['ten_loai'] . '</span>'; // Hiển thị tên thể loại
             echo '</a>';
             echo '</li>';
         }

         ?>



     </ul>
 </div>
