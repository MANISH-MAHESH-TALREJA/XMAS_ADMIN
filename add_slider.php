<?php $page_title='Add Slider';

include("includes/header.php");
require("includes/function.php");
require("language/language.php");

if(isset($_POST['submit']) and isset($_GET['add']))
{

  $slider_type=trim($_POST['slider_type']);

  $slider_title=$slider_file=$external_url='';

  if($slider_type=='external')
  {

    $ext = pathinfo($_FILES['slider_file']['name'], PATHINFO_EXTENSION);

    $slider_file=rand(0,99999)."_slider.".$ext;

          //Main Image
    $tpath1='images/'.$slider_file;   

    if($ext!='png')  {
      $pic1=compress_image($_FILES["slider_file"]["tmp_name"], $tpath1, 80);
    }
    else{
      $tmp = $_FILES['slider_file']['tmp_name'];
      move_uploaded_file($tmp, $tpath1);
    }

    $post_id=0;
    $slider_title=addslashes(trim($_POST['slider_title']));
    $external_url=addslashes(trim($_POST['external_url']));
  }
  else
  {

    $data_status = array('is_slider'  =>  '1');

    switch ($slider_type) {
      case 'video':
        $post_id=$_POST['video_id'];
        $edit_status=Update('tbl_video', $data_status, "WHERE id = ".$post_id);
        break;

      case 'christmas_images':
        $post_id=$_POST['wallpaper_id'];
        $edit_status=Update('tbl_wallpaper', $data_status, "WHERE id = ".$post_id);
        break;
      
      case 'new_year_images':
        $post_id=$_POST['new_year_wallpaper_id'];
        $edit_status=Update('tbl_new_year_wallpaper', $data_status, "WHERE id = ".$post_id);
        break;

      default:
      break;
    }
  }

  if($post_id!=0)
  {
    $sql="SELECT * FROM tbl_slider WHERE `post_id`='$post_id' AND `slider_type`='$slider_type' AND `status`='1'";
    $res=mysqli_query($mysqli, $sql);
    if($res->num_rows > 0)
    {
      $_SESSION['class']='alert-danger';
      $_SESSION['msg']='This '.ucwords($slider_type)." is already exists !!";
      header( "Location:add_slider.php?add");
      exit;
    }
  }


  $data = array(
    'post_id' =>  $post_id,
    'slider_type' =>  $slider_type,
    'slider_title' =>  $slider_title,
    'external_url' =>  $external_url,
    'external_image' =>  $slider_file
  );  

  $qry = Insert('tbl_slider',$data);

  if($slider_type!='external')
  {

    $data_status = array('is_slider'  =>  '1');

    switch ($slider_type) {
      case 'video':
      $post_id=$_POST['video_id'];
      $edit_status=Update('tbl_video', $data_status, "WHERE id = ".$post_id);
      break;

      case 'christmas_images':
      $post_id=$_POST['wallpaper_id'];
      $edit_status=Update('tbl_wallpaper', $data_status, "WHERE id = ".$post_id);
      break;

      case 'new_year_images':
        $post_id=$_POST['new_year_wallpaper_id'];
        $edit_status=Update('tbl_new_year_wallpaper', $data_status, "WHERE id = ".$post_id);
        break;

      default:
      break;
    }
  } 

  $_SESSION['msg']="26";
  header( "Location:manage_slider.php");
  exit; 
}
?>

