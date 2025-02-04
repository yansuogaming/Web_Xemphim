</div></div>
<?php
require("../inc/config.php");
?>
<script>
    	$('#gui').click(function(){
				var mess = $('#tinhan').val();
				if (mess == '') {
					alert("Vui lòng đầy đủ");
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('../inc/chat.php', {
					mess: mess,
				}, function(data, status) {
					$("#Chat").html(data);
					$('#tinhan').val('');
				});
			}) 
			
$(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
		var mess = $('#tinhan').val();
				if (mess == '') {
				alert("Vui lòng đầy đủ");
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('../inc/chat.php', {
					mess: mess,
				}, function(data, status) {
					$("#Chat").html(data);
					$('#tinhan').val('');
				});
	}
});

</script>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="left">
                <ul class="column-links">
                    <h5>Liên kết</h5>
                    <ul style="overflow-y: scroll;list-style: none;overflow: auto;padding: 0;max-height: 148px;overflow: overlay;">
                        <?php
 $result = mysqli_query($Nhan_connect,"SELECT * FROM backlink ORDER BY id ASC");
                if($result)
                {
                while($row = mysqli_fetch_assoc($result))
                {
				?>
                        <li><a target="_blank" class="lienket" rel="dofollow" href="<?php echo $row["url"] ?>" title="<?php echo $row["mota"] ?>"><?php echo $row["tieude"] ?></a></li>

                        	<?php
				}}
			?>
                    </ul>
                </ul>
                <!--<ul class="column-links">
                    <h5>Quốc Gia</h5>
                    <ul>
                        <li><a href="/quoc-gia/phim-viet-nam" title="phim việt nam">Phim việt nam</a></li>
                        <li><a href="/quoc-gia/phim-au-my" title="phim mỹ">Phim mỹ</a></li>
                        <li><a href="/quoc-gia/phim-han-quoc" title="phim hàn quốc">Phim hàn quốc</a></li>
                        <li><a href="/quoc-gia/phim-hong-kong" title="phim hồng kong">Phim hồng kong</a></li>
                        <li><a href="/quoc-gia/phim-thai-lan" title="phim thái lan">Phim thái lan</a></li>
                    </ul>
                </ul>
                <ul class="column-links">
                    <h5>Nổi Bật</h5>
                    <ul>
                        <ul>
	<li><a href="/phim/gap-go-i0-6629" title="gặp gỡ">gặp gỡ - encounter</a></li>
</ul>
                    </ul>
                </ul>-->
            </div>
            <div class="right">
                <ul class="column-links">
                    <h5>Liên Hệ</h5>
                    <ul><li><!--email_off-->yansuogaming@gmail.com<!--/email_off--></li></ul>
                </ul>
            </div>
        </div>
        <div class="links">
            <div class="powered">Copyright @ 2025 Xem Phim Online. Edit by Yansuo
            </div>
            <div class="link">
                <a href="sitemap.xml">Sitemap</a>
            </div>
        </div>
    </div>
</div>
