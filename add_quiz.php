<?php $page_title="Add Question";

include("includes/header.php");

require("language/language.php");
require("includes/function.php");


    if(isset($_POST['submit']))
    {
        $data = array( 
            'quiz_title'  =>  addslashes($_POST['quiz_title']),
            'option1'  =>  $_POST['option1'],
            'option2'  =>  $_POST['option2'],
            'option3'  =>  $_POST['option3'],
            'option4'  =>  $_POST['option4'],
            'quiz_ans'  =>  $_POST['quiz_ans'],
            'status'  => 1
        );		

        $qry = Insert('tbl_quiz',$data);	

        $_SESSION['msg']="10";
        header( "Location:manage_quiz.php?add=yes");
        exit;	


    }
		  
?>

    <div class="row">
      <div class="col-md-12">
      	<?php
	      if(isset($_GET['redirect'])){
	            echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
	          }
	          else{
	            echo '<a href="manage_quiz.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
	          }
		    ?>
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?=$page_title?></div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="card-body mrg_bottom">
            <form class="form form-horizontal" action="" method="post"  enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <div class="col-md-2">
                      <label class="control-label">Question:-</label>
                    </div>
                    <div class="col-md-6">
				        <textarea type="text" class="form-control" name="quiz_title" id="quiz_title" value=""></textarea>
                          <div class="form-group">
                            <div class="col-md-3">
                              <label class="control-label">Option 1 :-</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="option1" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-3">
                              <label class="control-label">Option 2 :-</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="option2" class="form-control" required>
                            </div>
                          </div>  
                          <div class="form-group">
                            <div class="col-md-3">
                              <label class="control-label">Option 3 :-</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="option3" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-3">
                              <label class="control-label">Option 4 :-</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="option4" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group has-success">
                            <div class="col-md-3">
                              <label class="control-label">Answer :-</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="quiz_ans" class="form-control" required>
                            </div>
                          </div>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-2">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>           
                 
<?php include("includes/footer.php");?>       
