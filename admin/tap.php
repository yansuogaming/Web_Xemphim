<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require("head.php");
    require("menu.php");
    $url = $_GET['url'];
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
                <th class="wd-15p">Tập</th>
                <th class="wd-15p">Link player</th>
                <th class="wd-15p">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($Nhan_connect, "SELECT * FROM tap WHERE link = '$url' ORDER BY id DESC");
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Thay thế khoảng trắng bằng dấu gạch ngang trong $url và $row['tap'] cho URL
                    $url_modified = str_replace(" ", "-", $url);
                    $tap_modified = str_replace(" ", "-", $row['tap']);
                    ?>
                    <tr>
                        <td> <?php echo $row['tap']; ?></td>
                        <td><?php echo $row['player']; ?></td>
                        <td><span>
                        <a href="edittap.php?url=<?php echo $url_modified; ?>&tap=<?php echo $tap_modified; ?>&id=<?php echo $row['id']; ?>"><i
                                    class="fa fa-pencil-square" aria-hidden="true"></i></a>
                        <a onclick="if (confirm('Bạn có chắc chắc muốn xóa tập <?php echo $row["tap"]; ?>?'))
                                window.location.href='xoa.php?url=<?php echo urlencode($url); ?>&tap=<?php echo $row['tap']; ?>';">
                        <i style="color: #f00;" class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div><script src="./templates/bracket/lib/jquery/jquery.js"></script>
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
    </body>


    </html>
<?php } else {
    header('Location: /');
    exit;
} ?>