  <div class="widget-title clear-top"><div class="title up">Có thể bạn muốn xem</div></div>
                    <div class="widget-body">
                        <ul class="list-film">
                            <?php
$sql = "SELECT * FROM phim ORDER BY RAND() limit 0,8";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) {
        $tap = mysqli_num_rows(mysqli_query($Nhan_connect,"SELECT `id` FROM tap WHERE link = '".$row['link']."'"));
?>

                            <li>
        <div class="poster">
            <a title="<?php echo $row['tenphim']?> - <?php echo $row['tenkhac']?>" href="<?php echo $trangchu ?>/phim/<?php echo $row['link']?>">
                <img alt="<?php echo $row['tenphim']?>" src="<?php echo $row['thumbnail']?>">
            </a>
             <span class="mli-eps">TẬP<i><?php echo $tap ?></i></span>
        </div>
        <div class="name">
            <h4>
                <a title="<?php echo $row['tenphim']?> - <?php echo $row['tenkhac']?>" href="<?php echo $trangchu ?>/phim/<?php echo $row['link']?>"><?php echo $row['tenphim']?></a>
            </h4>
            <dfn><?php echo $row['tenkhac']?></dfn>
        </div>
    </li>
          <?php }} ?>