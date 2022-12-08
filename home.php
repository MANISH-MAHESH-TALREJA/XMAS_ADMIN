<?php	$page_title="Dashboard";

include("includes/header.php");
require("includes/function.php");
require("language/language.php");

$qry_wallpaper="SELECT COUNT(*) as num FROM tbl_wallpaper";
$total_wallpaper= mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper));
$total_wallpaper = $total_wallpaper['num'];

$qry_ringtone="SELECT COUNT(*) as num FROM tbl_ringtone";
$total_ringtone= mysqli_fetch_array(mysqli_query($mysqli,$qry_ringtone));
$total_ringtone = $total_ringtone['num']; 

$qry_feedback="SELECT COUNT(*) as num FROM tbl_sms";
$total_feedback= mysqli_fetch_array(mysqli_query($mysqli,$qry_feedback));
$total_feedback = $total_feedback['num'];

$qry_new_year_wallpaper="SELECT COUNT(*) as num FROM tbl_new_year_wallpaper";
$total_new_year_wallpaper= mysqli_fetch_array(mysqli_query($mysqli,$qry_new_year_wallpaper));
$total_new_year_wallpaper = $total_new_year_wallpaper['num'];

$qry_video="SELECT COUNT(*) as num FROM tbl_video";
$total_video= mysqli_fetch_array(mysqli_query($mysqli,$qry_video));
$total_video = $total_video['num'];

?>       
  
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper.php" class="card card-banner card-yellow-light">
    <div class="card-body"> <i class="icon fa fa-film fa-4x"></i>
      <div class="content">
        <div class="title">Wallpaper</div>
        <div class="value"><span class="sign"></span><?php echo $total_wallpaper;?></div>
      </div>
    </div>
  </a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_ringtones.php" class="card card-banner card-green-light">
  <div class="card-body"> <i class="icon fa fa-image fa-4x"></i>
    <div class="content">
      <div class="title">Ringtone</div>
      <div class="value"><span class="sign"></span><?php echo $total_ringtone;?></div>
    </div>
  </div>
</a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_sms.php" class="card card-banner card-orange-light">
  <div class="card-body"> <i class="icon fa fa-music fa-4x"></i>
    <div class="content">
      <div class="title">Sms</div>
      <div class="value"><span class="sign"></span><?php echo $total_feedback;?></div>
    </div>
  </div>
</a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_new_year_wallpaper.php" class="card card-banner card-orange-light">
  <div class="card-body"> <i class="icon fa fa-music fa-4x"></i>
    <div class="content">
      <div class="title">New Year Images</div>
      <div class="value"><span class="sign"></span><?php echo $total_feedback;?></div>
    </div>
  </div>
</a> 
</div>

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_videos.php" class="card card-banner card-orange-light">
  <div class="card-body"> <i class="icon fa fa-music fa-4x"></i>
    <div class="content">
      <div class="title">XMAS Videos</div>
      <div class="value"><span class="sign"></span><?php echo $total_video;?></div>
    </div>
  </div>
</a> 
</div>

</div>



        
<?php include("includes/footer.php");?>       
