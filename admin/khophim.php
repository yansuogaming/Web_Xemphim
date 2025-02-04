<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require("head.php");
    require("menu.php");
    ?>
    <link href="./templates/bracket/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="./templates/bracket/lib/highlightjs/github.css" rel="stylesheet">
    <div class="br-mainpanel">
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Thumbnail</th>
                            <th class="wd-15p">Tên phim</th>
                            <th class="wd-20p">Loại phim</th>
                            <th class="wd-15p">Năm phim</th>
                            <th class="wd-10p">Tập</th>
                            <th class="wd-10p">Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Liên kết bảng phim với bảng loaiphim
                        $result = mysqli_query($Nhan_connect, "
                            SELECT phim.*, loaiphim.ten_loai 
                            FROM phim 
                            LEFT JOIN loaiphim ON phim.loaiphim = loaiphim.id 
                            ORDER BY phim.id DESC
                        ");

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Đếm số tập
                                $tap = mysqli_num_rows(mysqli_query($Nhan_connect, "SELECT `id` FROM tap WHERE link = '" . $row['link'] . "'")); ?>
                                <tr>
                                    <td><img style="width: 50px" src="<?php echo $row['thumbnail']; ?>"></td>
                                    <td style="display: block; width: 300px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><?php echo $row['tenphim']; ?></td>
                                    <td><?php echo $row['ten_loai']; ?></td> <!-- Hiển thị tên loại phim -->
                                    <td><?php echo $row['namphim']; ?></td>
                                    <td><?php echo "$tap/" . $row['tongsotap']; ?></td>
                                    <td>
                                        <span>
                                            <a href="add.php?url=<?php echo $row['link']; ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                            <a href="edit.php?url=<?php echo $row['link']; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                            <a href="tap.php?url=<?php echo $row['link']; ?>"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                                            <a onclick="if (confirm('Bạn có chắc chắc muốn xóa phim <?php echo "" . $row["tenphim"] . ""; ?>?')) window.location.href='xoa.php?url=<?php echo $row['link']; ?>';">
                                                <i style="color: #f00;" class="fa fa-minus-circle" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- table-wrapper -->
    <script src="./templates/bracket/lib/jquery/jquery.js"></script>
    <script src="./templates/bracket/lib/popper.js/popper.js"></script>
    <script src="./templates/bracket/lib/bootstrap/bootstrap.js"></script>
    <script src="./templates/bracket/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="./templates/bracket/lib/moment/moment.js"></script>
    <script src="./templates/bracket/lib/jquery-ui/jquery-ui.js"></script>
    <script src="./templates/bracket/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="./templates/bracket/lib/peity/jquery.peity.js"></script>
    <script src="./templates/bracket/lib/highlightjs/highlight.pack.js"></script>
    <script src="./templates/bracket/lib/datatables/jquery.dataTables.js"></script>
    <script src="./templates/bracket/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="./templates/bracket/lib/select2/js/select2.min.js"></script>
    <?php require("footer.php"); ?>
    <script>
        $(function () {
            'use strict';

            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            $('#datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true
            });

            // Select2
            $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});
        });
    </script>

<?php } else {
    header('Location: /');
    exit;
} ?>
