<title>Cài đặt website</title>
<?php 
session_start();
if (isset($_SESSION['user_id'])) {
require("head.php");
require("menu.php"); 
?>
<div class="br-mainpanel">
<div class="br-pagebody">
    <div class="br-section-wrapper">
        <?php
        $sql = "SELECT * FROM thongtin";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) {
        ?>
          <form id="loginForm" method="" action="" novalidate="novalidate">
          <div class="row">
            <div class="col-lg">
                 <input type="text" class="form-control" id="tieude" name="tieude" required="" value="<?php echo $row['tieude']; ?>" placeholder="">
            </div>
            <div class="col-lg mg-t-10 mg-lg-t-0">
               <input type="text" class="form-control" id="appid" name="appid" required="" value="<?php echo $row['appid']; ?>">
  
            </div>
            <div class="col-lg mg-t-10 mg-lg-t-0">
            <input type="text" class="form-control" id="linktrang" name="linktrang"  required="" value="<?php echo $row['linktrang']; ?>">
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-lg">
                 <textarea rows="5" type="text" class="form-control" id="mota" name="mota" required="" value="" placeholder="Mô tả"><?php echo $row['mota']; ?></textarea>
            </div>
            <div class="col-lg mg-t-10 mg-lg-t-0">
               <input type="text" class="form-control" id="facebook" name="facebook" required="" value="<?php echo $row['facebook']; ?>">
  
            </div>
            <div class="col-lg mg-t-10 mg-lg-t-0">
            <input type="text" class="form-control" id="google" name="google"  required="" value="<?php echo $row['google']; ?>">
            </div>
             <div class="col-lg mg-t-10 mg-lg-t-0">
            <select type="text" class="form-control" id="style" name="style"  required="">
                <option value="<?php echo $row['style']; ?>">Style hiện tại : <?php echo $row['style']; ?></option>
                <option value="style.css">Style 1 (trắng)</option>
                <option value="style1.css">Style 2 (đen)</option>
            </select>
            </div>
          </div>
<br>
                <center>
            <button type="button" class="btn btn-success" name="insert-data" id="insert-data" onclick="CaiDat()">Chỉnh sửa</button></center>
 
      </form>
<?php }} ?>
               <div id="message"></div>

        </div>
        <?php require("footer.php"); ?>
</body>

<script type="text/javascript">

  function CaiDat() {
    var tieude=$("#tieude").val();
    var mota=$("#mota").val();
    var facebook=$("#facebook").val();
    var linktrang=$("#linktrang").val();
    var google=$("#google").val();
    var appid=$("#appid").val();
    var style=$("#style").val();
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {action:'CaiDat',tieude:tieude,mota:mota,facebook:facebook,linktrang:linktrang,google:google,appid:appid,style:style},
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