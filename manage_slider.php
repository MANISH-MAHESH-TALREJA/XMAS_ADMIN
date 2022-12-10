<?php 
  
  $page_title="Manage Sliders";

  include("includes/header.php");
  require("includes/function.php");
  require("language/language.php");

  if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "")
  {
    $url = $_SERVER['HTTP_REFERER'];
  }else{
    $url = "manage_users.php";
  }

  if(isset($_POST['data_search']))
  {

      
      $keyword = filter_var($_POST['search_value'], FILTER_SANITIZE_STRING);

      $data_qry="SELECT * FROM tbl_slider
      WHERE tbl_slider.`slider_title` LIKE '$keyword%'  ORDER BY tbl_slider.`slider_title`";

      /*$qry="SELECT * FROM tbl_slider                   
      WHERE tbl_slider.`slider_title` like '%".addslashes($_POST['search_value'])."%'
      ORDER BY tbl_slider.`slider_title`";*/

      $result=mysqli_query($mysqli,$data_qry); 

  }
  else
  { 

      $tableName="tbl_slider";   
      $targetpage = "manage_slider.php"; 
      $limit = 12; 

      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];

      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
      $start = ($page - 1) * $limit; 
      }else{
      $start = 0; 
      } 

      $qry="SELECT * FROM tbl_slider
      ORDER BY tbl_slider.id DESC LIMIT $start, $limit";

      $result=mysqli_query($mysqli,$qry); 

  } 

  // paramater wise info
  function get_single_info($post_id,$param,$type='video')
  {
    global $mysqli;

    switch ($type) {
      case 'video':
        $query="SELECT * FROM tbl_video WHERE `id`='$post_id'";
        break;

      case 'christmas_images':
        $query="SELECT * FROM tbl_wallpaper WHERE `id`='$post_id'";
        break;

      case 'new_year_images':
          $query="SELECT * FROM tbl_new_year_wallpaper WHERE `id`='$post_id'";
          break;

     
      default:
        $query="SELECT * FROM tbl_wallpaper WHERE `id`='$post_id'";
        break;
    }

    $sql = mysqli_query($mysqli,$query)or die(mysqli_error());
    $row=mysqli_fetch_assoc($sql);

    return stripslashes($row[$param]);
  } 
   
?>


                
<div class="row">
  <div class="col-xs-12">
    <?php
        if(isset($_SERVER['HTTP_REFERER']))
        {
          echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
        }
    ?>
    <div class="card mrg_bottom">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
        <div class="col-md-7 col-xs-12">
          <div class="search_list">
            <div class="search_block">
              <form  method="post" action="">
              <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" value="<?php if(isset($_POST['search_value'])){ echo $_POST['search_value']; }?>" required>
                    <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
              </form>  
            </div>
            <div class="add_btn_primary"> <a href="add_slider.php?add=yes">Add New</a> </div>
            
          </div>
        </div>
      </div>
       <div class="clearfix"></div>
      <div class="col-md-12 mrg-top">
        <div class="row">
          <?php 
          $i=0;
          while($row=mysqli_fetch_array($result))
          {
              switch ($row['slider_type']) {
                case 'video':
                  $slider_title=get_single_info($row['post_id'],'video_title','video');
                  $image=get_single_info($row['post_id'],'video_thumbnail','video');
                  break;

                case 'christmas_images':
                  $slider_title=get_single_info($row['post_id'],'wall_name','christmas_images');
                  $image=get_single_info($row['post_id'],'image','christmas_images');
                  break;

                case 'new_year_images':
                    $slider_title=get_single_info($row['post_id'],'wall_name','new_year_images');
                    $image=get_single_info($row['post_id'],'image','new_year_images');
                    break;

                default:
                  $slider_title=$row['slider_title'];
                  $image=$row['external_image'];
                  break;
            }
          ?>
          <?php 
          ?>
          <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="block_wallpaper"> 
              <div class="wall_category_block" style="text-align: right;">
                <div class="row" style="padding: 10px;">
                  <span class="label label-success"><?=$row['slider_type']?></span>  
                </div>
              </div>          
              <div class="wall_image_title">
                <h2><a href="javascript:void(0)"><?php echo $slider_title;?></a></h2>
                <ul> 
                  <li>                
                      <a href="javascript:void(0)" class="btn_delete" data-table="tbl_slider" data-id="<?php echo $row['id'];?>"  data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a>                  
                  </li>

                  <li><a href="edit_slider.php?edit_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>        
                 
                  <li>
                          <div class="row toggle_btn">
                              <input type="checkbox" id="enable_disable_check_<?=$i?>" data-id="<?=$row['id']?>" data-table="tbl_slider" data-column="status" class="cbx hidden enable_disable" <?php if($row['status']==1){ echo 'checked';} ?>>
                              <label for="enable_disable_check_<?=$i?>" class="lbl"></label>
                          </div>
                        </li>
                </ul>
              </div>
              <span>
                <img src="images/<?php echo $image;?>"/>
              </span>

            </div>
          </div>
          <?php
            
          $i++;
        }
    ?>     
           
  </div>
      </div>
      <div class="col-md-12 col-xs-12">
        <div class="pagination_item_block">
          <nav>
            <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
          </nav>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
        
<?php include("includes/footer.php");?>  

