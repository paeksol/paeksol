<?php

$page = "index";
include("header.php");

?>

<div class="slider">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"  data-interval="3000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1" ></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="/media/img/banner-1.jpg"  alt="Image1">
      <div class="carousel-caption">
  <p><span>Safety First</span> <span>Driving School</span></p>
      </div>
    </div>
    <div class="item">
      <img src="/media/img/banner-2.jpg" alt="Image2">
      <div class="carousel-caption">
  <p><span>Safety First</span> <span>Driving School</span></p>
      </div>
    </div>
<div class="item">
      <img src="/media/img/banner-3.jpg" alt="Image3">
      <div class="carousel-caption">
  <p><span>Safety First</span> <span>Driving School</span></p>
      </div>
    </div>
  </div>

 <div class="toggle-button"><a href="#scroll"><img src="/media/img/slider-arrow.png" alt="toggle"/></a></div>
</div>
				
</div><!--slider-->
			
<div id="scroll" class="container">
<div class="content-top col-md-12 col-sm-12">
		<h3>Want more info ?</h3>
		<p>We make the process easy.</p>
		<p>Tell us who you are and We'll tell you what you need</p>
</div>

<!--top container-->
</div>				
	<div class="car-image">
	<div class="car-overlay">
	<div class="container text-center ">
	<div class="col-md-4 col-sm-4 purple-text">
		<div class="circle1"><img src="/media/img/image1.jpg" alt="1"/></div>
		<!--<a href="javascript:void(0);" class="parent_new_driver">Parents of New Drivers</a>//-->
		<a class="initialism fadeandscale_open btn btn-success " href="">Parents of New Drivers</a>
	</div>
	<div class="col-md-4 col-sm-4 purple-text">
		<div class="circle1"><img src="/media/img/image2.jpg" alt="2"/></div>
		<!--<a href="javascript:void(0);" class="teen_student">Teen Student</a>//-->
		<a class="initialism fadeandscale_open btn btn-success " href="">Teen Student</a>
	</div>
	<div class="col-md-4 col-sm-4 purple-text">
		<div class="circle1"><img src="/media/img/image3.jpg" alt="3"/></div>
		<!--<a href="javascript:void(0);" class="adult_student">Adult Student</a>//-->
		<a class="initialism fadeandscale_open btn btn-success " href="">Adult Student</a>
		
	</div>
	</div>
	</div>
	</div>	

<!-- Set defaults -->
<script>
$(document).ready(function () {
    $.fn.popup.defaults.pagecontainer = '.pagecontainer'
});
</script>


<!-- Fade & scale -->


<div id="fadeandscale" class="well">
    <h4></h4>
	<button class="fadeandscale_close slide_close btn btn-default" style="float:right;margin:5px;">No</button>
    <button class="fadeandscale_close slide_open btn btn-default" style="float:right;margin:5px;">Yes</button>
</div>




<script>
$(document).ready(function () {
	var curindex=0;
	var alerttitles=new Array("Does your Son or Daughter already have their permit?",
	"Do you have your permit?",
	"Do you already have a license or a permit?");
	
	$("a.fadeandscale_open").click(function(){
		curindex=$("a.fadeandscale_open").index(this);
		$("#fadeandscale>h4").html(alerttitles[curindex]);
		return true;
	});
    $('#fadeandscale').popup({
        pagecontainer: '.pagecontainer',
        transition: 'all 0.3s'
    });
	
	$(".slide_open").click(function(){
		
		
		switch(curindex)
		{
		case 0:
			window.location="parent_teen_with_permit.php";
			break;
		case 1:
			window.location="teen_with_permit.php";
			break;
		case 2:
			window.location="adult_with_permit.php";
			break;
		}
		return false;
	});
	$(".slide_close").click(function(){
		
		switch(curindex)
		{
		case 0:
			window.location="parent_teen_with_no_permit.php";
			break;
		case 1:
			window.location="teen_with_no_permit.php";
			break;
		case 2:
			window.location="adult_with_no_permit.php";
			break;
		}
		return false;
	});

});
</script>

<style>
#fadeandscale {
    -webkit-transform: scale(0.8);
       -moz-transform: scale(0.8);
        -ms-transform: scale(0.8);
            transform: scale(0.8);
}
.popup_visible #fadeandscale {
    -webkit-transform: scale(1);
       -moz-transform: scale(1);
        -ms-transform: scale(1);
            transform: scale(1);
}

</style>
	
	

<!--
<script type="text/javascript">
	$(".parent_new_driver").on("click",function(){
		if(confirm("Does your Son or Daughter already have their permit?")){
			window.location="parent_teen_with_permit.php";
		}else{
			window.location="parent_teen_with_no_permit.php";
		}
	})
	$(".teen_student").on("click",function(){
		if(confirm("Do you have your permit?")){
			window.location="teen_with_permit.php";
		}else{
			window.location="teen_with_no_permit.php";
		}
	})
	$(".adult_student").on("click",function(){
		if(confirm("Do you already have a license or a permit?")){
			window.location="adult_with_permit.php";
		}else{
			window.location="adult_with_no_permit.php";
		}
	})
</script>	
//-->


<?php


include("footer.php");

?>