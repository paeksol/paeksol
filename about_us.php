<?php

$page = "about_us";
include("header.php");

?>
	<div class="inner-content">
			<div class="container">
			<div class="row">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li><span> >></span>
			  <li class="active">About Us</li>
			</ol>
			<div class="content">
				<div class="col-md-9 col-sm-9 left-section">
				<div class="row">
				<h1>About Us</h1>
				
				<div class="col-md-3 col-sm-3 left-image">
					<div class="inner-image">
						<img src="/media/img/image-inner.png" alt=""/>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 right-text">
					<h2 class="teen-h5">Our Mission</h2>
					<p>To educate and train safe, capable and confident drivers with all the skills necessary safely use a car in today's road system and successfully pass DMV examinations. There isn't a driver we can't improve.</p>
					<h2>Company Name</h2>
					<p>Safety First was founded in 1995 and has grown from a single instructor/single car operation to one of the largest driving schools in the state of California. For In Car Driver's training, we service areas from the San Fernando Valley in Los Angeles to Santa Barbara and Goleta and all the areas in between.<span class="text-regular"> Our Online Driver education is valid anywhere in the state of California.</span></p>
				</div>
				<div class="clearfix"></div>
					<div class="text1 padding-cus">
					
					<p>Safety First has an excellent reputation for providing high quality, 1-on-1 driver training and online driver education.  We do not cut corners, and we show up on time in a clean, well maintained car with a highly trained and screened instructor.  All of our instructors teach using a common syllabus.  We have developed and refined our curriculum over the past 20 years with input from our instructors, students, parents, education professionals and various professional drivers.</p>
					
					</div>
					<div class="text-2 padding-cus">
					
					<p>We realize there are many driving schools available and some of them are very good.  You can feel confident when selecting Safety first knowing that our reputation and longevity speak to our high quality service..</p>
					
					<p class="padding-cus">Safety First Driving School is licensed by the California Department of Motor Vehicles (license #DS3832). We are also Bonded and Insured.</p>
					</div>
					
					<div class="padding-cus">
						
					
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
			</div> <!--content ends here -->
				
						
			</div>
			
			</div>
		
		
		</div>	<!--inner-content-->
<?php

include("footer.php");

?>