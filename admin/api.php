<?php
include('../inc/config.php');
if ($_POST['action'] == 'ThemPhim') {
    $tenphim = $_POST['tenphim'] ?? '';
    $thumbnail = $_POST['thumbnail'] ?? '';
    $mota = $_POST['mota'] ?? '';
    $link = $_POST['link'] ?? '';
    $namphim = intval($_POST['namphim'] ?? 0);
    $theloai = intval($_POST['theloai'] ?? 0);
    $loaiphim = intval($_POST['loaiphim'] ?? 0);
    $tenkhac = $_POST['tenkhac'] ?? '';
    $tag = $_POST['tag'] ?? '';
    $thoiluong = $_POST['thoiluong'] ?? '';
    $tongsotap = $_POST['tongsotap'] ?? '';
    if (strtolower($tongsotap) === "full") {
        $tongsotap = "Full"; // Giữ nguyên chữ "Full"
    } elseif (is_numeric($tongsotap)) {
        $tongsotap = intval($tongsotap); // Chuyển thành số nguyên nếu là số
    } else {
        echo json_encode("<div class='alert alert-danger'>Tổng số tập không hợp lệ. Vui lòng nhập số hoặc 'Full'.</div>");
        exit;
    }

    $updatephim = 1; // Mặc định là 1

    // Kiểm tra các giá trị quan trọng
    if (empty($theloai) || empty($loaiphim)) {
        echo json_encode("<div class='alert alert-danger'>Vui lòng chọn thể loại và loại phim.</div>");
        exit;
    }

    try {
        // Chuẩn bị câu lệnh INSERT
        $stmt = $DBcon->prepare("INSERT INTO phim (tenphim, thumbnail, mota, link, namphim, theloai, loaiphim, tenkhac, tag, thoiluong, tongsotap, updatephim) 
        VALUES (:tenphim, :thumbnail, :mota, :link, :namphim, :theloai, :loaiphim, :tenkhac, :tag, :thoiluong, :tongsotap, :updatephim)");

        // Ràng buộc các giá trị
        $stmt->bindValue(':tenphim', $tenphim, PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':mota', $mota, PDO::PARAM_STR);
        $stmt->bindValue(':link', $link, PDO::PARAM_STR);
        $stmt->bindValue(':namphim', $namphim, PDO::PARAM_INT);
        $stmt->bindValue(':theloai', $theloai, PDO::PARAM_INT);
        $stmt->bindValue(':loaiphim', $loaiphim, PDO::PARAM_INT);
        $stmt->bindValue(':tenkhac', $tenkhac, PDO::PARAM_STR);
        $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
        $stmt->bindValue(':thoiluong', $thoiluong, PDO::PARAM_STR);
        $stmt->bindValue(':tongsotap', $tongsotap, is_numeric($tongsotap) ? PDO::PARAM_INT : PDO::PARAM_STR);
        $stmt->bindValue(':updatephim', $updatephim, PDO::PARAM_INT);

        // Thực thi câu lệnh và kiểm tra kết quả
        if ($stmt->execute()) {
            echo json_encode("<div class='alert alert-success'>Đã thêm phim <b>$tenphim</b> thành công!</div>");
        } else {
            echo json_encode("<div class='alert alert-danger'>Thêm phim thất bại.</div>");
        }
    } catch (PDOException $e) {
        echo json_encode("<div class='alert alert-danger'>Lỗi: " . $e->getMessage() . "</div>");
    }
}


if ($_POST['action'] == 'EditPhim') {
    $tenphim = $_POST['tenphim'];
    $thumbnail = $_POST['thumbnail'];
    $mota = $_POST['mota'];
    $link = $_POST['link'];
    $namphim = $_POST['namphim'];
    $theloai = $_POST['theloai'];
    $loaiphim = $_POST['loaiphim'];
    $tenkhac = $_POST['tenkhac'];
    $tag = $_POST['tag'];
    $thoiluong = $_POST['thoiluong'];
    $tongsotap = $_POST['tongsotap'];
    $stmt = $DBcon->prepare("UPDATE `phim` SET `tenphim` = N'" . $tenphim . "',`thumbnail` = N'" . $thumbnail . "',`mota` = N'" . $mota . "',`link` = N'" . $link . "',`namphim` = N'" . $namphim . "',`theloai` = N'" . $theloai . "',`loaiphim` = N'" . $loaiphim . "',`tenkhac` = N'" . $tenkhac . "',`tag` = N'" . $tag . "',`thoiluong` = N'" . $thoiluong . "',`tongsotap` = N'" . $tongsotap . "' WHERE link = '$link'");
    if ($stmt->execute()) {
        $res = "<div class='alert alert-success'>Đã sửa phim <b>$tenphim</b> thành công !</div>";
        echo json_encode($res);
    } else {
        $error = "<div class='alert alert-danger'>Sửa không thành công</div>";
        echo json_encode($error);
    }
}
if ($_POST['action'] == 'EditTap') {
    $tap = $_POST['tap'];
    $player = $_POST['player'];
    $link = $_POST['link'];
    $id = $_POST['id'];
    $slug = $_POST['slug']; // Lấy slug từ request

    // Sanitize slug (bạn có thể thêm các bước sanitize khác nếu cần)
    $slug = mysqli_real_escape_string($Nhan_connect, $slug);

    // Sử dụng Prepared Statements
    $stmt = $DBcon->prepare("UPDATE `tap` SET `tap` = :tap, `player` = :player, `slug` = :slug WHERE id = :id");
    $stmt->bindParam(':tap', $tap, PDO::PARAM_STR);
    $stmt->bindParam(':player', $player, PDO::PARAM_STR);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $res = "<div class='alert alert-success'>Đã sửa tập <b>" . htmlspecialchars($tap) . "</b> thành công !</div>";
        echo json_encode($res);
    } else {
        $error = "<div class='alert alert-danger'>Sửa không thành công</div>";
        echo json_encode($error);
    }
}

