<?php require("../inc/config.php") ?>

<?php
 $result = mysqli_query($Nhan_connect,"SELECT * FROM phim WHERE loaiphim = 'Anime' ORDER BY thoigian limit 0,5");
                if($result)
                {
                while($row = mysqli_fetch_assoc($result))
                {
                    
                    $tap = mysqli_num_rows(mysqli_query($Nhan_connect,"SELECT `id` FROM tap WHERE link = '".$row['link']."'"));
                    echo ' <li>
        <span><i class="fa fa-star" aria-hidden="true"></i></span>
        <h5>
            <a title="'.$row['tenphim'].'" href="/phim/'.$row['link'].'">'.$row['tenphim'].'</a>
        </h5>
        <dfn>'.$row['tenkhac'].'</dfn>
    </li>';
                }}
				?>
