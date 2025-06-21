<?php
require("../inc/config.php"); // Kết nối cơ sở dữ liệu

// Lấy slug từ URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

// Kiểm tra slug và lấy thông tin thể loại
$sqlTheLoai = "SELECT * FROM theloai WHERE slug = ?";
$stmt = $conn->prepare($sqlTheLoai);
$stmt->bind_param("s", $slug);
$stmt->execute();
$resultTheLoai = $stmt->get_result();
$theLoai = $resultTheLoai->fetch_assoc();

if (!$theLoai) {
    echo "Thể loại không tồn tại.";
    exit;
}

// Lấy danh sách phim theo thể loại
$sqlPhim = "SELECT * FROM phim WHERE FIND_IN_SET(?, theloai) ORDER BY thoigian DESC LIMIT 10";
$stmtPhim = $conn->prepare($sqlPhim);
$stmtPhim->bind_param("s", $theLoai['id']);
$stmtPhim->execute();
$resultPhim = $stmtPhim->get_result();

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($theLoai['ten_theloai']); ?> - Danh sách phim</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Thay bằng file CSS của bạn -->
</head>

<body>
    <div class="container">
        <h1>Thể loại: <?php echo htmlspecialchars($theLoai['ten_theloai']); ?></h1>
        <p><?php echo htmlspecialchars($theLoai['mo_ta']); ?></p>
        <ul class="list-film">
            <?php if ($resultPhim->num_rows > 0): ?>
                <?php while ($row = $resultPhim->fetch_assoc()): ?>
                    <li class="film-item">
                        <div class="poster">
                            <a href="/webxemphim/phim/<?php echo htmlspecialchars($row['link']); ?>" title="<?php echo htmlspecialchars($row['mota']); ?>">
                                <img src="<?php echo htmlspecialchars($row['thumbnail']); ?>" alt="<?php echo htmlspecialchars($row['tenphim']); ?>">
                            </a>
                        </div>
                        <div class="info">
                            <h3>
                                <a href="/webxemphim/phim/<?php echo htmlspecialchars($row['link']); ?>">
                                    <?php echo htmlspecialchars($row['tenphim']); ?> (<?php echo htmlspecialchars($row['namphim']); ?>)
                                </a>
                            </h3>
                            <p><?php echo htmlspecialchars($row['mota']); ?></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li>Không có phim nào thuộc thể loại này.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>