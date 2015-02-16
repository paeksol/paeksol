<?php

$page = "our_cars";
include("header.php");

?>
<div class="inner-content car">
			<div class="container">
			<div class="row">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li><span> >></span>
			  <li class="active">Our cars</li>
			</ol>
			<div class="content">
			<div class="col-md-9 col-sm-9 left-section">
				<div class="row">
				<h1>Our Cars</h1>
				
				<div class="col-md-3 col-sm-3 left-image">
					<div class="inner-image">
						<img src="media/img/image-inner9.png" alt=""/>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 right-text padding-cus">
					<p class="">We use Toyota Yaris’ and Prius’. All of our cars are equipped with the latest safety features such as air bags (lots of them) and a passenger side safety brake and extra rear-view mirrors for the instructor. Our cars are chosen primarily based on safety and ease of driving.  If you prefer one type of car over another, please let us know and we will be happy to accommodate you.</p>
					
					
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
					<div class="border-bottom padding-cus"></div>
					
			</div> <!--content ends here-->
				
						
			</div>
			
			</div>
		
		
		</div>	<!--inner-content-->	
<?php

include("footer.php");

?>		