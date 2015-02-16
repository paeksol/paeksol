<?php

$page = "student_dashboard";
include("header.php");
?>
<div class="inner-content row">
  
  <div class="col-md-3"  style="padding:60px 0px 40px 80px;">
   <?php
    include("student_dashboard_sidebar.php");
   ?>  
   
  </div>
  <div class="col-md-9 student_dashboard_content" style="">
   <div class="dashboard_main" style="padding-left:100px;">
    <div>
     <h1>Welcome <span><?php echo $username; ?></span> !</h1><br>
    </div>
    <div>
     <h2>Online Driver Ed is : <span>43%</span> complete</h2><br>
    </div>
    <div>
     <h2>Behind the wheel hours :</h2><br>
     <div style="margin-left:15%;">
      <p>Purchased : <span>6</span></p><br>
      <p>Used : <span>0</span></p><br>
      <p>Remaining : <span>6</p></h2><br>
     </div>
    </div>
   </div>
  </div>
</div><!--inner-content--> 

<?php
include("footer.php");
?>