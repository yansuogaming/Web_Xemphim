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
                 <input type="text" class="form-control" name="imageurl" id="imageurl" value="" required="" placeholder="Nhập link ảnh" placeholder="">
            </div>

            </div>
            <br>
          <center>
            <button class="btn btn-success" id="imgurupl">Upload ảnh</button>
     </center>
      </form>
     <center>
         <br>
          <div id="newimgurl">
              <div class="col-lg">
                  <p><strong><img src="" id="newimgurllink"></img></strong></p>
            </div>
       
      </div></center>
  
<script type="text/javascript">
$(function(){ 
  $('#imgurupl').on('click', function(e){
    e.preventDefault();
    var ajax = $.ajax({
      url: "api.php",
      type: "POST",
      data: {action:'Upload',url: $('#imageurl').val()},
      dataType: "html"
    });
    
    ajax.done(function(msg){
      $('#newimgurllink').html(msg).attr('src', msg);
    });
  }); 

});
</script>


        </div>
</body>



</html><?php require("footer.php"); ?>
    <?php }else {
header('Location: /');
exit;
    }?>

   