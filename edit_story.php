<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");

  $qry="SELECT * FROM tbl_stories where id='".$_GET['story_id']."'";
  $result=mysqli_query($mysqli,$qry);
  $row=mysqli_fetch_assoc($result);
	
	if(isset($_POST['submit']))
	{  
    $story_image='';
    if($_FILES['story_image']['name']!="")
    { 

        if($img_res_row['story_image']!="")
        {
            unlink('images/thumbs/'.$img_res_row['story_image']);
            unlink('images/'.$img_res_row['story_image']);
        }

        $story_image=rand(0,99999)."_".$_FILES['story_image']['name'];

        //Main Image
        $tpath1='images/'.$story_image;        
        $pic1=compress_image($_FILES["story_image"]["tmp_name"], $tpath1, 80);

        //Thumb Image 
        $thumbpath='images/thumbs/'.$story_image;   
        $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'300','300');
    }
    else{
      $story_image=$row['story_image'];
    }

    $data = array(       
      'story_title'  =>  addslashes($_POST['story_title']),   
      'story_image'  =>  $story_image,           
      'story_description'  =>  addslashes($_POST['story_description']),
      'story_date'  =>  strtotime($_POST['story_date'])
      );     
	 
    $qry=Update('tbl_stories', $data, "WHERE id = '".$_POST['story_id']."'");

         
		$_SESSION['msg']="11"; 
		header( "Location:edit_story.php?story_id=".$_POST['story_id']);
		exit;	

		 
	}
	
  $ck_file_path = getBaseUrl();
	  
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

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
              <div class="page_title">Edit Story</div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="" name="edit_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
                           
                            <input  type="hidden" name="story_id" value="<?php echo $_GET['story_id'];?>" />

              <div class="section">
                <div class="section-body">
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Story Title :-</label>
                    <div class="col-md-6">
                      <input type="text" name="story_title" id="story_title" value="<?php echo stripslashes($row['story_title']);?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Image :-
                      <p class="control-label-help">(Recommended resolution: 300x300,400x400 or Square Image)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="story_image" value="" id="fileupload" style="margin-top:10%" required>
                            <?php if(isset($_GET['story_id']) and $row['story_image']!="") {?>
                              <div class="fileupload_img"><img type="image" src="images/<?php echo $row['story_image'];?>" style="height: 120px;width: 120px" alt="story image" /></div>
                            <?php }else{
                              ?>
                              <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="story image" /></div>
                              <?php
                            } ?>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Story Description :-</label>
                    <div class="col-md-6">                    

                      <textarea name="story_description" id="story_description" class="form-control"><?php echo stripslashes($row['story_description']);?></textarea>

                      <script>
                        var roxyFileman = '<?php echo $ck_file_path;?>fileman/index.html?integration=ckeditor';
                        $(function(){
                        CKEDITOR.replace( 'story_description',{filebrowserBrowseUrl:roxyFileman, 
                          filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                          removeDialogTabs: 'link:upload;image:upload'});
                        });
                      </script>

                    </div>
                  </div><br>
 
                  <div class="form-group">
                    <label class="col-md-3 control-label">Date :-</label>
                    <div class="col-md-6">
                      <input type="text" name="story_date" id="datepicker" value="<?php echo date('m/d/Y',$row['story_date']);?>" class="form-control">
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

<script type="text/javascript">

  $("input[name='story_image']").change(function() {
    var file = $(this);

    if (file[0].files.length != 0) {
      if (isImage($(this).val())) {
        render_upload_image(this, $(this).next('.fileupload_img').find("img"));
      } else {
        $(this).val('');
        $('.notifyjs-corner').empty();
        $.notify('Only jpg/jpeg, png, gif files are allowed!', {
          position: "top center",
          className: 'error'
        });
      }
    }
  });
</script>
