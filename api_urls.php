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
			<div class="card-body no-padding">		
			 <pre>
				<code class="html">
				 <br><b>API URL</b>&nbsp; <?php echo $file_path;?>		  
				 <br><b>Christmas Wallpaper Most Views</b>(Method: get_wallpaper_view)
				 <br><b>Christmas Wallpaper</b>(Method: get_wallpaper)
				 <br><b>New Year Wallpaper Most Views</b>(Method: get_new_year_wallpaper_view)
				 <br><b>New Year Wallpaper</b>(Method: get_new_year_wallpaper)
				 <br><b>Ringtone</b>(Method: get_ringtone)
				 <br><b>Quiz</b>(Method: get_quiz)
				 <br><b>Sms</b>(Method: get_sms)
				 <br><b>Single Christmas Wallpaper</b>(Method: get_single_wallpaper)(Parameter: wall_id)
				 <br><b>Single New Year Wallpaper</b>(Method: get_new_year_single_wallpaper)(Parameter: wall_id)
				 <br><b>Single Ringtone</b>(Method: get_single_ringtone)(Parameter: ring_id)
				 <br><b>Single Quiz</b>(Method: get_single_quiz)(Parameter: quiz_id)
				 <br><b>Single Sms</b>(Method: get_single_sms)(Parameter: sms_id)
				 <br><b>App Details</b>(Method: get_app_details)
				</code> 
			 </pre>
			</div>
		</div>
	</div>
</div>
<br/>
<div class="clearfix"></div>
        
<?php include("includes/footer.php");?>       
