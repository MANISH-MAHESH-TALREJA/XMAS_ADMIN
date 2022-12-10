<?php 
$page_title="Add Video";
$active_page="status";

require("includes/header.php");
require("includes/connection.php");
require("includes/function.php");
require("language/language.php"); 
include("language/app_language.php");


if(isset($_POST['submit']))
{

  $video_id='-';

  if ($_POST['video_type']=='server_url')
  {
    $video_url=addslashes(trim($_POST['video_url']));
  }
  if ($_POST['video_type']=='youtube')
  {
    $video_url=addslashes(trim($_POST['video_url']));     
  }      
  else if ($_POST['video_type']=='local')
  {
    $path = "uploads/";

    $file_size=round($_FILES['video_local']['size'] / 1024 / 1024, 2);

    if($file_size > $settings_details['video_file_size'])
    {
      $video_msg=str_replace('###', $settings_details['video_file_size'], $client_lang['video_msg']);
      $video_msg=str_replace('$$$', $settings_details['video_file_duration'], $video_msg);

      $_SESSION['class']='error';
      $_SESSION['msg']=$video_msg;
      if(isset($_GET['redirect']))
      {
        header("Location:add_video.php?redirect=".$_GET['redirect']);
      }
      else{
        header( "Location:add_video.php");
      }
      exit;
    }

    $video_local=rand(0,99999)."_".str_replace(" ", "-", $_FILES['video_local']['name']);

    $tmp = $_FILES['video_local']['tmp_name'];

    if (move_uploaded_file($tmp, $path.$video_local)) 
    {
      $video_url=$video_local;
    }
    else
    {
      $_SESSION['class']='error';
      $_SESSION['msg']='Error in uploading video file!';
      header( "Location:add_video.php");

      if(isset($_GET['redirect']))
      {
        header("Location:add_video.php?redirect=".$_GET['redirect']);
      }
      else{
        header( "Location:add_video.php");
      }
      exit;
    }
  }

  $ext = pathinfo($_FILES['video_thumbnail']['name'], PATHINFO_EXTENSION);

  $video_thumbnail=rand(0,99999)."_video_thumb.".$ext;

  $tpath1='images/'.$video_thumbnail;   

  if($ext!='png')  {
    $pic1=compress_image($_FILES["video_thumbnail"]["tmp_name"], $tpath1, 80);
  }
  else{
    $tmp = $_FILES['video_thumbnail']['tmp_name'];
    move_uploaded_file($tmp, $tpath1);
  }

  $data = array(
    'video_type'  =>  $_POST['video_type'],
    'video_title'  =>  addslashes($_POST['video_title']),
    'video_url'  =>  $video_url,
    'video_id'  =>  $video_id,
    'video_layout'  =>  $_POST['video_layout'],
    'video_thumbnail'  =>  $video_thumbnail,
    'created_at'  =>  strtotime(date('d-m-Y h:i:s A')),
  );		

  $qry = Insert('tbl_video',$data);	

  $_SESSION['class']='success';
  $_SESSION['msg']="10";

  if(isset($_GET['redirect']))
  {
    header("Location:".$_GET['redirect']);
  }
  else{
    header( "Location:add_video.php");
  }

  exit;
}

?>

<!-- For Bootstrap Tags -->
<link rel="stylesheet" type="text/css" href="assets/bootstrap-tag/bootstrap-tagsinput.css">
<!-- End -->

