<?php

$page = "index";
include("header.php");

?>
<div class="inner-content">
		<div class="container">
			<div class="row">
				<div class="contact-us">
				<ol class="breadcrumb">
				  <li class="active">Contact Us</li>
				</ol>
		   <div class="successHolder topMargin whiteText" id="basicsSuccess">
	          Thank you. Your message has been sent. We will get back to you shortly.
	       </div>		
			<h1>Contact Us - Question - Suggestion - Feedback</h1>
			<div class="errorsHolder" id="contactFormErrors">
	            Please correct the following errors;

	            <ul>
	                <span id="nameErrorShow" style="display:none;"><li><span id="nameError"></span></li></span>
	                <span id="emailErrorShow" style="display:none;"><li><span id="emailError"></span></li></span>
	                <span id="phoneErrorShow" style="display:none;"><li><span id="phoneError"></span></li></span>
	                <span id="messageErrorShow" style="display:none;"><li><span id="messageError"></span></li></span>
	                <span id="subjectErrorShow" style="display:none;"><li><span id="subjectError"></span></li></span>
	            </ul>
            </div>
			<div class="inner-contact">
			<div class="col-md-6 col-sm-6">
				<ul class="my-form">
				<li><label>Subject</label> 
			     <select class="selectpicker" name="subject" id="subject">
				    <option value="">select subject</option>
					<option value="question">question</option>
				    <option value="suggestion">suggestion</option>
				    <option value="feedback">feedback</option>
				  </select>
		        </li>
				<li><label>Name</label> <input  type="text" id="name" name="name" ></li>
				<li><label>Email</label> <input  type="text" id="email" name="email"></li>
				<!-- <li><label>Address</label> <input  type="text" id="address" name="address"></li> -->
				<li><label>Telephone</label> <input  type="text" id="phone" name="phone"></li>
				<li><label>Comments</label> <textarea cols="" rows="" id="comments" name="comments"></textarea></li>
				<li><label> &nbsp; </label> <input type="button" name="submitContactForm" id="submitContactForm" value="Submit"></li>
				</ul>
			
			</div>
			
			<div class="col-md-6 col-sm-6 ctn-info">
			<h3>Contact Information</h3>
			<p>Our main office is in Westlake Village. We provide in car driver training with home/school/work pickup and drop off in all of Ventura County, San Fernando Valley and parts of Santa Barbara. </p>
			</br>
			<div id="googleMap" style="width:500px;height:380px;"></div>			<!--end map -->
			</div>
			<div class="clearfix"></div>
			</div>
				</div>		
			</div>
			
			</div>
		
</div>	<!--inner-content-->	
<!-- processing for the contact form -->
<script type="text/javascript">
    function hideContactErrors() {
        document.getElementById("contactFormErrors").style.display = "none";
        document.getElementById("nameErrorShow").style.display = "none";
        document.getElementById("emailErrorShow").style.display = "none";
        document.getElementById("phoneErrorShow").style.display = "none";
        document.getElementById("messageErrorShow").style.display = "none";
        document.getElementById("subjectErrorShow").style.display = "none";
    }

    $("#submitContactForm").click(
        function() {
            hideContactErrors();

            var data = {
                "name":$("#name").val(),
                "email":$("#email").val(),
                "phone":$("#phone").val(),
                "comments":$("#comments").val(),
                "subject":$("#subject").val(),
            };

            data = $(this).serialize() + "&" + $.param(data);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/website/contact/process",
                data: data,
                success: function(data) { 
                    if(data["status"] == "success") {
                        $(".successHolder").show();
                        setTimeout(function(){
                        $(".successHolder").hide();
                        },2000)
                        $("#name").val("")
		                $("#email").val("")
		                $("#phone").val("")
		                $("#comments").val("")
		                $("#subject").val("")
                    } else {
                        document.getElementById("contactFormErrors").style.display = "block";

                        /*
                         ********************************
                         * Test each error and display if needed
                         */
                        if(data["name"] != undefined) {
                            document.getElementById("nameErrorShow").style.display = "inline";
                            document.getElementById("nameError").innerHTML = data["name"];
                        }
                        if(data["email"] != undefined) {
                            document.getElementById("emailErrorShow").style.display = "inline";
                            document.getElementById("emailError").innerHTML = data["email"];
                        }
                        if(data["phone"] != undefined) {
                            document.getElementById("phoneErrorShow").style.display = "inline";
                            document.getElementById("phoneError").innerHTML = data["phone"];
                        }
                        if(data["comments"] != undefined) {
                            document.getElementById("messageErrorShow").style.display = "inline";
                            document.getElementById("messageError").innerHTML = data["comments"];
                        }

                        if(data["subject"] != undefined) {
                            document.getElementById("subjectErrorShow").style.display = "inline";
                            document.getElementById("subjectError").innerHTML = data["subject"];
                        }
                    }
                }
            });
            return false;
        }
    );
</script>		
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script>
var myCenter=new google.maps.LatLng(34.170561,-118.837594);

function initialize()
{
	var mapProp = {
	  center:myCenter,
	  zoom:8,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);

	var infowindow = new google.maps.InfoWindow({
	  content:" 3055 E. Thousand Oaks Bl,Westlake Village, Ca 91362",
	  });

	infowindow.open(map,marker);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php

include("footer.php");
?>
