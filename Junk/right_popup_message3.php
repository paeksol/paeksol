<div class="right-section col-md-3 col-sm-3">
	<div class="row">
    <div class="Login-form">
	<div class="login-top"><h1>Drop Us A Message</h1></div>
	<div class="login-body">
	 <div class="successHolder topMargin whiteText" id="basicsSuccess">
	          Thank you. Your message has been sent. We will get back to you shortly.
	 </div>
	 <div class="errorsHolder" id="contactFormErrors">
            Please correct the following errors;

            <ul>
                <span id="nameErrorShow" style="display:none;"><li><span id="nameError"></span></li></span>
                <span id="emailErrorShow" style="display:none;"><li><span id="emailError"></span></li></span>
                <span id="phoneErrorShow" style="display:none;"><li><span id="phoneError"></span></li></span>
                <span id="messageErrorShow" style="display:none;"><li><span id="messageError"></span></li></span>
            </ul>
        </div>
	<div class="">
	<form method="POST" name="contactUsForm" id="contactUsForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" />
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" />
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" />
            <label for="message">Comments:</label>
            <textarea  id="comments" name="comments"></textarea>
            <button type="submit" name="submitContactForm" id="submitContactForm" value="true" class="btn bt">Submit</button>
            <input type="hidden" name="currentpage" id="currentpage" value="<?=isset($currentpage)?$currentpage:"no page set";?>">
    </form>
	</div>
	</div>
	</div>
	</div> <!--right-section-->
<style type="text/css">
	textarea{
		background: none repeat scroll 0 0 #ecede9;
	    border: 1px solid #c9cac6;
	    height: 118px;
	    padding: 0 2%;
	    width: 85%;
	    margin-left: 24px;
	}
</style>	
<script type="text/javascript">
    function hideContactErrors() {
        document.getElementById("contactFormErrors").style.display = "none";
        document.getElementById("nameErrorShow").style.display = "none";
        document.getElementById("emailErrorShow").style.display = "none";
        document.getElementById("phoneErrorShow").style.display = "none";
        document.getElementById("messageErrorShow").style.display = "none";
    }

    $("#submitContactForm").click(
        function() {
            hideContactErrors();

            var data = {
                "name":$("#name").val(),
                "email":$("#email").val(),
                "phone":$("#phone").val(),
                "comments":$("#comments").val(),
                "currentpage" : $("#currentpage").val()
            };

            data = $(this).serialize() + "&" + $.param(data);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/mail/Contact.php",
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
                    }
                }
            });
            return false;
        }
    );
</script>