<?php $page_title="Manage SMS";

include("includes/header.php");

require("includes/function.php");
require("language/language.php");


if(isset($_POST['data_search']))
{ 
  
 $keyword = filter_var($_POST['search_text'], FILTER_SANITIZE_STRING);

 $data_qry="SELECT * FROM tbl_sms
 WHERE tbl_sms.`sms` LIKE '$keyword%'  ORDER BY tbl_sms.`sms`";

 $result=mysqli_query($mysqli,$data_qry); 
 
}
else
{ 
	
  $tableName="tbl_sms";   
  $targetpage = "manage_sms.php"; 
  $limit = 10; 
  
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
  
  $data_qry="SELECT * FROM tbl_sms
  ORDER BY tbl_sms.`id` DESC LIMIT $start, $limit";
  
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
         <form  method="post" action="" enctype="multipart/form-data">
          <input class="form-control input-sm" placeholder="Search by sms..." aria-controls="DataTables_Table_0" type="search" name="search_text" required>
          <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
        </form>                     
      </div>
      <div class="add_btn_primary"> <a href="add_sms.php">Add sms</a> </div>
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
        <li><a href="javascript:void(0)" class="actions" data-action="enable" data-table="tbl_sms" data-column="status">Enable</a></li>
        <li><a href="javascript:void(0)" class="actions" data-action="disable" data-table="tbl_sms" data-column="status">Disable</a></li>
        <li><a href="javascript:void(0)" class="actions" data-action="delete" data-table="tbl_sms" data-column="status">Delete !</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-md-12 mrg-top">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>SMS</th>
        <th>status</th>
        <th class="cat_action_list">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=0;
      while($row=mysqli_fetch_array($result))	
        {?>

          <tr>
            <td>
              <div class="checkbox">
                <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $row['id']; ?>" class="post_ids">
                <label for="checkbox<?php echo $i;?>"></label>
              </div>
            </td>
            <td><?php  echo $row['sms']?></td>
            <td>
              <div class="row toggle_btn">
                <input type="checkbox" id="enable_disable_check_<?=$i?>" data-id="<?=$row['id']?>" data-table="tbl_ringtone" data-column="status" class="cbx hidden enable_disable" <?php if($row['status']==1){ echo 'checked';} ?>>
                <label for="enable_disable_check_<?=$i?>" class="lbl"></label>
              </div>
            </td>
            <td>
              <a href="edit_sms.php?sms_id=<?php echo $row['id'];?>&redirect=<?=$redirectUrl?>" class="btn btn-primary btn_cust" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a>
              <a href="javascript:void(0)" data-table="tbl_sms" data-id="<?php echo $row['id']; ?>" data-toggle="tooltip" data-tooltip="Delete" class="btn btn-danger btn_delete btn_cust"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <?php $i++; }?>

        </tbody>
      </table>
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

<?php include('includes/footer.php');?>       

