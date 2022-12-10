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

$qry_story="SELECT COUNT(*) as num FROM tbl_stories";
$total_story= mysqli_fetch_array(mysqli_query($mysqli,$qry_story));
$total_story = $total_story['num'];

function array_msort($array, $cols)
{
  $colarr = array();
  foreach ($cols as $col => $order) {
    $colarr[$col] = array();
    foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
  }
  $eval = 'array_multisort(';
  foreach ($cols as $col => $order) {
    $eval .= '$colarr[\''.$col.'\'],'.$order.',';
  }
  $eval = substr($eval,0,-1).');';
  eval($eval);
  $ret = array();
  foreach ($colarr as $col => $arr) {
    foreach ($arr as $k => $v) {
      $k = substr($k,1);
      if (!isset($ret[$k])) $ret[$k] = $array[$k];
      $ret[$k][$col] = $array[$k][$col];
    }
  }
  return $ret;
}

?>    
<style type="text/css">
  .table > tbody, .table > tbody > tr, .table > tbody > tr > td{
    display: block !important;
  }
</style>     
  <div class="btn-floating" id="help-actions">
      <div class="btn-bg"></div>
      <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"> <i class="icon fa fa-plus"></i> <span class="help-text">Shortcut</span> </button>
      <div class="toggle-content">
        <ul class="extra_actions">
            <li><a href="http://manishtalreja.com" target="_blank">MANISH MAHESH TALREJA</a></li>
            <li><a href="https://play.google.com/store/apps/developer?id=MANISH+MAHESH+TALREJA" target="_blank">MMT - PLAY STORE</a></li>
        </ul>
      </div>
    </div>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper.php" class="card card-banner card-green-light">
    <div class="card-body"> <i class="icon fa fa-film fa-4x"></i>
      <div class="content">
        <div class="title">Wallpaper</div>
        <div class="value"><span class="sign"></span><?php echo $total_wallpaper;?></div>
      </div>
    </div>
  </a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_ringtones.php" class="card card-banner card-skyeblue-light">
  <div class="card-body"> <i class="icon fa fa-image fa-4x"></i>
    <div class="content">
      <div class="title">Ringtone</div>
      <div class="value"><span class="sign"></span><?php echo $total_ringtone;?></div>
    </div>
  </div>
</a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_sms.php" class="card card-banner card-alicerose-light">
  <div class="card-body"> <i class="icon fa fa-quote-right fa-4x"></i>
    <div class="content">
      <div class="title">Wishes</div>
      <div class="value"><span class="sign"></span><?php echo $total_feedback;?></div>
    </div>
  </div>
</a> 
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_new_year_wallpaper.php" class="card card-banner card-pink-light">
  <div class="card-body"> <i class="icon fa fa-music fa-4x"></i>
    <div class="content">
      <div class="title">New Year Images</div>
      <div class="value"><span class="sign"></span><?php echo $total_feedback;?></div>
    </div>
  </div>
</a> 
</div>

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_videos.php" class="card card-banner card-blue-light">
  <div class="card-body"> <i class="icon fa fa-music fa-4x"></i>
    <div class="content">
      <div class="title">Video Status</div>
      <div class="value"><span class="sign"></span><?php echo $total_video;?></div>
    </div>
  </div>
</a> 
</div>

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_stories.php" class="card card-banner card-aliceblue-light">
  <div class="card-body"> <i class="icon fa fa-book fa-4x"></i>
    <div class="content">
      <div class="title">Stories</div>
      <div class="value"><span class="sign"></span><?php echo $total_story;?></div>
    </div>
  </div>
</a> 
</div>

</div>

<div class="row">
  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Viewed Video Status</h3>
      <p>Christmas Video Status With Most Views</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_video="SELECT id,video_title, video_thumbnail, total_viewer FROM tbl_video WHERE `status`='1' AND `total_viewer` > 5 ORDER BY `total_viewer` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_video);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['video_title'];
          $data['image']=$row_data['video_thumbnail'];
          $data['total_views']=$row_data['total_viewer'];
          $data['status_type']='Video Status';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <img src="<?='images/'.$row['image']?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: fill;"/> 
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Viewed XMAS Images</h3>
      <p>Christmas Wallpapers With Most Views</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_query="SELECT * FROM tbl_wallpaper WHERE `status`='1' AND `total_views` > 5 ORDER BY `total_views` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_query);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['wall_name'];
          $data['image']=$row_data['image'];
          $data['total_views']=$row_data['total_views'];
          $data['status_type']='XMAS Images';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <img src="<?='images/'.$row['image']?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: fill;"/> 
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Viewed New Year Images</h3>
      <p>New Year Images With Most Views</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_query="SELECT * FROM tbl_new_year_wallpaper WHERE `status`='1' AND `total_views` > 5 ORDER BY `total_views` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_query);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['wall_name'];
          $data['image']=$row_data['image'];
          $data['total_views']=$row_data['total_views'];
          $data['status_type']='New Year Images';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <img src="<?='images/'.$row['image']?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: fill;"/> 
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Played Ringtones</h3>
      <p>Ringtones With Most Plays</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_query="SELECT * FROM tbl_ringtone WHERE `status`='1' AND `total_views` > 5 ORDER BY `total_views` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_query);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['ringtone_name'];
          $data['total_views']=$row_data['total_views'];
          $data['status_type']='Ringtones';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                <img src="<?='images/'.APP_LOGO?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: cover;"/>
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Sent Wishes</h3>
      <p>Wishes With Most Sends</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_query="SELECT * FROM tbl_sms WHERE `status`='1' AND `total_views` > 5 ORDER BY `total_views` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_query);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['sms'];
          $data['total_views']=$row_data['total_views'];
          $data['status_type']='Wishes';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                <img src="<?='images/'.APP_LOGO?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: cover;"/>
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3 style="font-size:20px;">Most Read Stories</h3>
      <p>Stories With Most Reads</p>
      <table class="table table-hover">
        <?php

        $statuses=array();

        $sql_query="SELECT * FROM tbl_stories WHERE `status`='1' AND `story_views` > 5 ORDER BY `story_views` DESC LIMIT 5";
        $res=mysqli_query($mysqli, $sql_query);

        while($row_data=mysqli_fetch_assoc($res)){
          $data['id']=$row_data['id'];
          $data['title']=$row_data['story_title'];
          $data['image']=$row_data['story_image'];
          $data['total_views']=$row_data['story_views'];
          $data['status_type']='Wishes';

          array_push($statuses, $data);
        }

        mysqli_free_result($res);

        $statuses = array_msort($statuses, array('total_views'=>SORT_DESC));

        if(!empty($statuses))
        {
          foreach ($statuses as $key => $row) {

            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <img src="<?='images/'.$row['image']?>" style="width: 40px;height: 40px;border-radius: 50px;object-fit: fill;"/> 
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['title']?>" style="color: inherit;">
                    <?php 
                    if(strlen($row['title']) > 25)
                    {
                      echo substr(stripslashes($row['title']), 0, 25).'...';  
                    }else{
                      echo $row['title'];
                    }
                    ?>
                    <p style="font-weight: 500;margin-bottom:0"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;"><?=ucfirst($row['status_type'])?></span> | Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
          <?php }
        }
        else{
          ?>
          <tr>
            <td class="text-center">No Data Available !</td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>

</div>

        
<?php include("includes/footer.php");?>       
