<?php 
include("includes/connection.php");
include("includes/function.php"); 	

error_reporting(0);

$file_path = getBaseUrl();

define("PACKAGE_NAME",$settings_details['package_name']);

date_default_timezone_set("Asia/Kolkata");


if($settings_details['envato_buyer_name']=='' OR $settings_details['envato_purchase_code']=='' OR $settings_details['envato_purchased_status']==0) {  

	$set['CHRISTMAS_APP'][] =array('msg' => 'Purchase code verification failed!','status'=>-1);	
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

$get_method = checkSignSalt($_POST['data']);	

if($get_method['method_name']=="get_wallpaper_view")
{
	
	$jsonObj= array();

	$query="SELECT * FROM tbl_wallpaper WHERE tbl_wallpaper.`status`= 1
	ORDER BY tbl_wallpaper.`total_views` DESC";

	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['total_views'] = $data['total_views'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}
	
	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();

}
else if($get_method['method_name']=="get_new_year_wallpaper_view")
{
	
	$jsonObj= array();

	$query="SELECT * FROM tbl_new_year_wallpaper WHERE tbl_new_year_wallpaper.`status`= 1
	ORDER BY tbl_new_year_wallpaper.`total_views` DESC";

	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['total_views'] = $data['total_views'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}
	
	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();

}
else if($get_method['method_name']=="get_sms")
{
	
	$jsonObj= array();

	$query="SELECT * FROM tbl_sms WHERE tbl_sms.`status`= 1 ORDER BY tbl_sms.`id` DESC";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['sms'] = stripslashes($data['sms']);
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}
else if($get_method['method_name']=="get_single_sms")
{
	$jsonObj= array();
	$sms_id=$get_method['sms_id'];

	$query="SELECT * FROM tbl_sms WHERE tbl_sms.`status`=1 AND tbl_sms.`id`='$sms_id'";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['sms'] = $data['sms'];
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
	
}
else if($get_method['method_name']=="get_wallpaper")
{
	$jsonObj= array();
	
	$query="SELECT * FROM tbl_wallpaper WHERE tbl_wallpaper.`status`= 1 ORDER BY tbl_wallpaper.`id` DESC";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{

		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}
else if($get_method['method_name']=="get_new_year_wallpaper")
{
	$jsonObj= array();
	
	$query="SELECT * FROM tbl_new_year_wallpaper WHERE tbl_new_year_wallpaper.`status`= 1 ORDER BY tbl_new_year_wallpaper.`id` DESC";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{

		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}
else if($get_method['method_name']=="get_single_wallpaper")
{
	$jsonObj= array();

	$wall_id=$get_method['wall_id'];
	
	$query="SELECT * FROM tbl_wallpaper WHERE tbl_wallpaper.`status`= 1 AND tbl_wallpaper.`id`='$wall_id'";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['total_views'] = $data['total_views'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}

	$view_qry=mysqli_query($mysqli,"UPDATE tbl_wallpaper SET total_views = total_views + 1 WHERE id = '$wall_id'");

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
	
}
else if($get_method['method_name']=="get_new_year_single_wallpaper")
{
	$jsonObj= array();

	$wall_id=$get_method['wall_id'];
	
	$query="SELECT * FROM tbl_new_year_wallpaper WHERE tbl_new_year_wallpaper.`status`= 1 AND tbl_new_year_wallpaper.`id`='$wall_id'";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['wall_name'] = $data['wall_name'];
		$row['tags'] = $data['tags'];
		$row['total_views'] = $data['total_views'];
		$row['image_b'] = $file_path.'images/'.$data['image'];
		$row['image_s'] = $file_path.'images/thumbs/'.$data['image'];
		
		array_push($jsonObj,$row);
		
	}

	$view_qry=mysqli_query($mysqli,"UPDATE tbl_new_year_wallpaper SET total_views = total_views + 1 WHERE id = '$wall_id'");

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
	
}
else if($get_method['method_name']=="get_ringtone")
{
	$jsonObj= array();
	
	$query="SELECT* FROM tbl_ringtone WHERE tbl_ringtone.`status`= 1 ORDER BY tbl_ringtone.`id` DESC";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{

		$row['id'] = $data['id'];
		$row['ringtone_name'] = $data['ringtone_name'];
		$row['tags'] = $data['tags'];
		$row['ringtone_link'] = $file_path.'uploads/'.$data['ringtone_link'];
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
} 
else if($get_method['method_name']=="get_single_ringtone")
{
	$jsonObj= array();

	$ring_id=$get_method['ring_id'];
	
	$query="SELECT * FROM tbl_ringtone WHERE tbl_ringtone.`status`= 1 AND tbl_ringtone.`id`='$ring_id'";

	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		
		$row['id'] = $data['id'];
		$row['ringtone_name'] = $data['ringtone_name'];
		$row['tags'] = $data['tags'];
		$row['total_views'] = $data['total_views'];
		$row['ringtone_link'] = $file_path.'uploads/'.$data['ringtone_link'];
		
		array_push($jsonObj,$row);
		
	}
	
	$view_qry=mysqli_query($mysqli,"UPDATE tbl_ringtone SET total_views = total_views + 1 WHERE id = '".$get_method['ring_id']."'");

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}	
else if($get_method['method_name']=="get_quiz")
{
	$jsonObj= array();
	
	$query="SELECT * FROM tbl_quiz WHERE tbl_quiz.`status`= 1 ORDER BY tbl_quiz.`id` DESC";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{

		$row['id'] = $data['id'];
		$row['quiz_title'] = stripcslashes($data['quiz_title']);
		$row['option1'] = $data['option1'];
		$row['option2'] = $data['option2'];
		$row['option3'] = $data['option3'];
		$row['option4'] = $data['option4'];
		$row['quiz_ans'] = $data['quiz_ans'];

		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}
else if($get_method['method_name']=="get_single_quiz")
{
	$jsonObj= array();

	$quiz_id=$get_method['quiz_id'];
	
	$query="SELECT * FROM tbl_quiz WHERE tbl_quiz.`status`= 1 AND tbl_quiz.`id`='$quiz_id'";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['id'] = $data['id'];
		$row['quiz_title'] = stripcslashes($data['quiz_title']);
		$row['option1'] = $data['option1'];
		$row['option2'] = $data['option2'];
		$row['option3'] = $data['option3'];
		$row['option4'] = $data['option4'];
		$row['quiz_ans'] = $data['option1'];
		
		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
	
}
else if($get_method['method_name']=="get_app_details")
{
	$jsonObj= array();	

	$query="SELECT * FROM tbl_settings WHERE `id`='1'";
	$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

	while($data = mysqli_fetch_assoc($sql))
	{
		$row['package_name'] = $data['package_name'];
		$row['app_name'] = stripslashes($data['app_name']);
		$row['app_logo'] = $data['app_logo'];
		$row['app_version'] = $data['app_version'];
		$row['app_author'] = $data['app_author'];
		$row['app_contact'] = $data['app_contact'];
		$row['app_email'] = $data['app_email'];
		$row['app_website'] = $data['app_website'];
		$row['app_description'] = stripslashes($data['app_description']);
		$row['app_developed_by'] = $data['app_developed_by'];

		$row['app_privacy_policy'] = stripslashes($data['app_privacy_policy']);
		
		if ($data['android_ad_network'] == 'admob' or $data['android_ad_network'] == 'facebook') {
			$row['publisher_id'] = $data['publisher_id'];
		} else {
			$row['publisher_id'] = '';
		}

		$row['interstitial_ad'] = $data['interstital_ad'];
		$row['interstitial_ad_type'] = $data['interstital_ad_type'];

		if ($data['interstital_ad_type'] == 'facebook') {
			$row['interstitial_ad_id'] = $data['interstital_facebook_id'];
		} else if ($data['interstital_ad_type'] == 'admob') {
			$row['interstitial_ad_id'] = $data['interstital_ad_id'];
		}else if ($data['interstital_ad_type'] == 'applovins') {
			$row['interstitial_ad_id'] = $data['interstitial_applovin_id'];
		} else if ($data['interstital_ad_type'] == 'startapp') {
			$row['interstitial_ad_id'] = '';
		} else if ($data['interstital_ad_type'] == 'wortise') {
            $row['interstitial_ad_id'] = $data['interstitial_wortise_id'];
        }

		$row['interstitial_ad_click'] = $data['interstital_ad_click'];

		$row['banner_ad'] = $data['banner_ad'];
		$row['banner_ad_type'] = $data['banner_ad_type'];


		if ($data['banner_ad_type'] == 'facebook') {
			$row['banner_ad_id'] = $data['banner_facebook_id'];
		} else if ($data['banner_ad_type'] == 'admob') {
			$row['banner_ad_id'] = $data['banner_ad_id'];
		} else if ($data['banner_ad_type'] == 'applovins') {
			$row['banner_ad_id'] = $data['banner_applovin_id'];
		} else if ($data['banner_ad_type'] == 'startapp') {
			$row['banner_ad_id'] = '';
		} else if ($data['banner_ad_type'] == 'wortise') {
            $row['banner_ad_id'] = $data['banner_wortise_id'];
        }

		if ($data['android_ad_network'] == 'startapp') {
			$row['startapp_app_id'] = $data['start_ads_id'];
		} else {
			$row['startapp_app_id'] = '';
		}

		$row['native_ad'] = $data['native_ad'];
		$row['native_ad_type'] = $data['native_ad_type'];

		if ($data['native_ad_type'] == 'facebook') {
			$row['native_ad_id'] = $data['native_facebook_id'];
		} else if ($data['native_ad_type'] == 'admob') {
			$row['native_ad_id'] = $data['native_ad_id'];
		} else if ($data['native_ad_type'] == 'applovins') {
			$row['native_ad_id'] = $data['native_applovin_id'];
		} else if ($data['native_ad_type'] == 'wortise') {
            $row['native_ad_id'] = $data['native_wortise_id'];
        } else{
			$row['native_ad_id'] = '';
		}

		$row['native_other_position'] = $data['native_position'];

		$row['app_update_status'] = $data['app_update_status'];
		$row['app_new_version'] = $data['app_new_version'];
		$row['app_update_desc'] = stripslashes($data['app_update_desc']);
		$row['app_redirect_url'] = $data['app_redirect_url'];
		$row['cancel_update_status'] = $data['cancel_update_status'];

		array_push($jsonObj,$row);
		
	}

	$set['CHRISTMAS_APP'] = $jsonObj;
	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	
}		
else
{
	$get_method = checkSignSalt($_POST['data']);
}		 

?>