<?php
session_start();
if (isset($_SESSION['user_id'])) {
require("head.php");
require("menu.php");
?>
<div class="br-mainpanel">
<div class="br-pagebody">
    <div class="br-section-wrapper">
          <form id="loginForm" method="" action="" novalidate="novalidate">
          <div class="row">
            <div class="col-lg">
                 <input type="text" class="form-control" id="tieude" name="tieude" value="" required="" placeholder="Tiêu đề Website" placeholder="">
            </div><!-- col -->
              <div class="col-lg mg-t-10 mg-lg-t-0">
            <input type="text" class="form-control" id="url" name="url"  required="" placeholder="Link Website">
            </div>
            <div class="col-lg mg-t-10 mg-lg-t-0">
               <textarea rows="5" type="text" class="form-control" id="mota" name="mota" value="" required="" placeholder="Mô tả website"></textarea>

            </div><!-- col -->
          <!-- col -->
          </div><!-- row -->
<br>
                <center>
            <button type="button" class="btn btn-success" name="insert-data" id="insert-data" onclick="Backlinks()">Thêm Backlink</button></center>

      </form>

               <div id="message"></div>

        </div>
        <?php require("footer.php"); ?>
</body>

<script type="text/javascript">

  function Backlinks() {
    var tieude=$("#tieude").val();
    var mota=$("#mota").val();
    var url=$("#url").val();
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {action:'Backlink',tieude:tieude,mota:mota,url:url},
            dataType: "JSON",
             success: function(data) {
             $("#message").html(data);
            $("p").addClass("alert alert-success");
            },
            error: function(err) {
            alert(err);
            }
        });

}

  </script>

</html>
    <?php }else {
header('Location: /');
exit;
    }?>