<?php  $page_title="Manage Videos"; 

include("includes/header.php");

require("includes/function.php");
require("language/language.php");

if(isset($_POST['data_search']))
{
    $data_qry="SELECT * FROM tbl_video
    WHERE tbl_video.`video_title` like '%".addslashes($_POST['search_value'])."%' 
    ORDER BY tbl_video.id";

    $result=mysqli_query($mysqli,$data_qry); 
}
else
{
    $tableName="tbl_video";   
    $targetpage = "manage_videos.php"; 
    $limit = 12; 

    $query = "SELECT COUNT(*) as num FROM tbl_video";
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

    $data_qry="SELECT * FROM tbl_video
    ORDER BY tbl_video.`id` DESC LIMIT $start, $limit";

    $result=mysqli_query($mysqli,$data_qry); 
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
                  <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_video.php">Add Videos</a> </div>
              </div>
            </div>

           <div class="col-md-4 col-xs-12 text-right" style="float: right;">
	          <div class="checkbox" style="width: 95px;margin-top: 5px;margin-left: 10px;right: 100px;position: absolute;">
	            <input type="checkbox" id="checkall_input">
	            <label for="checkall_input">
	                Select All
	            </label>
	          </div>
	          <div class="dropdown" style="float:right">
	            <button class="btn btn-primary dropdown-toggle btn_cust" type="button" data-toggle="dropdown">Action
	            <span class="caret"></span></button>
	             <ul class="dropdown-menu" style="right:0;left:auto;">
                <li><a href="javascript:void(0)" class="actions" data-action="enable" data-table="tbl_video" data-column="status">Enable</a></li>
                <li><a href="javascript:void(0)" class="actions" data-action="disable" data-table="tbl_video" data-column="status">Disable</a></li>
                <li><a href="javascript:void(0)" class="actions" data-action="delete" data-table="tbl_video" data-column="status">Delete !</a></li>
              </ul>
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
                    $video_file=$row['video_url'];

              if($row['video_type']=='local'){
                $video_file=$file_path.'uploads/'.basename($row['video_url']);
              }
                    
                    ?>
              <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="block_wallpaper">
                  <div class="wall_category_block">
                    <div class="checkbox" style="float: right;">
                      <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $row['id']; ?>" class="post_ids">
                      <label for="checkbox<?php echo $i;?>">
                      </label>
                    </div>
                  </div>
                  <div class="wall_image_title">
                    <h2><?php echo $row['video_title'];?></h2>
                    <p><?php echo $row['video_layout'];?></p>
                    <ul>
                    <?php if($row['video_layout']=='Portrait'){?>
                    <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Portrait"><i class="fa fa-mobile"></i></a></li>
                  <?php }else{?>
                    <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Landscape"><i class="fa fa-mobile" style="transform:rotate(90deg);"></i></a></li>
                  <?php }?>  

                  <?php if($row['video_type']=='youtube'){?>
                    <li><a href="<?=$video_file?>" data-toggle="tooltip" data-tooltip="Edit" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                  <?php }else{?>
                    <li><a href="" class="btn_preview" data-title="<?=$row['video_title']?>" data-url="<?=$video_file?>" data-toggle="tooltip" data-tooltip="Video Preview"><i class="fa fa-video-camera"></i></a></li>
                  <?php }?> 

                  

                  
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_viewer'];?> Views"><i class="fa fa-eye"></i></a></li>
                      <li><a href="edit_video.php?video_id=<?php echo $row['id'];?>&redirect=<?=$redirectUrl?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn_delete" data-id="<?php echo $row['id'];?>" data-table="tbl_video" data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a></li>
                     <li>
                        <div class="row toggle_btn">
                          <input type="checkbox" id="enable_disable_check_<?=$i?>" data-id="<?=$row['id']?>" data-table="tbl_video" data-column="status" class="cbx hidden enable_disable" <?php if($row['status']==1){ echo 'checked';} ?>>
                          <label for="enable_disable_check_<?=$i?>" class="lbl"></label>
                        </div>
                      </li>  
                    </ul>
                  </div>
                  <span><img src="images/<?php echo $row['video_thumbnail'];?>" /></span>
                </div>
              </div>
			     <?php $i++;}?>     
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
        
    <style type="text/css">
  iframe body{
    text-align: center !important;
  }
</style>

<!-- Video Preview Modal -->
<div id="videoPreview" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding-top: 15px;padding-bottom: 15px;background: rgba(0,0,0.05);border-bottom-width: 0px;">
        <button type="button" class="close" data-dismiss="modal" style="color: #fff;font-size: 35px;font-weight: normal;opacity: 1">&times;</button>
        <h4 class="modal-title" style="color: #fff"></h4>
      </div>
      <div class="modal-body" style="padding: 0px;background: #000">
       <iframe width="100%" height="500" style="border:0" src=""></iframe>
     </div>
   </div>
 </div>
</div>

<?php include("includes/footer.php");?>  

<script>
    
  $('#videoPreview').on('hidden.bs.modal', function(){
    $("#videoPreview iframe").removeAttr("src");
  });

  $(".btn_preview").on("click",function(e){
    e.preventDefault();
    $("#videoPreview .modal-title").text($(this).data("title"));
    $("#videoPreview iframe").attr('src',$(this).data("url"));
    $("#videoPreview").modal("show");
  });
    </script>