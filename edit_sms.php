<?php $page_title="Edit Sms";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");

require_once("thumbnail_images.class.php");

$qry="SELECT * FROM tbl_sms WHERE `id`='".$_GET['sms_id']."'";
$result=mysqli_query($mysqli,$qry);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['submit']))
{
	$data = array( 
    'sms'  =>stripslashes($_POST['sms'])
  );
 $qry=Update('tbl_sms', $data, "WHERE id = '".$_POST['sms_id']."'");

 	
 $_SESSION['class']="success";
 $_SESSION['msg']="11";

  if(isset($_GET['redirect'])){
    header("Location:".$_GET['redirect']);
  }
  else{
    header( "Location:edit_sms.php?sms_id=".$_POST['sms_id']);
  }
  exit; 	 
}		  
?>

<div class="row">
  <div class="col-md-12">
   <?php
   if(isset($_SERVER['HTTP_REFERER']))
   {
    echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
  }
  ?>
  <div class="card">
    <div class="page_title_block">
      <div class="col-md-5 col-xs-12">
        <div class="page_title"><?=$page_title?></div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="card-body mrg_bottom"> 
      <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
        <input  type="hidden" name="sms_id" value="<?php echo $_GET['sms_id'];?>" />
        <div class="section">
          <div class="section-body">
           <div class="form-group">
            <label class="col-md-2 control-label">Sms Text:-</label>
            <div class="col-md-6">
              <textarea type="text" class="form-control typeahead" name="sms" id="sms" value="" style="height:200px;" rows="5" cols="50"><?php echo stripslashes($row['sms']);?></textarea>
            </div>
          </div> 
          <div class="form-group">
            <div class="col-md-9 col-md-offset-2">
              <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>

<?php include("includes/footer.php");?>       
