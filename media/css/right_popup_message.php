
		<div class="container">
			<div class="row">
				<div class="contact-us">
				<ol class="breadcrumb">
				  <li class="active"><?php echo $title; ?></li>
				</ol>
		   <div class="successHolder topMargin whiteText" id="basicsSuccess">
	          Thank you. Your message has been sent. We will get back to you shortly.
	       </div>		
			<h1><?php echo $description; ?></h1>
			<div class="errorsHolder" id="contactFormErrors">
				Please correct the following errors;
				<ul>
	                <div id="errormessage"></div>
	            </ul>
            </div>
			<div class="inner-contact">
			<?php if($visible_select==true){ ?>
				<div class="col-md-6 col-sm-6">
			<?php } else {?>
				<div class="col-md-12 col-sm-12">
			<?php } ?>
				<ul class="my-form">
				<?php if($visible_select==true){ ?>
				<li><label>Subject</label> 
			     <select class="selectpicker" name="subject" id="subject">
				    <option value="">select subject</option>
					<option value="question">question</option>
				    <option value="suggestion">suggestion</option>
				    <option value="feedback">feedback</option>
				  </select>
		        </li>
				<?php } ?>
				<li><label>Name</label> <input  type="text" id="name" name="name" ></li>
				<li><label>Email</label> <input  type="text" id="email" name="email"></li>
				<!-- <li><label>Address</label> <input  type="text" id="address" name="address"></li> -->
				<li><label>Telephone</label> <input  type="text" id="phone" name="phone"></li>
				<li><label>Comments</label> <textarea cols="" rows="" id="comments" name="comments"></textarea></li>
				<li><label> &nbsp; </label> <input type="button" name="submitContactForm" id="submitContactForm" value="Submit"></li>
				</ul>
			
			</div>
			<?php if($visible_select==true){ ?>
			<div class="col-md-6 col-sm-6 ctn-info">
				<h3>Contact Information</h3>
				<p>Our main office is in Westlake Village. We provide in car driver training with home/school/work pickup and drop off in all of Ventura County, San Fernando Valley and parts of Santa Barbara. </p>
				</br>
				<div id="googleMap" style="width:500px;height:380px;"></div>			<!--end map -->
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
			</div>		
			</div>
			
			</div>
		
	<!--inner-content-->	
<!-- processing for the contact form -->
<script type="text/javascript">
    function hideContactErrors() {
        document.getElementById("contactFormErrors").style.display = "none";
    }
 var emailfilter = /^.+@.+\..{2,3}$/; // for email validation.
 var phonefilter = /^(()?\d{3}())?(-|\s)?\d{3}(-|\s)?\d{4}$/; // for phone validation.

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
			
			//validation.
			
			$("#errormessage").html("");
			var validation_error="";
			
			if(data["subject"]=="")
			{
				validation_error += "Subject cannot be empty." + "<br/>";
				
			}
			if(data["name"]=="")
			{
				validation_error +=  "Name must be given." + "<br/>";
				
			}
			if(data["email"]=="")
			{
				validation_error += "Email must be given." + "<br/>";
				
			} else {
				if(!IsValidateEmail(data["email"]))
				{
					validation_error += " Invalid email address given." + "<br/>";
				}
			}
			
			if(data["phone"]=="")
			{
				validation_error += "Phone number must be given." + "<br/>";
				
			} else {
				if(!IsValidatePhone(data["phone"]))
				{
					validation_error += " Invalid phone number given." + "<br/>";
					
				}
			}
			if(data["comments"]=="")
			{
				validation_error += "Comments cannot be empty." + "<br/>";
				
			}
			
            if(validation_error != "")
			{
				$("#contactFormErrors").css("display","block");
				$("#errormessage").html(validation_error);
				return;
			}else{
				$("#contactFormErrors").css("display","none");
				$("#errormessage").html("");
			}
			
            data = $(this).serialize() + "&" + $.param(data);
			
			
            $.ajax({
                type: "POST",
                url: "/mail/Contact.php",
                data: data,
                success: function(data) { 
						$(".successHolder").show();
                        setTimeout(function(){
							$(".successHolder").hide();
                        },2000)
                        $("#name").val("")
		                $("#email").val("")
		                $("#phone").val("")
		                $("#comments").val("")
		                $("#subject").val("")
                    
                },
				error:function(data){
					alert("error : "+data);
				}
            });
			return false;
        }
    );
	function IsValidateEmail($value)
	{
		return emailfilter.test($value);
	}
	function IsValidatePhone($value)
	{
		return phonefilter.test($value);
	}
</script>	
