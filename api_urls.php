<?php $page_title="Api Urls";

include("includes/header.php");
include("includes/function.php");

$file_path = getBaseUrl().'api.php';

?>
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<?php
        if(isset($_SERVER['HTTP_REFERER']))
          {
            echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
         }
        ?>
		<div class="card">
			<div class="card-header">
			  Android Application API URL'S
			</div>
			<div class="card-body padding: 5px 5px;">		
			 <pre>
				<code class="html">
				<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">BASIC API DETAILS</p><br><b>API URL</b>&nbsp; <?php echo $file_path;?>	
				 <br><b>App Details</b>(Method: get_app_details)
				</div> 
				<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">CHRISTMAS AND NEW YEAR WALLPAPERS API URL (Most views) </p><br><b>Christmas Wallpaper Most Views</b>(Method: get_wallpaper_view)
				<br><b>New Year Wallpaper Most Views</b>(Method: get_new_year_wallpaper_view)
				</div>
				<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">RINGTONES API URL</p><br><b>Ringtones </b>(Method: get_ringtone)	
				<br><b>Single Ringtone </b>(Method: get_single_ringtone)(Parameter: ring_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">CHRISTMAS API URL</p><br><b>Christmas Wallpapers </b>(Method: get_wallpaper)
			<br><b>Single Christmas Wallpaper </b>(Method: get_single_wallpaper)(Parameter: wall_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">NEW YEAR API URL</p><br><b>New Year Wallpapers </b>(Method: get_new_year_wallpaper)
			<br><b>Single New Year Wallpaper </b>(Method: get_new_year_single_wallpaper)(Parameter: wall_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">QUIZ API URL</p><br><b>Quiz </b>(Method: get_quiz)
			<br><b>Single Quiz </b>(Method: get_single_quiz)(Parameter: quiz_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">SMS API URL</p><br><b>SMS </b>(Method: get_sms)
			<br><b>Single SMS </b>(Method: get_single_sms)(Parameter: sms_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">VIDEOS API URL</p><br><b>Videos </b>(Method: get_videos)
			<br><b>Single Video </b>(Method: get_single_video)(Parameter: video_id)
			</div>
			<div style="border: 2px solid #FFF;padding: 10px 15px;border-radius:10px;"><p style="font-size:16px; font-weight:600">STORIES API URL</p><br><b>Stories </b>(Method: get_stories)
			<br><b>Single Story </b>(Method: get_single_story)(Parameter: story_id)
			</div>
				</code> 
			 </pre>
			</div>
		</div>
	</div>
</div>

        
<?php include("includes/footer.php");?>       
