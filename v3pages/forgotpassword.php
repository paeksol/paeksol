<div class="leftHolder">
    <div class="titleHolder"><h1>Forgot Password.</h1></div>

     <div class="formHolder paymentinfo" >
        <form method="POST" name="paymentform" id="paymentform"  >
        <!-- error block -->
        <div id="forgotpasserror" class="errorsHolder" style="display: none;">
			Please correct the following errors;
			<ul class="err">
               <span id="emailAddressErrorShow" style="display:none;"><li><span id="emailAddressError"></span></li></span>
            </ul>
		</div>
            <div class="successHolder topMargin whiteText" id="basicsSuccess">
               Success! Password send on your email id that you provided ! Please check your mail.
            </div>
            <div class="formLine">
                <label for="emailid">Enter Email ID :</label>
                <input type="text" name="emailid" id="emailid" />
            </div>
            <button type="submit" value="true" name="submit" id="submit">Send!</button>
        </form>
    </div>
</div>

<script>

function checkpaymentinfo () { 
	var err= true;
	var errhtml= ""; 
	
		if($("#emailid").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Email Must be filled in.</span></li>";
		}
	
	if(err==false){
		jQuery("#forgotpasserror").show();
		jQuery(".err").html(errhtml);
	}else{
		jQuery("#forgotpasserror").hide();
	}
   
	return err;
}

    $("#submit").click(
        function() {
           var errhtml= ""; 
           if($("#emailid").val()==""){
              jQuery("#forgotpasserror").show();
              document.getElementById("emailAddressErrorShow").style.display = "inline";
              document.getElementById("emailAddressError").innerHTML = "Email Must be filled in.";
              return false;
           }
    

            var data = {
                "emailid":$("#emailid").val(),
            };

            data = $(this).serialize() + "&" + $.param(data);
         

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/website/login/forgotten",
                data: data,
                success: function(data) {
                    if(data["status"] == "success") {
                            document.getElementById("basicsSuccess").style.display = "block";
                    } else{
                            document.getElementById("forgotpasserror").style.display = "block";
                            document.getElementById("emailAddressErrorShow").style.display = "inline";
                            document.getElementById("emailAddressError").innerHTML = data["status"];
                    }
                }
            });

            return false;
        }
    );

</script>
<!-- include the contact form on the right side -->
<?php include("contactUsForm.php"); ?>
<style>
    #paymentform{
        margin-top: 50px;
    }
    #forgotpasserror{
        margin-top: -35px;
    }
</style>