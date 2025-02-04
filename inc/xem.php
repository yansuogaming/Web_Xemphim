<?php
$sql = "
SELECT phim.*, loaiphim.ten_loai, loaiphim.slug AS loaiphim_slug, theloai.ten_theloai, theloai.slug AS theloai_slug 
FROM phim 
LEFT JOIN loaiphim ON phim.loaiphim = loaiphim.id 
LEFT JOIN theloai ON phim.theloai = theloai.id 
WHERE phim.link = '$url_phim'";


$result = $conn->query($sql);
if ($result->num_rows > 0)
{
while ($row = $result->fetch_assoc()) {
    ?>

    <div class="breadcrumb">
        <div class="item">
            <a href="<?php echo $trangchu ?>">
                <span>Trang chủ</span>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo $trangchu ?>/danh-sach/<?php echo $row['loaiphim'] ?>">
                <span><?php echo $row['ten_loai']; ?></span>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo $trangchu ?>/phim/<?php echo $row['link'] ?>" title="<?php echo $row['tenphim'] ?>">
                <span><?php echo $row['tenphim'] ?></span>
            </a>
        </div>
        <div class="item">
            <span><?php echo $taphientai ?></span>
        </div>
    </div>
    <div id="media">
        <div class="player-wrapper">
            <meta itemprop="description" content="<?php echo $row['mota'] ?>">
            <div class="box-rating" itemprop="aggregateRating" itemscope=""
                 itemtype="http://schema.org/AggregateRating">
                <div>
                    <span class="hidden-vt" id="average" itemprop="ratingValue">10</span>
                    <span class="hidden-vt" id="rate_count" itemprop="reviewCount">0</span>
                </div>
                <meta itemprop="bestRating" content="10">
                <meta itemprop="worstRating" content="1">
            </div>
            <?php
            $sql = "SELECT * FROM tap WHERE tap = '$taphientai' AND link = '$url_phim'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
            while ($row = $result->fetch_assoc()) {
            ?>
            <div>
                <div>
                    <div id="VoHuuNhan">
                        <iframe style="border: 0;width: 100%;height: 100%;max-height: 300px;" src="<?php
                        echo '' . $trangchu . '/inc/crypt.php?' . split_link(encrypte('' . $trangchu . '/pages/api/Player.php?url=' . $row['player'] . '', 'hashv1.00'));
                        ?>"></iframe>
                    </div>
                </div>
            </div>
            <div class="controls" itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate">
                <a target="_blank" href="<?php echo $trangchu ?>/download/<?php echo $url_phim ?>">
                    <div class="download"><i></i><span>Download</span></div>
                </a>
                <div class="light"><i></i></div>
                <div class="autonext active"><i></i></div>
                <div class="toggle-size playermini" data-on="Thu nhỏ" data-off="Phóng to">
                    <i class="fa fa-exchange"></i> <span>Phóng to</span>
                </div>

            </div>
        </div>
        <div class="main-controls">
            <div class="server-list" style="margin-left: 0px !important;">
                <div class="server-wrapper">

                    <h3 class="watch">Danh sách tập phim</h3>
                    <div class="server" data-type="watch">
                        <label>Server chính (<?php
                            $LoaiPhim = $row['player'];
                            if (strpos($LoaiPhim, 'https://drive.google.com') !== false) {
                                echo 'Google Drive';
                            }
                            
                            if (strpos($LoaiPhim, 'ok.ru/videoembed') !== false) {
                                echo 'Ok.ru';
                            }
                            if (strpos($LoaiPhim, 'dailymotion.com/player') !== false) {
                                echo 'Dailymotion';
                            }
                            if (strpos($LoaiPhim, 'mega.nz/embed') !== false) {
                                echo 'MegaNZ';
                            }
                            ?>)
                        </label>
                        <ul class="episodes">
                            <?php $sql = "SELECT * FROM tap WHERE link = '$url_phim' ORDER BY id ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <li><a class="<?php if ($row['tap'] == "$taphientai") {
                                            echo 'active';
                                        } ?>" id="ep_<?php echo "" . $row["tap"] . ""; ?>"
                                           title="Xem Tập <?php echo $row['tap'] ?>"
                                           href="<?php echo $trangchu ?>/xem/<?php echo $row['link'] ?>/<?php echo $row['tap'] ?>"
                                           data-id="<?php echo "" . $row["tap"] . ""; ?>"><?php echo $row['tap'] ?></a>
                                    </li>    <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div><?php }
        } ?>

    </div>
    <div class="widget info">

        <div class="widget-title clear-top">
            <div class="tabs" data-target=".widget-body .content">
                <div class="tab active" data-name="content"><span>Bình luận về phim</span></div>
            </div>
        </div>
        <div class="widget-body">
            <div class="content" data-name="content">
                <div data-numposts="5" data-order-by="reverse_time" colorscheme="dark" data-colorscheme="dark"
                     data-width="100%" width="100%" class="fb-comments"
                     data-href="<?php echo $trangchu ?>/Info/<?php echo $url_phim ?>" data-numposts="50"></div>
            </div>
        </div> <?php }
        } ?>
        <?php require("../inc/related.php"); ?>
        </ul>
    </div>
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $appid ?>&autoLogAppEvents=1"></script>
<?php
$sql = "SELECT * FROM tap WHERE tap = '$taphientai' AND link = '$url_phim'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <?php
        $url = htmlentities($row["player"]);
        $players = explode("/", parse_url($url)['path'])[3];
        ?>
        <script type="text/javascript" src="<?php echo $trangchu ?>/assets/js/jwplayer.js"></script>


    <?php }
} ?>