<div class="row">
  <div class="col-md-12">
   <?php
   if(isset($_GET['redirect'])){
     echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
   }
   else{
     echo '<a href="manage_slider.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
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
      <form action="" name="addeditlanguage" method="post" class="form form-horizontal" enctype="multipart/form-data">

        <div class="section">
          <div class="section-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Type :-</label>
              <div class="col-md-6">
                <select class="select2" required="" name="slider_type">
                  <option value="video">Video Status</option>
                  <option value="christmas_images">Christmas Images</option>
                  <option value="new_year_images">New Year Images</option>
                  <option value="external">External Banner</option>
                </select>
              </div>
            </div>
            <div class="form-group video_status">
              <label class="col-md-3 control-label" for="id">Video :-</label>
              <div class="col-md-6">
                <select name="video_id" id="video_id" class="select2" required="">
                  <option value="">-- Select Video Status--</option>
                  <?php
                  $sql="SELECT * FROM tbl_video WHERE tbl_video.`status`='1' ORDER BY tbl_video.`id` DESC";
                  $res=mysqli_query($mysqli, $sql);
                  while($row=mysqli_fetch_assoc($res))
                  {
                    $video_file=$row['video_url'];

                    if($row['video_type']=='youtube')
                    {
                        $video_file=str_replace('watch?v=','embed/', $row['video_url']);
                    }

                    if($row['video_type']=='local')
                    {
                      $video_file=$file_path.'uploads/'.basename($row['video_url']);
                    }
                    ?>
                    <option data-url="<?=$video_file?>" value="<?php echo $row['id'];?>"><?php echo $row['video_title'];?></option>                       
                    <?php
                  }
                  mysqli_free_result($res);
                  ?>
                </select>
                <iframe class="preview" width="100%" height="500" style="border:0;display: none;margin-bottom: 10px" src="" ></iframe>
              </div>
            </div>
            <div class="form-group christmas_status" style="display: none;">
              <label class="col-md-3 control-label" for="wallpaper_id">Christmas Images :-</label>
              <div class="col-md-6">
                <select name="wallpaper_id" id="wallpaper_id" class="select2">
                  <option value="">-- Select Christmas Images --</option>
                  <?php
                  $sql="SELECT * FROM tbl_wallpaper WHERE tbl_wallpaper.`status`=1 ORDER BY tbl_wallpaper.`id` DESC";
                  $res=mysqli_query($mysqli, $sql);
                  while($row=mysqli_fetch_array($res))
                  {
                    ?>                       
                    <option data-url="images/<?php echo $row['image'];?>" value="<?php echo $row['id'];?>"><?php echo $row['wall_name'];?></option>                           
                    <?php
                  }
                  mysqli_free_result($res);
                  ?>
                </select>
                <img class="preview" src="" width="100%" height="auto" style="display: none;margin-bottom: 10px" />
              </div>
            </div>
            <div class="form-group new_year_status" style="display: none;">
              <label class="col-md-3 control-label" for="new_year_wallpaper_id">New Year Images :-</label>
              <div class="col-md-6">
                <select name="new_year_wallpaper_id" id="new_year_wallpaper_id" class="select2">
                  <option value="">-- Select New Year Images --</option>
                  <?php
                  $sql="SELECT * FROM tbl_new_year_wallpaper WHERE tbl_new_year_wallpaper.`status`=1 ORDER BY tbl_new_year_wallpaper.`id` DESC";
                  $res=mysqli_query($mysqli, $sql);
                  while($row=mysqli_fetch_array($res))
                  {
                    ?>                       
                    <option data-url="images/<?php echo $row['image'];?>" value="<?php echo $row['id'];?>"><?php echo $row['wall_name'];?></option>                           
                    <?php
                  }
                  mysqli_free_result($res);
                  ?>
                </select>
                <img class="preview" src="" width="100%" height="auto" style="display: none;margin-bottom: 10px" />
              </div>
            </div>
            <div class="external_banner" style="display: none;">
              <div class="form-group">
                <label class="col-md-3 control-label">Title :-</label>
                <div class="col-md-6">
                  <input type="text" name="slider_title" placeholder="Enter title" id="slider_title" value="<?php echo $row['slider_title'];?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="external_url">External URL :-</label>
                <div class="col-md-6">
                  <input type="text" name="external_url" placeholder="Enter external url" id="external_url" value="<?php echo $row['external_url'];?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Select Image :-
                  <p class="control-label-help">(Recommended resolution: Landscape: 800x500, 650x450)</p>
                </label>
                <div class="col-md-6">
                  <div class="fileupload_block">
                    <input type="file" name="slider_file" value="fileupload" id="fileupload" accept=".png, .jpg, .jpeg">
                    <div id="uploadPreview" class="fileupload_img"><img type="image" src="assets/images/landscape.jpg" alt="image alt"/></div>
                  </div>
                  <div class="fileupload_img" id="uploadPreview">
                    <?php if(isset($_GET['edit_id'])){ ?>
                      <img width="100%" src="images/<?php echo $row['slider_file']?>"/>
                    <?php } ?>
                  </div>
                </div>
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
  $("select[name='slider_type']").on("change",function(e)
  {
    var type=$(this).val();

    $(".video_status").find("select").attr("required",false);
    $(".christmas_status").find("select").attr("required",false);
    $(".new_year_status").find("select").attr("required",false);
    $(".external_banner").find("input").attr("required",false);
    
    switch (type) 
    {
      case 'video':
      {
        $(".video_status").show();
        $(".video_status").find("select").attr("required",true);
        $(".christmas_status").hide();
        $(".new_year_status").hide();
        $(".external_banner").hide();
      }
      break;

      case 'christmas_images':
      {

        $(".christmas_status").show();
        $(".christmas_status").find("select").attr("required",true);
        $(".video_status").hide();
        $(".new_year_status").hide();
        $(".external_banner").hide();

      }
      break;

      case 'new_year_images':
      {

        $(".new_year_status").show();
        $(".new_year_status").find("select").attr("required",true);
        $(".video_status").hide();
        $(".christmas_status").hide();
        $(".external_banner").hide();

      }
      break;

      case 'external':
      {
        $(".external_banner").show();
        $(".external_banner").find("input").attr("required",true);
        $(".video_status").hide();
        $(".new_year_status").hide();
        $(".christmas_status").hide();

      }
      break;
    }

  });

  $("select[name='video_id']").on("change",function(e){
    var url=$(this).children("option:selected").data("url");
    $(this).parent("div").find(".preview").attr('src',url);
    $(this).parent("div").find(".preview").show();
  });

  $("select[name='wallpaper_id']").on("change",function(e){
    var url=$(this).children("option:selected").data("url");
    $(this).parent("div").find(".preview").attr('src',url);
    $(this).parent("div").find(".preview").show();
  });

  $("select[name='new_year_wallpaper_id']").on("change",function(e){
    var url=$(this).children("option:selected").data("url");
    $(this).parent("div").find(".preview").attr('src',url);
    $(this).parent("div").find(".preview").show();
  });


  var _URL = window.URL || window.webkitURL;

  var _URL = window.URL || window.webkitURL;

$("#fileupload").change(function(e) {
  var file, img;
  var thisFile=$(this);

  var countCheck=0;
  
  if ((file = this.files[0])) {
      img = new Image();
      img.onload = function() {
          if(this.width < this.height){
            alert("Image width must be greater than image height !");
            thisFile.val('');
            $('#uploadPreview').html('');
            return false;
          }
          else if(this.width == this.height){
            alert("Image width must not equal to image height !");
            thisFile.val('');
            $('#uploadPreview').html('');
            return false;
          }
          
      };
      img.onerror = function() {
          alert( "not a valid file: " + file.type);
      };

      img.src = _URL.createObjectURL(file);
      
      $('#uploadPreview').html('<img src="'+img.src+'" style="width:180px;height:90px;"/>');

  }

});
</script>