<?php

$page = "blog";
include("header.php");

?>
<div class="inner-content blog">
			<div class="container">
			<div class="row">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li><span> >></span>
			  <li class="active">Blog</li>
			</ol>
			<div class="content">
			<div class="col-md-9 col-sm-9 left-section">
				<div class="row">
				<br><br>
				<h1>Blog</h1>
			<div class="blog1">
			
			<div class="col-md-10 col-sm-10">
			
			<div><script type="text/javascript" src="//sites.yext.com/24114-posts.js"></script></div>
			
			
			</div>
			<div class="clearfix"></div>
			</div>				
						
			</div>
					</div><!--left section-->
					<div class="right-section col-md-3 col-sm-3>
					<?php 
					$visible_select=false;
					$title="Drop Us A Message";
					$description="";
					include("right_popup_message.php"); 
					?>
					</div>
					<div class="clearfix"></div>
					<div class="border-bottom"></div>
			</div> <!--content ends-->
			
			</div>
		
		
		</div>	<!--inner-content-->	
<?php

include("footer.php");

?>