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
            <input type="hidden" name="currentpage" id="currentpage" value="<?=isset($page)?$page:"no page set";?>">
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
    $('#contactFormErrors, #nameErrorShow, #emailErrorShow, #phoneErrorShow, #messageErrorShow').hide();
}

$('#contactUsForm').on('submit', function(e) {
    e.preventDefault();
    hideContactErrors();

    $.ajax({
        url      : 'mailer.php',
        type     : 'POST',
        dataType : 'json',
        data     : $(this).serialize()
    }).done(function(data) {
        if (data.status == "success") {
            $(".successHolder").show().delay(2000).hide(1);
            $("#name, #email, #phone, #comments, #subject").val("")
        } else {
            $("#contactFormErrors").hide();
            $("#nameErrorShow").show().find('span').html(function(_, html) {return data.name||html;});
            $("#emailErrorShow").show().find('span').html(function(_, html) {return data.email||html;});
            $("#phoneErrorShow").show().find('span').html(function(_, html) {return phone.name||html;});
            $("#messageErrorShow").show().find('span').html(function(_, html) {return comments.name||html;});
        }
    });
});
</script>