<?php 
	require("includes/connection.php");
	require("includes/function.php");
	require("language/language.php");

	$response=array();
	
	$_SESSION['class']="success";

	switch ($_POST['action']) {
		case 'multi_toggle_status':
			$id=$_POST['id'];
			$for_action=$_POST['for_action'];
			$column=$_POST['column'];
			$tbl_id=$_POST['tbl_id'];
			$table_nm=$_POST['table'];

			if($for_action=='active'){
				$data = array($column  =>  '1');
			    $edit_status=Update($table_nm, $data, "WHERE $tbl_id = '$id'");
			}else{
				$data = array($column  =>  '0');
			    $edit_status=Update($table_nm, $data, "WHERE $tbl_id = '$id'");
			}
			
	      	$response['status']=1;
	      	$response['action']=$for_action;
	      	echo json_encode($response);
			break;

		case 'toggle_status':
			$table_nm = $_POST['table'];
			
			$sql_schema="SHOW COLUMNS FROM $table_nm";
			$res_schema=mysqli_query($mysqli, $sql_schema);
			$row_schema=mysqli_fetch_array($res_schema);

			$id = $_POST['id'];
			$for_action = $_POST['for_action'];
			$column = $_POST['column'];
			$tbl_id = $row_schema[0];

			$message='';

			if ($for_action == 'enable') {
				$data = array($column  =>  '1');
				$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
				$message=$client_lang['13'];
			}else {
				$data = array($column  =>  '0');
				$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
				$message=$client_lang['14'];
			}
			
	      	$response['status'] = 1;
			$response['msg'] = $message;
			$response['action'] = $for_action;
			echo json_encode($response);
			break;

		case 'multi_delete':

			$ids=implode(",", $_POST['id']);
	
			if($ids==''){
				$ids=$_POST['id'];
			}
	
			$tbl_nm=$_POST['tbl_nm'];
			if($tbl_nm=='tbl_stories'){

				$sql="SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
				$res=mysqli_query($mysqli, $sql);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['story_image']!="")
					{
						unlink('images/'.$row['story_image']);
						unlink('images/thumbs/'.$row['story_image']);
					}

				}
				$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);

			}

			$_SESSION['msg']="12";
			
	      	$response['status']=1;
	      	echo json_encode($response);
			break;
		case 'multi_action':

			$action=$_POST['for_action'];

			if(is_array($_POST['id']))
				$ids=implode(",", $_POST['id']);
			else
				$ids=$_POST['id'];

			$table=$_POST['table'];

			$sql_schema="SHOW COLUMNS FROM $table";
			$res_schema=mysqli_query($mysqli, $sql_schema);
			$row_schema=mysqli_fetch_array($res_schema);

			$column=(isset($_POST['column'])) ? $_POST['column'] : '';
			$tbl_id = $row_schema[0];

			if($action=='enable'){

				$sql="UPDATE $table SET `status`='1' WHERE `id` IN ($ids)";
				mysqli_query($mysqli, $sql);
				$_SESSION['msg']="13";				
			}
			else if($action=='disable'){
				$sql="UPDATE $table SET `status`='0' WHERE `id` IN ($ids)";
				if(mysqli_query($mysqli, $sql)){
					$_SESSION['msg']="14";
				}
			}
			else if($action=='delete'){
					
					 if($table=='tbl_wallpaper'){

				$sqlCategory="SELECT * FROM $table WHERE `id` IN ($ids)";
				$res=mysqli_query($mysqli, $sqlCategory);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['image']!="")
					{
						unlink('images/'.$row['image']);
						unlink('images/thumbs/'.$row['image']);
					}

				}
				$deleteSql="DELETE FROM $table WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}

			if($table=='tbl_video'){

				$sqlCategory="SELECT * FROM $table WHERE `id` IN ($ids)";
				$res=mysqli_query($mysqli, $sqlCategory);
				while ($row=mysqli_fetch_assoc($res)){
					if ($row['video_thumbnail'] != "") {
						unlink('images/' . $row['video_thumbnail']);
					}
			
					if ($row['video_type'] == 'local') {
						unlink('uploads/' . basename($row['video_url']));
					}

				}
				$deleteSql="DELETE FROM $table WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}

			else if($table=='tbl_ringtone'){

				$sqlCategory="SELECT * FROM $table WHERE `id` IN ($ids)";
				$res=mysqli_query($mysqli, $sqlCategory);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['ringtone_link']!="")
					{
						unlink('uploads/'.$row['ringtone_link']);
					}

				}
				$deleteSql="DELETE FROM $table WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}
			else if($table=='tbl_sms'){

				$deleteSql="DELETE FROM $table WHERE `id` IN ($ids)";
				
				mysqli_query($mysqli, $deleteSql);
			}else if($table=='tbl_slider'){

				$sql=mysqli_query($mysqli,"SELECT * FROM tbl_slider WHERE `id` IN ($ids)");
				$row=mysqli_fetch_assoc($sql);

				if($row['slider_type']=="external")
				{
					unlink('images/'.$row['external_image']);
				}

				$deleteSql="DELETE FROM tbl_slider WHERE `id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

			}

			else if($table=='tbl_quiz'){

				$deleteSql="DELETE FROM $table WHERE `id` IN ($ids)";
				
				mysqli_query($mysqli, $deleteSql);
			}
				
		    $_SESSION['msg']="12";
		    
		  }

		$response['status']=1;	
      	echo json_encode($response);
		break;
		
		default:
			# code...
			break;
	}

?>