<?php require("../inc/config.php") ?>
<?php
 $result = mysqli_query($Nhan_connect,"SELECT * FROM phim ORDER BY RAND() limit 0,6");
                if($result)
                {
                while($row = mysqli_fetch_assoc($result))
                {
                    $tap = mysqli_num_rows(mysqli_query($Nhan_connect,"SELECT `id` FROM tap WHERE link = '".$row['link']."'"));
                    echo '<li>
        <span class="status">'.$row['namphim'].'</span>
        <img alt="'.$row['tenphim'].'" src="'.$row['thumbnail'].'">
            <a title="'.$row['tenphim'].' - '.$row['tenkhac'].'" href="/phim/'.$row['link'].'">'.$row['tenphim'].'</a>
            <dfn>'.$row['tenkhac'].'</dfn>
        <dfn>'.$row['thoigian'].'</dfn>
    </li>';
                }}
				?>

