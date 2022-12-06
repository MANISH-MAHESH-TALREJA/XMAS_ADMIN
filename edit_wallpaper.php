<?php $page_title="Edit Wallpaper";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");

require_once("thumbnail_images.class.php");

$qry="SELECT * FROM tbl_wallpaper WHERE `id`='".$_GET['wallpaper_id']."'";
$result=mysqli_query($mysqli,$qry);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['submit']))
{

	if($_FILES['wallpaper_image']['name']!="")
	{ 

		$file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name']);

		$albumimgnm=rand(0,99999)."_".$file_name;

    //Main Image
		$tpath1='images/'.$albumimgnm;       
		$pic1=compress_image($_FILES["wallpaper_image"]["tmp_name"], $tpath1, 80);

    //Thumb Image 
		$thumbpath='images/thumbs/'.$albumimgnm;        
		$thumb_pic1=create_thumb_image($tpath1,$thumbpath,'400','400');   

		$data = array( 
			'image'  =>  $albumimgnm,
			'tags'  =>  $_POST['tags'],
			'wall_name'  =>  $_POST['wall_name']
		);		

		$qry=Update('tbl_wallpaper', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
	}
	else
	{

		$data = array( 
			'tags'  =>  $_POST['tags']
		);    

		$qry=Update('tbl_wallpaper', $data, "WHERE id = '".$_POST['wallpaper_id']."'");

	}

	$_SESSION['msg']="11";
	header( "Location:manage_wallpaper.php?wallpaper_id=".$_POST['wallpaper_id']);
	exit;	

}


?>
<link rel="stylesheet" type="text/css" href="assets/bootstrap-tag/bootstrap-tagsinput.css">
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
					<input  type="hidden" name="wallpaper_id" value="<?php if(isset($_GET['wallpaper_id'])){echo $_GET['wallpaper_id'];}?>" />
					<div class="section">
						<div class="section-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Wallpaper Name :-</label>
								<div class="col-md-6">
									<input type="text" name="wall_name" id="wall_name" value="<?php echo $row['wall_name']?>" class="form-control">
								</div>
							</div> 

							<div class="form-group">
								<label class="col-md-3 control-label">Wallpaper Image:-  <p class="control-label-help">(Recommended resolution: 800x600 or 900x600 or 900x700 or 600x900 or 640x960 or 680x1024)</p></label>
								<div class="col-md-6">
									<div class="fileupload_block">
										<input type="file" name="wallpaper_image" value="fileupload" onchange="readURL(this)" id="fileupload">
										<?php if(isset($_GET['wallpaper_id']) AND $row['image']!="") {?>
											<div class="fileupload_img"><img id="image" type="image" src="images/<?php echo $row['image'];?>" alt="video thumbnail" style="width: 140px;height: 90px" /></div>
										<?php } else {?>
											<div class="fileupload_img"><img id="image" type="image" src="assets/images/landscape.jpg" alt="recipe image" style="width: 140px;height: 90px" /></div>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Wallpaper Tags :-</label>
								<div class="col-md-6">
									<input type="text" name="tags" id="tags" value="<?php echo $row['tags']?>" class="form-control" data-role="tagsinput">
								</div>
							</div>
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

<script type="text/javascript" src="assets/bootstrap-tag/bootstrap-tagsinput.js"></script>

<script type="text/javascript">
  $("input[name='wallpaper_image']").change(function() { 
      var file=$(this);

      if(file[0].files.length != 0){
          if(isImage($(this).val())){
            render_upload_image(this,$(this).next('.fileupload_img').find("img"));
          }
          else
          {
            $(this).val('');
            $('.notifyjs-corner').empty();
            $.notify(
            'Only jpg/jpeg, png, gif files are allowed!',
            { position:"top center",className: 'error'}
            );
          }
      }
  });
</script> 