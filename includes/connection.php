<?php
error_reporting(0);
ob_start();
session_start();

header("Content-Type: text/html;charset=UTF-8");


if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.1.125")
{	
	DEFINE ('DB_USER', 'pjsxduax_ADMIN');
	DEFINE ('DB_PASSWORD', 'ADMIN9833137409');
	DEFINE ('DB_HOST', 'localhost'); //host name depends on server
	DEFINE ('DB_NAME', 'pjsxduax_christmas');
}
else
{
	//local live 

	DEFINE ('DB_USER', 'pjsxduax_ADMIN');
	DEFINE ('DB_PASSWORD', 'ADMIN9833137409');
	DEFINE ('DB_HOST', 'localhost'); //host name depends on server
	DEFINE ('DB_NAME', 'pjsxduax_christmas');
}


$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

mysqli_query($mysqli,"SET NAMES 'utf8'");	 

$setting_qry="SELECT * FROM tbl_settings where id='1'";
$setting_result=mysqli_query($mysqli,$setting_qry);
$settings_details=mysqli_fetch_assoc($setting_result);

define("APP_NAME",$settings_details['app_name']);
define("APP_LOGO",$settings_details['app_logo']);


define("ONESIGNAL_APP_ID",$settings_details['onesignal_app_id']);
define("ONESIGNAL_REST_KEY",$settings_details['onesignal_rest_key']); 

if(isset($_SESSION['id']))
{
	$profile_qry="SELECT * FROM tbl_admin where id='".$_SESSION['id']."'";
	$profile_result=mysqli_query($mysqli,$profile_qry);
	$profile_details=mysqli_fetch_assoc($profile_result);

	define("PROFILE_IMG",$profile_details['image']);
}


?> 	