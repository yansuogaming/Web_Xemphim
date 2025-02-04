<div class="widget update">
                <div class="widget-title">
                    <h3 class="title">Danh sách <?php echo $theloai ?></h3>
                    <div class="tabs" data-target=".widget.update .widget-body .content">
                        <div class="tab active" data-name="all"><span>Tất cả <?php echo $theloai ?></span></div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="content" id="all" data-name="all">
                        <ul class="list-film">
                            <?php require("../inc/list_phim4.php"); ?>

                        </ul>
                            <script type="text/javascript" src="<?php echo $trangchu ?>/assets/js/loadmore.js"></script>


                    </div>




                </div>
            </div>

