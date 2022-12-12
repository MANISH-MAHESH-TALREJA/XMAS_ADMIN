<?php include("includes/connection.php");
include("includes/session_check.php");

      //Get file name
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];  

$requestUrl = $_SERVER["REQUEST_URI"];
$urlparts = Explode('/', $requestUrl);
$redirectUrl = $urlparts[count($urlparts) - 1];     

$mysqli->set_charset("utf8mb4"); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
  <meta name="viewport"content="width=device-width, initial-scale=1.0">
  <title><?php if(isset($page_title)){ echo $page_title.' | ';} ?><?php echo APP_NAME;?> </title>
  <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

  <link rel="stylesheet" type="text/css" href="assets/duDialog-master/duDialog.min.css">

  <link rel="stylesheet" href="assets/snackbar-master/snackbar.css">

  <script src="assets/ckeditor/ckeditor.js"></script>

  <style type="text/css">
    .btn_edit,.btn_cust {
      padding: 5px 10px !important;
    }

  </style>

</head>
<body>
  <div class="app app-default">
    <aside class="app-sidebar" id="sidebar">
      <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="images/<?php echo APP_LOGO;?>" alt="app logo" /></a>
        <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
      </div>
      <div class="sidebar-menu">
        <ul class="sidebar-nav">
          <li <?php if($currentFile=="home.php"){?>class="active"<?php }?>> <a href="home.php">
            <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
            <div class="title">Dashboard</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_wallpaper.php" or $currentFile=="add_wallpaper.php" or $currentFile=="edit_wallpaper.php"){?>class="active"<?php }?>> <a href="manage_wallpaper.php">
          <div class="icon"> <i class="fa fa-tree" aria-hidden="true"></i> </div>
          <div class="title">XMAS Images</div>
        </a> 
      </li>
      <li <?php if($currentFile=="manage_new_year_wallpaper.php" or $currentFile=="add_new_year_wallpaper.php" or $currentFile=="edit_new_year_wallpaper.php"){?>class="active"<?php }?>> <a href="manage_new_year_wallpaper.php">
          <div class="icon"> <i class="fa fa-image" aria-hidden="true"></i> </div>
          <div class="title">New Year Images</div>
        </a> 
      </li>
      <li <?php if($currentFile=="manage_videos.php" or $currentFile=="add_video.php" or $currentFile=="edit_video.php"){?>class="active"<?php }?>> <a href="manage_videos.php">
          <div class="icon"> <i class="fa fa-film" aria-hidden="true"></i> </div>
          <div class="title">Video Status</div>
        </a> 
      </li>
      <li <?php if($currentFile=="manage_ringtones.php" or $currentFile=="add_ringtone.php" or $currentFile=="edit_ringtone.php"){?>class="active"<?php }?>> <a href="manage_ringtones.php">
        <div class="icon"> <i class="fa fa-music" aria-hidden="true"></i> </div>
        <div class="title">Ringtones</div>
      </a> 
    </li> 
    <li <?php if($currentFile=="manage_sms.php" or $currentFile=="add_sms.php" or $currentFile=="edit_sms.php"){?>class="active"<?php }?>> <a href="manage_sms.php">
      <div class="icon"> <i class="fa fa-quote-right" aria-hidden="true"></i> </div>
      <div class="title">Wishes</div>
    </a> 
  </li>
  <li <?php if($currentFile=="manage_stories.php" or $currentFile=="add_story.php" or $currentFile=="edit_story.php"){?>class="active"<?php }?>> <a href="manage_stories.php">
      <div class="icon"> <i class="fa fa-book" aria-hidden="true"></i> </div>
      <div class="title">Stories</div>
    </a> 
  </li>
  <li <?php if($currentFile=="manage_slider.php" or $currentFile=="add_slider.php" or $currentFile=="edit_slider.php"){?>class="active"<?php }?>> <a href="manage_slider.php">
    <div class="icon"> <i class="fa fa-sliders" aria-hidden="true"></i> </div>
    <div class="title">Home Sliders</div>
  </a> 
</li>

  <li <?php if($currentFile=="manage_quiz.php" or $currentFile=="add_quiz.php" or $currentFile=="edit_quiz.php"){?>class="active"<?php }?>> <a href="manage_quiz.php">
    <div class="icon"> <i class="fa fa-question" aria-hidden="true"></i> </div>
    <div class="title">Quiz</div>
  </a> 
</li>
<li <?php if($currentFile=="send_notification.php"){?>class="active"<?php }?>> <a href="send_notification.php">
  <div class="icon"> <i class="fa fa-send" aria-hidden="true"></i> </div>
  <div class="title">Notification</div>
</a> 
</li>
<li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>> <a href="settings.php">
  <div class="icon"> <i class="fa fa-cog" aria-hidden="true"></i> </div>
  <div class="title">Settings</div>
</a> 
</li>
<?php if(file_exists('verification.php')){?>
  <li <?php if($currentFile=="verification.php"){?>class="active"<?php }?>> <a href="verification.php">
    <div class="icon"> <i class="fa fa-check-square-o" aria-hidden="true"></i> </div>
    <div class="title">Verify Purchase</div>
  </a> 
</li>
<?php }?>
<?php if(file_exists('api.php')){?>
  <li <?php if($currentFile=="api_urls.php"){?>class="active"<?php }?>> <a href="api_urls.php">
    <div class="icon"> <i class="fa fa-exchange" aria-hidden="true"></i> </div>
    <div class="title">API URLS</div>
  </a> 
</li> 

<?php }?>
</div>


</aside>   
<div class="app-container">
  <nav class="navbar navbar-default" id="navbar">
    <div class="container-fluid">
      <div class="navbar-collapse collapse in">
        <ul class="nav navbar-nav navbar-mobile">
          <li>
            <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
          </li>
          <li class="logo"> <a class="navbar-brand" href="home.php"><?php echo APP_NAME;?></a> </li>
          <li>
            <button type="button" class="navbar-toggle">
              <?php if(PROFILE_IMG){?>               
                <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
              <?php }else{?>
                <img class="profile-img" src="assets/images/profile.png">
              <?php }?>

            </button>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
          <li class="navbar-title"><?php echo APP_NAME;?></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
        <a href="https://play.google.com/store/apps/developer?id=MANISH+MAHESH+TALREJA" target="_blank" style="font-size:14px;color:#FFF;border:1px solid rgba(255, 255, 255, 0.7);padding: 8px 12px;border-radius:2px;margin-right:20px;"><i class="fa fa-android" style="padding-right:6px;"></i> View Mobile Apps</a>
          <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>               
            <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
          <?php }else{?>
            <img class="profile-img" src="assets/images/profile.png">
          <?php }?>
          <div class="title">Profile</div>
        </a>
        <div class="dropdown-menu">
          <div class="profile-info">
            <h4 class="username">Admin</h4>
          </div>
          <ul class="action">
            <li><a href="profile.php">Profile</a></li>                  
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
</nav>