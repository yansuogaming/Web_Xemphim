<?php require("../inc/config.php") ?>
<?php
 $result = mysqli_query($Nhan_connect,"SELECT * FROM phim WHERE loaiphim = 'Sắp chiếu' ORDER BY thoigian");
                if($result)
                {
                while($row = mysqli_fetch_assoc($result))
                {
                    $tap = mysqli_num_rows(mysqli_query($Nhan_connect,"SELECT `id` FROM tap WHERE link = '".$row['link']."'"));
                    echo '<li>
        <div class="poster">
            <a title="'.$row['mota'].'" href="/phim/'.$row['link'].'">
                <img alt="'.$row['tenphim'].'" src="'.$row['thumbnail'].'">
            </a>
             <span class="mli-eps">TẬP<i>'.$tap.'</i></span>
        </div>
        <div class="name">
            <h4>
                <a title="'.$row['mota'].'" href="/phim/'.$row['link'].'">'.$row['tenphim'].' ('.$row['namphim'].')</a>
            </h4>
            <dfn>'.$row['tenkhac'].'</dfn>
        </div>
    </li>';
                }}
				?>
