<?php require("../inc/config.php") ?>

<?php
 $result = mysqli_query($Nhan_connect,"SELECT * FROM phim WHERE loaiphim = 'Anime' ORDER BY thoigian DESC limit 0,8");
                if($result)
                {
                while($row = mysqli_fetch_assoc($result))
                {
                    $tap = mysqli_num_rows(mysqli_query($Nhan_connect,"SELECT `id` FROM tap WHERE link = '".$row['link']."'"));
                    echo '<li>
        <span class="country" title="">'.$row['namphim'].'</span>
        <h3>
                        <a href="'.$trangchu.'/'.$row['link'].'" title="'.$row['tenphim'].' - '.$row['tenkhac'].'">'.$row['tenphim'].'</a>
        </h3>
    </li>';
                }}
				?>

  