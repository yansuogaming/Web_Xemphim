<?php
session_start();
include_once("../inc/config.php");
require("head.php");
require("menu.php");

// Xử lý thêm loại phim
if (isset($_POST['add'])) {
    $ten_loai = $_POST['ten_loai'];
    $mo_ta = $_POST['mo_ta'];

    $sql = "INSERT INTO loaiphim (ten_loai, mo_ta) VALUES (?, ?)";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("ss", $ten_loai, $mo_ta);
    if ($stmt->execute()) {
        echo "<script>alert('Thêm loại phim thành công!'); window.location='upload_loaiphim.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm loại phim!');</script>";
    }
}

// Xử lý cập nhật loại phim
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $ten_loai = $_POST['ten_loai'];
    $mo_ta = $_POST['mo_ta'];

    $sql = "UPDATE loaiphim SET ten_loai = ?, mo_ta = ? WHERE id = ?";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("ssi", $ten_loai, $mo_ta, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật loại phim thành công!'); window.location='upload_loaiphim.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật loại phim!');</script>";
    }
}

// Xử lý xóa loại phim
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM loaiphim WHERE id = ?";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Xóa loại phim thành công!'); window.location='upload_loaiphim.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa loại phim!');</script>";
    }
}
?>


<div class="br-mainpanel">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h4>Quản lý Loại Phim</h4>
            <hr>

            <!-- Form thêm/sửa loại phim -->
            <form method="post" action="">
                <div class="form-group">
                    <label for="ten_loai">Tên Loại Phim:</label>
                    <input type="text" id="ten_loai" name="ten_loai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="mo_ta">Mô Tả:</label>
                    <textarea id="mo_ta" name="mo_ta" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" id="id" name="id">
                <button type="submit" name="add" class="btn btn-success">Thêm Mới</button>
                <button type="submit" name="update" class="btn btn-primary">Cập Nhật</button>
            </form>
            <hr>

            <!-- Bảng danh sách loại phim -->
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Loại</th>
                        <th>Mô Tả</th>
                        <th>Quản Lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Kết nối database và lấy danh sách loại phim
                    $result = mysqli_query($Nhan_connect, "SELECT * FROM loaiphim ORDER BY id DESC");

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']); ?></td>
                                <td><?= htmlspecialchars($row['ten_loai']); ?></td>
                                <td><?= htmlspecialchars($row['mo_ta']); ?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="editLoaiPhim('<?= $row['id']; ?>', '<?= addslashes($row['ten_loai']); ?>', '<?= addslashes($row['mo_ta']); ?>')" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa loại phim này?');" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" style="text-align: center;">Không có loại phim nào</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function editLoaiPhim(id, ten_loai, mo_ta) {
        document.getElementById('id').value = id;
        document.getElementById('ten_loai').value = ten_loai;
        document.getElementById('mo_ta').value = mo_ta;
    }
</script>