<div class="row">
  <div class="col-md-12">
    <?php
    if(isset($_GET['redirect'])){
      echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
    }
    else{
      echo '<a href="manage_videos.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
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
        <form action="" method="post" class="form form-horizontal" enctype="multipart/form-data">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Video Title :-</label>
                <div class="col-md-6">
                  <input type="text" name="video_title" id="video_title" value="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Video Upload Option :-</label>
                <div class="col-md-6">                       
                  <select name="video_type" id="video_type" class="select2" required>  
                    <option value="server_url">Server URL</option>
                    <option value="youtube">YouTube</option> 
                    <option value="local">Browse From Computer</option>
                  </select>
                </div>
              </div>
              <div id="video_url_display" class="form-group">
                <label class="col-md-3 control-label">Video URL :-</label>
                <div class="col-md-6">
                  <input type="text" name="video_url" id="video_url" required="required" value="" class="form-control">
                </div>
              </div>
              <div id="video_local_display" class="form-group" style="display:none;">
                <label class="col-md-3 control-label">Video Upload :-
                  <p class="control-label-help">(Note : Maximum <strong><?=$settings_details['video_file_size']?>MB</strong> file size)</p>
                </label>
                <div class="col-md-6">
                  <input type="file" name="video_local" id="video_local" value="" class="form-control">
                  <div id="uploadPreview" style="display: none;background: #eee;text-align: center;">
                    <video height="400" width="100%" class="video-preview" controls="controls"/>
                  </div>
                </div>
                <br>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">Video Layout :-</label>
                <div class="col-md-6">                       
                  <select name="video_layout" id="video_layout" class="select2" required>
                    <option value="Landscape">Landscape</option>
                    <option value="Portrait">Portrait</option>
                  </select>
                </div>
              </div>

              <div id="thumbnail" class="form-group">
                <label class="col-md-3 control-label">Thumbnail Image:-
                  <p class="control-label-help">(Recommended resolution: <strong>Landscape:</strong> 800x500,650x450<br/><strong>Portrait:</strong> 720X1280, 640X1136, 350x800)</p>
                </label>

                <div class="col-md-6">
                  <div class="fileupload_block">
                    <input type="file" name="video_thumbnail" required="required" value="" id="fileupload">
                    <div id="uploadPreviewImg">
                      <div class="fileupload_img"><img type="image" src="assets/images/landscape.jpg" style="width: 150px;height: 100px;" alt="image alt" /></div>
                    </div>
                  </div>
                </div>
              </div>
              <br/>
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
  $(document).ready(function(e){

    var video_layout=$("#video_layout").val();

    $("#video_layout").on("change",function(event){

      video_layout=$(this).val();

      $("#fileupload").val('');

      if($(this).val()=='Landscape')
      {
        $("#uploadPreviewImg").find("img").css({width:"150px", height: "100px"})
      }
      else
      {
        $("#uploadPreviewImg").find("img").css({width:"120px", height: "200px"})
      }

    });

    var _URL = window.URL || window.webkitURL;

    $("#fileupload").change(function(e) {
      var file, img;
      var thisFile=$(this);

      var countCheck=0;

      if ((file = this.files[0])) {
        img = new Image();
        img.onerror = function() {
         
          $.notify('Not a valid file', {
          position: "top center",
          className: 'error'
          });
        };

        img.src = _URL.createObjectURL(file);

        if(video_layout=='Landscape')
        {
          $("#uploadPreviewImg").find("img").css({width:"150px", height: "100px"})
          $("#uploadPreviewImg").find("img").attr("src",img.src);
        }
        else
        {
          $("#uploadPreviewImg").find("img").css({width:"120px", height: "200px"})
          $("#uploadPreviewImg").find("img").attr("src",img.src);  
        }

      }

    });

    $("#video_type").change(function(){

      var type=$("#video_type").val();

      if(type=="server_url")
      {
        $("#video_url_display").show();
        $("#video_url_display").find("input").attr("required",true);
        $("#video_local_display").find("input").attr("required",false);
        $("#thumbnail").show();
        $("#video_local_display").hide();
      }
      else if(type=="youtube")
      {
        $("#video_url_display").show();
        $("#video_url_display").find("input").attr("required",true);
        $("#video_local_display").find("input").attr("required",false);
        $("#thumbnail").show();
        $("#video_local_display").hide();
      }
      else
      { 
        $("#video_local_display").find("input").attr("required",true);
        $("#video_url_display").find("input").attr("required",false);

        $("#video_url_display").hide();               
        $("#video_local_display").show();
        $("#thumbnail").show();
      }    

    });

    $('#video_local').change(function(e){

      var file_size=parseFloat(((this.files[0].size) / (1024 * 1024)).toFixed(2));
      var required_file_size=parseFloat('<?=$settings_details['video_file_size']?>');

      if(file_size <= required_file_size)
      {
        if(isVideo($(this).val())){
          $('.video-preview').attr('src', URL.createObjectURL(this.files[0]));
          $('#uploadPreview').show();
        }
        else
        {
          $('#video_local').val('');
          $('#uploadPreview').hide();
          
          $.notify("<?=$client_lang['video_allow_err']?>",{
            position: "top center",
            className: 'error'
          });
        }
      }
      else{
        $('#video_local').val('');
        $('#uploadPreview').hide();

        <?php 
        $video_msg=str_replace('###', $settings_details['video_file_size'], $client_lang['video_msg']);
        $video_msg=str_replace('$$$', $settings_details['video_file_duration'], $video_msg);
        ?>

        var msg="<?=$video_msg?>";
        $('.notifyjs-corner').empty();
        $.notify(msg,{
         // position: "top center",
          className: 'error'
        });
      
      }
    });

  });

  function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
      case 'm4v':
      case 'avi':
      case 'mp4':
      case 'mov':
      case 'mpg':
      case 'mpeg':
// etc
return true;
}
return false;
}

function getExtension(filename) {
  var parts = filename.split('.');
  return parts[parts.length - 1];
}
</script>