<?php $page_title="Edit Ringtone";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");

require_once("thumbnail_images.class.php");

  //Get ringtone

$qry="SELECT * FROM tbl_ringtone WHERE `id`='".$_GET['ringtone_id']."'";
$result=mysqli_query($mysqli,$qry);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['submit']))
{

	if($_FILES['ringtone_link']['name']!=""){ 

	$path = "uploads/"; //set your folder path
	$albumimgnm=rand(0,99999)."_".str_replace(" ", "-", $_FILES['ringtone_link']['name']);
	$tmp = $_FILES['ringtone_link']['tmp_name'];
	move_uploaded_file($tmp, $path.$albumimgnm);


	$data = array( 
		'user_id'  =>  $_SESSION['id'],
		'ringtone_name'  =>  $_POST['ringtone_name'],
		'ringtone_link'  =>  $_POST['ringtone_link'],
		'ringtone_link'  =>  $albumimgnm,
		'tags'  =>  $_POST['tags']
	);

	$qry=Update('tbl_ringtone', $data, "WHERE id = '".$_POST['ringtone_id']."'");
}
else
{
	$data = array( 
		'user_id'  =>  $_SESSION['id'],
		'ringtone_name'  =>  $_POST['ringtone_name'],
		'tags'  =>  $_POST['tags']
	);

	$qry=Update('tbl_ringtone', $data, "WHERE id = '".$_POST['ringtone_id']."'");
}

 $_SESSION['class']="success";
 $_SESSION['msg']="11";

	if(isset($_GET['redirect'])){
		header("Location:".$_GET['redirect']);
	}
	else{
		header( "Location:edit_ringtone.php?ringtone_id=".$_POST['ringtone_id']);
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
		<form action="" name="edit_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
		  <input type="hidden" name="ringtone_id" value="<?php echo $_GET['ringtone_id'];?>" />
		  <div class="section">
			<div class="section-body">
			   <div class="form-group">
				<label class="col-md-3 control-label">Ringtone Name :-</label>
				<div class="col-md-6">
				  <input type="text" name="ringtone_name" id="ringtone_name" value="<?php echo stripslashes($row['ringtone_name']);?>" class="form-control" required>
				</div>
			  </div>
			  <div id="video_url_display" class="form-group">
				<label class="col-md-3 control-label">Tags :-</label>
				<div class="col-md-6">
				  <input type="text" name="tags" id="tags" value="<?php echo $row['tags']?>" class="form-control">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-md-3 control-label">Select Ringtone :-
				</label>
				<div class="col-md-6">
				  <div class="fileupload_block">
					<input type="file" class="span6 typeahead" name="ringtone_link" id="ringtone_link" value="">
					<div class="fileupload_img"><source src="audio" src="uploads/" alt="category image" type="audio/ogg"/></div>
				  </div>
				</div>
			  </div> 
			   <div class="form-group">
				<label class="col-md-3 control-label">&nbsp; </label>
				<div class="col-md-3">
				  <audio controls="controls" >
				  <source src="uploads/<?php echo $row['ringtone_link'];?>" type="audio/ogg"/>
				  </audio>	
				</div>                    
				</div>
			  </div>
			  <br> 
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

<?php include("includes/footer.php");?>       
