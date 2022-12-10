<?php 

  include("includes/header.php");
	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['story_search']))
  {
      $data_qry="SELECT * FROM tbl_stories
      WHERE tbl_stories.`story_title` like '%".addslashes($_POST['story_name'])."%' 
      ORDER BY tbl_stories.id";
      $result=mysqli_query($mysqli,$data_qry);
  }
   else
   {
      //Get all stories
      $tableName="tbl_stories";   
      $targetpage = "manage_stories.php"; 
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

      $data_qry="SELECT * FROM tbl_stories
    ORDER BY tbl_stories.`id` DESC LIMIT $start, $limit";

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
              <div class="page_title">Manage Stories</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                      <form  method="post" action="">
                        <input class="form-control input-sm" placeholder="Search story by title..." aria-controls="DataTables_Table_0" type="search" name="story_name" required>
                        <button type="submit" name="story_search" class="btn-search"><i class="fa fa-search"></i></button>
                      </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_story.php">Add Story</a> </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-12" style="float: right;width: 18%">
                <div class="checkbox">
                  <input type="checkbox" name="checkall" id="checkall" value="">
                  <label for="checkall">Select All</label>
                  <button type="submit" class="btn btn-danger btn_cust" name="delete_rec" value="delete_wall">Delete</button>
                </div> 
            </div>

          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></div>
                <?php unset($_SESSION['msg']);}?> 
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
          ?>
          <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="block_wallpaper add_wall_category"> 
              <div class="wall_category_block">
                <h2><?php echo date('m/d/Y',$row['story_date']);?></h2>  


                <div class="checkbox" style="float: right;">
                  <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $row['id']; ?>" class="post_ids">
                  <label for="checkbox<?php echo $i;?>">
                  </label>
                </div>

              </div>          
              <div class="wall_image_title">


                <h2>
                  <a href="javascript:void(0)">
                    <?php 
                        if(strlen($row['story_title']) > 20){
                          echo mb_substr(stripslashes($row['story_title']), 0, 20).'...';  
                        }else{
                          echo $row['story_title'];
                        }
                    ?>
                  </a>
                </h2>
                <ul>
                <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['story_views'];?> Views"><i class="fa fa-eye"></i></a></li>                
                  <li><a href="edit_story.php?story_id=<?php echo $row['id'];?>" target="_blank" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>

                  <li>
                    <a href="" class="btn_delete_a" data-id="<?php echo $row['id'];?>"  data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a>
                  </li>

                  <?php if($row['status']!="0"){?>
                    <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="deactive" data-column="status" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div></li>

                  <?php }else{?>
                    
                    <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="active" data-column="status" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div></li>
                  <?php }?>
                   

                </ul>
              </div>
              <?php 
                if($row['story_image']!=''){
                  echo '<span><img src="images/'.$row['story_image'].'"  style="height:200px !important;"/></span>';    
                }
                else{
                  echo '<span><img src="assets/images/no_image.jpg" style="height:200px !important;"/></span>';     
                }
              ?>
              
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

<script type="text/javascript">

  $(".toggle_btn a").on("click",function(e){
      e.preventDefault();
      
      var _for=$(this).data("action");
      var _id=$(this).data("id");
      var _column=$(this).data("column");
      var _table='tbl_stories';

      $.ajax({
        type:'post',
        url:'processData.php',
        dataType:'json',
        data:{id:_id,for_action:_for,column:_column,table:_table,'action':'multi_toggle_status','tbl_id':'id'},
        success:function(res){
            console.log(res);
            if(res.status=='1'){
              location.reload();
            }
          }
      });

    });

  $(".btn_delete_a").click(function(e){
      e.preventDefault();

      var _ids = $(this).data("id");

      if(_ids!='')
      {
        if(confirm("Are you sure to delete this story?")){
          $.ajax({
            type:'post',
            url:'processData.php',
            dataType:'json',
            data:{id:_ids,'action':'multi_delete','tbl_nm':'tbl_stories'},
            success:function(res){
                console.log(res);
                if(res.status=='1'){
                  location.reload();
                }
                else if(res.status=='-2'){
                  alert(res.message);
                }
              }
          });
        }
      }
  });

  $("button[name='delete_rec']").click(function(e){
      e.preventDefault();

      var _ids = $.map($('.post_ids:checked'), function(c){return c.value; });

      if(_ids!='')
      {

      var confirmDlg = duDialog('Are you sure?', 'All data will be removed which belong to this!', {
      init: true,
      dark: false, 
      buttons: duDialog.OK_CANCEL,
      okText: 'Proceed',
      callbacks: {
        okClick: function(e) {
          $(".dlg-actions").find("button").attr("disabled",true);
          $(".ok-action").html('<i class="fa fa-spinner fa-pulse"></i> Please wait..');
          $.ajax({
            type:'post',
            url:'processData.php',
            dataType:'json',
            data:{id:_ids,'action':'multi_delete','tbl_nm':'tbl_stories'},
            success:function(res){
                console.log(res);
                if(res.status=='1'){
                  location.reload();
                }
                else if(res.status=='-2'){
                  alert(res.message);
                }
              }
          });
        } 
      }
    });
    confirmDlg.show();
      }
      else{
        duDialog('Error', 'No Stories Selected');
      }
  });

</script> 

<script>
  $("#checkall").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>      