if ($_POST['action'] == 'ThemTap') {
    $tap = $_POST['tap'];
    $player = $_POST['player'];
    $link = $_POST['link'];

    // Tạo slug từ tap
    $slug = createSlug($tap);

    // Sử dụng Prepared Statements
    $stmt = $DBcon->prepare("INSERT INTO tap(tap, link, player, slug) VALUES(:tap, :link, :player, :slug)");
    $stmt->bindParam(':tap', $tap, PDO::PARAM_STR);
    $stmt->bindParam(':link', $link, PDO::PARAM_STR);
    $stmt->bindParam(':player', $player, PDO::PARAM_STR);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

    mysqli_query($conn, "UPDATE phim SET updatephim = updatephim + 1 WHERE link = '$link'");

    if ($stmt->execute()) {
        $res = "<div class='alert alert-success'>Đã thêm tập <b>" . htmlspecialchars($tap) . "</b> thành công !</div>";
        echo json_encode($res);
    } else {
        $error = "<div class='alert alert-danger'>Thêm không thành công. Lỗi: " . implode(", ", $stmt->errorInfo()) . "</div>";
        echo json_encode($error);
    }
}

// Hàm createSlug (đã có sẵn)
function createSlug($string) {
    $search = array('(Full)', 'Full', 'Tập ');
    $replace = array('', '', '');

    $slug = str_replace($search, $replace, $string);
    $slug = preg_replace('/\s+/', '', $slug); // Xóa tất cả khoảng trắng
    $slug = 'tap-' . $slug;
    return $slug;
}


if ($_POST['action'] == 'Upload') {
    $client_id = "859563ec1c412e5";
    $image = $_POST['url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $image));

    $reply = curl_exec($ch);
    curl_close($ch);

    $reply = json_decode($reply);
    $newimgurl = $reply->data->link;

    echo $newimgurl;

    exit();
}
if ($_POST['action'] == 'CaiDat') {
    $tieude = $_POST['tieude'];
    $mota = $_POST['mota'];
    $google = $_POST['google'];
    $facebook = $_POST['facebook'];
    $appid = $_POST['appid'];
    $linktrang = $_POST['linktrang'];
    $style = $_POST['style'];
    $stmt = $DBcon->prepare("UPDATE `thongtin` SET `tieude` = N'" . $tieude . "',`mota` = N'" . $mota . "',`google` = N'" . $google . "',`facebook` = N'" . $facebook . "',`linktrang` = N'" . $linktrang . "',`appid` = N'" . $appid . "',`style` = N'" . $style . "'");
    if ($stmt->execute()) {
        $res = "<div class='alert alert-success'>Đã update !</div>";
        echo json_encode($res);
    } else {
        $error = "<div class='alert alert-danger'>Thất bại</div>";
        echo json_encode($error);
    }
}
if ($_POST['action'] == 'Backlink') {
    $tieude = $_POST['tieude'];
    $mota = $_POST['mota'];
    $url = $_POST['url'];
    $stmt = $DBcon->prepare("INSERT INTO backlink(tieude,mota,url) VALUES(N'$tieude', N'$mota',N'$url')");
    if ($stmt->execute()) {
        $res = "<div class='alert alert-success'>Đã thêm liên kết với $tieude !</div>";
        echo json_encode($res);
    } else {
        $error = "<div class='alert alert-danger'>Thất bại</div>";
        echo json_encode($error);
    }
}
?>