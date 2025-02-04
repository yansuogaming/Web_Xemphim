<div class="widget update">
                <div class="widget-title">
                    <h3 class="title">Kết quả tìm kiếm cho <?php echo $ten ?></h3>
                    <div class="tabs" data-target=".widget.update .widget-body .content">
                        <div class="tab active" data-name="all"><span><b id="soketqua"></b> kết quả</span></div>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="content" id="all" data-name="all">
                        <ul id="ketqua" class="list-film">
                            <?php require("../inc/search.php"); ?>

                        </ul>
                      
                    </div>

                   

                   
                </div>
            </div>
            <script>
  var c = document.getElementById("ketqua").childElementCount;
  document.getElementById("soketqua").innerHTML = c;
</script>