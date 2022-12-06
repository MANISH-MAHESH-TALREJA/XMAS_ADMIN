<?php $page_title="Add Ringtone";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");

if(isset($_POST['submit']))
{

 	$path = "uploads/"; //set your folder path
  $albumimgnm=rand(0,99999)."_".str_replace(" ", "-", $_FILES['ringtone_link']['name']);

  $tmp = $_FILES['ringtone_link']['tmp_name'];

  move_uploaded_file($tmp, $path.$albumimgnm);


  $data = array( 
   'user_id'  =>  $_SESSION['id'],
   'ringtone_name'  =>  $_POST['ringtone_name'],
   'ringtone_link'  =>  $albumimgnm,
   'tags'  =>  $_POST['tags'],
   'status'  =>  1
 );		

  $qry = Insert('tbl_ringtone',$data);	

  $_SESSION['msg']="10";
  header( "Location:manage_ringtones.php");
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
            <form action="" name="add_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Ringtone Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="ringtone_name" id="ringtone_name" value="" class="form-control" required>
                    </div>
                  </div>
                   <div  class="form-group">
                    <label class="col-md-3 control-label">Ringtone Tags :-</label>
                    <div class="col-md-6">
                      <input type="text" name="tags" id="tags" value="" class="form-control">
                    </div>
                  </div>
				      <div  class="form-group">
                    <label class="col-md-3 control-label">Select Ringtone  :-
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
						<input type="file" class="span6 typeahead" name="ringtone_link" id="ringtone_link" value="">
                      </div>
                    </div>
                  </div>
                  <div>&nbsp;</div>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
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
