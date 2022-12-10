<?php $page_title="Add Wishes";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");


if(isset($_POST['submit']))
{

  $data = array( 
    'sms'  =>  addslashes($_POST['sms']),
    'status'  => 1
  );		

  $qry = Insert('tbl_sms',$data);

  $_SESSION['msg']="10";
  header( "Location:manage_sms.php");
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
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-2 control-label">Wishes Text :-</label>
                <div class="col-md-6">
                  <textarea type="text" class="form-control typeahead"  name="sms" id="sms" value="" style="height:150px;" rows="5"></textarea>
                </div>
              </div>
              <br>
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
