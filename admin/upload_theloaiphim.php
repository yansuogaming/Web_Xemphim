<?php
session_start();
include_once("../inc/config.php");
require("head.php");
require("menu.php");

// Hàm tạo slug từ chuỗi
function createSlug($string) {
    $string = mb_strtolower($string, 'UTF-8'); // Chuyển thành chữ thường
    $string = preg_replace('/[áàảạãăắằẳẵặâấầẩẫậ]/u', 'a', $string);
    $string = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $string);
    $string = preg_replace('/[iíìỉĩị]/u', 'i', $string);
    $string = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $string);
    $string = preg_replace('/[úùủũụưứừửữự]/u', 'u', $string);
    $string = preg_replace('/[ýỳỷỹỵ]/u', 'y', $string);
    $string = preg_replace('/[đ]/u', 'd', $string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string); // Loại bỏ ký tự đặc biệt
    $string = preg_replace('/\s+/', '-', $string); // Thay khoảng trắng bằng dấu "-"
    return trim($string, '-'); // Xóa dấu "-" thừa
}

// Xử lý thêm thể loại phim
if (isset($_POST['add'])) {
    $ten_theloai = $_POST['ten_theloai'];
    $mo_ta = $_POST['mo_ta'];
    $slug = createSlug($ten_theloai); // Tạo slug từ tên thể loại

    $sql = "INSERT INTO theloai (ten_theloai, mo_ta, slug) VALUES (?, ?, ?)";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("sss", $ten_theloai, $mo_ta, $slug);
    if ($stmt->execute()) {
        echo "<script>alert('Thêm thể loại phim thành công!'); window.location='upload_theloaiphim.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm thể loại phim!');</script>";
    }
}

// Xử lý cập nhật thể loại phim
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $ten_theloai = $_POST['ten_theloai'];
    $mo_ta = $_POST['mo_ta'];
    $slug = createSlug($ten_theloai); // Tạo lại slug khi cập nhật

    $sql = "UPDATE theloai SET ten_theloai = ?, mo_ta = ?, slug = ? WHERE id = ?";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("sssi", $ten_theloai, $mo_ta, $slug, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thể loại phim thành công!')</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật thể loại phim!');</script>";
    }
}

// Xử lý xóa thể loại phim
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM theloai WHERE id = ?";
    $stmt = $Nhan_connect->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Xóa thể loại phim thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa thể loại phim!');</script>";
    }
}
?>


<div class="br-mainpanel">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h4>Quản lý Thể Loại Phim</h4>
            <hr>

            <!-- Form thêm/sửa thể loại phim -->
            <form method="post" action="">
                <div class="form-group">
                    <label for="ten_theloai">Tên Thể Loại Phim:</label>
                    <input type="text" id="ten_theloai" name="ten_theloai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="mo_ta">Mô Tả:</label>
                    <textarea id="mo_ta" name="mo_ta" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" id="id" name="id">
                <button type="submit" name="add" class="btn btn-success">Thêm Mới</button>
                <button type="submit" name="update" class="btn btn-primary" style="display: none;">Cập Nhật</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">Hủy</button>
            </form>
            <hr>

            <!-- Bảng danh sách thể loại phim -->
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Thể Loại</th>
                        <th>Mô Tả</th>
                        <th>Quản Lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Kết nối database và lấy danh sách thể loại phim
                    $result = mysqli_query($Nhan_connect, "SELECT * FROM theloai ORDER BY id DESC");

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']); ?></td>
                                <td><?= htmlspecialchars($row['ten_theloai']); ?></td>
                                <td><?= htmlspecialchars($row['mo_ta']); ?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="editTheLoai('<?= $row['id']; ?>', '<?= addslashes($row['ten_theloai']); ?>', '<?= addslashes($row['mo_ta']); ?>')" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại phim này?');" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" style="text-align: center;">Không có thể loại phim nào</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm chỉnh sửa thể loại phim
    function editTheLoai(id, ten_theloai, mo_ta) {
        document.getElementById('id').value = id;
        document.getElementById('ten_theloai').value = ten_theloai;
        document.getElementById('mo_ta').value = mo_ta;

        document.querySelector('[name="add"]').style.display = 'none'; // Ẩn nút Thêm Mới
        document.querySelector('[name="update"]').style.display = 'inline-block'; // Hiển thị nút Cập Nhật
    }

    // Hàm reset form
    function resetForm() {
        document.getElementById('id').value = '';
        document.getElementById('ten_theloai').value = '';
        document.getElementById('mo_ta').value = '';

        document.querySelector('[name="add"]').style.display = 'inline-block'; // Hiển thị nút Thêm Mới
        document.querySelector('[name="update"]').style.display = 'none'; // Ẩn nút Cập Nhật
    }
</script>
