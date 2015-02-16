<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>Safety First Driving School</title>
<link href="/media/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/media/css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="/media/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="/media/css/font-awesome.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/media/js/jquery-latest.min.js"></script>
<script src="/media/js" type="text/javascript"></script>
<script src="/media/js/jquery.anchor.js" type="text/javascript"></script>
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div class="wrapper">

<div class="header-fixed">
<div class="container">
 <div class="row bot-header">
  <div class="col-md-3 col-sm-3">
   <div class="logo row">
    <a href="javascript:void(0);">
       <img src="/media/img/logo.png" alt="SAFETY FIRST"/>
     </a>
   </div>
  </div>
  <div class="col-md-9 col-sm-9">
  <div class="top-menu text-right">
  <ul>
    <li><a href="javascript:void(0);" class="cont-no">(805)-374-2393</a></li>
    <li><a href="javascript:void(0);" class="cont-no border-top">(818)-865-9455</a></li>
    <li data-target="#myModal" data-toggle="modal" ><a href="javascript:void(0);"><i class="fa fa-key"></i> LOGIN</a></li>
    <li data-target="#myModal2" data-toggle="modal"><a href="javascript:void(0);"><i class="fa fa-user"></i> SIGN-UP</a></li>
  </ul>
</div>
    
 <div class="modal fade pop-up-prp" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="/media/img/cross.png" alt="cross"/></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign in With your account.</h4>
      </div>
      <div class="modal-body">
      <div class="errorsHolder topMargin" id="loginErrors">
        Please correct the following errors;
        <ul id="logerrors"></ul>
    </div>
       <div class="pop-up-content col-md-12 col-sm-12">
                <form method="POST" id="loginForm" name="loginForm" action="/login">
                  <div class="new-input"><div class="col-md-4 col-sm-4"><label> Email Address </label></div> <div class="col-md-8 col-sm-8"><input type="text" name="emailAddress" id="emailAddress"  placeholder="example@address.com"/></div>
                  <div class="clearfix"></div></div>
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Password </label></div><div class="col-md-8 col-sm-8 "> <input type="password" name="password" id="password" placeholder="password"/></div>
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Type </label></div>
                  <div class="col-md-8 col-sm-8 ">
                   <select name="type" id="type" >
                        <option value="student" >Student</option>
                        <option value="parent" >Parent</option>
                    </select>
                    </div>
                  <div class="clearfix"></div></div>  
                  <div class="clearfix"></div></div>
                  <div class="buuton-new"><div class="col-md-4 col-sm-4 "><label>  </label></div>
                  <div class="col-md-8 col-sm-8 "> <button class="btn bt" name="login_submit" value="true" id="login_submit">Sign In</button>
                  <div class="check-box"><input type="checkbox"/> <label>Remember me</label></div>
                  <div class="login"><img src="/media/img/face-book.jpg" alt="facebook"/> <span>Login with facebook</span></div>
                  </div>
                  <div class="clearfix"></div></div>
                </form>
       
       </div>
       <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
       <div><img src="/media/img/login.png" alt="user" /><a href="javascript:void(0);"  data-target="#myModal3" data-toggle="modal" onclick="$('#myModal').hide();"> Forgot Password ?</a></div>
      </div>
    </div>
  </div>
</div> <!--pop-up 1-->


 <!--pop-up 2-->
<div class="modal fade pop-up-prp" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="/media/img/cross.png" alt="cross"/></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign up With your account.</h4>
      </div>
      <div class="successHolder topMargin whiteText" id="basicsSuccess">
          Thank you. Your account has been created successfully. Please activate your account via the link you have received in your email inbox.
      </div>
      <div class="errorsHolder topMargin" id="registrationErrors">
        Please correct the following errors;
        <ul>
            <span id="emailAddressErrorShow" style="display:none;"><li><span id="emailAddressError"></span></li></span>
            <span id="emailAddressConfirmationErrorShow" style="display:none;"><li><span id="emailAddressConfirmationError"></span></li></span>
            <span id="parentEmailaddressShow" style="display:none;"><li><span id="parentEmailaddressError"></span></li></span>
            <span id="parentEmailaddresssecondShow" style="display:none;"><li><span id="parentEmailaddresssecondError"></span></li></span>
            <span id="passwordErrorShow" style="display:none;"><li><span id="passwordError"></span></li></span>
            <span id="passwordConfirmationErrorShow" style="display:none;"><li><span id="passwordConfirmationError"></span></li></span>
            <span id="fullNameErrorShow" style="display:none;"><li><span id="fullNameError"></span></li></span>
            <span id="birthDateErrorShow" style="display:none;"><li><span id="birthDateError"></span></li></span>
            <span id="addressErrorShow" style="display:none;"><li><span id="addressError"></span></li></span>
            <span id="cityErrorShow" style="display:none;"><li><span id="cityError"></span></li></span>
            <span id="zipErrorShow" style="display:none;"><li><span id="zipError"></span></li></span>
            <span id="contactNumberErrorShow" style="display:none;"><li><span id="contactNumberError"></span></li></span>
            <span id="schoolNameErrorShow" style="display:none;"><li><span id="schoolNameError"></span></li></span>
            <span id="parent1RelationErrorShow" style="display:none;"><li><span id="parent1RelationError"></span></li></span>
            <span id="parent2RelationErrorShow" style="display:none;"><li><span id="parent2RelationError"></span></li></span>
        </ul>
      </div>
      <div class="modal-body">
      
       <div class="pop-up-content col-md-12 col-sm-12">
                <form method="POST" name="registerAccount" id="registerAccount" >
                <div class="new-input"><div class="col-md-4 col-sm-4"><label> Email Address: </label></div> <div class="col-md-8 col-sm-8"><input type="email" name="emailAddressregis" id="emailAddressregis" placeholder="example@address.com"/></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4"><label> Email Address Confirmation: </label></div> <div class="col-md-8 col-sm-8"><input type="email" name="emailAddressConfirmationregis" id="emailAddressConfirmationregis" placeholder="example@address.com"/></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Password </label></div><div class="col-md-8 col-sm-8 "> <input type="password"  name="passwordregis" id="passwordregis" placeholder=""/></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Password Confirm: </label></div><div class="col-md-8 col-sm-8 "> <input type="password"  name="passwordConfirmationregis" id="passwordConfirmationregis" placeholder=""/></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Full Name: </label></div><div class="col-md-8 col-sm-8 "> <input type="text" name="fullName" id="fullName" placeholder=""/></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Birth Date: </label></div><div class="col-md-8 col-sm-8 "> <span id="birthDate"><?php echo $birth_date_select; ?></span></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Address: </label></div><div class="col-md-8 col-sm-8 "> <input type="text" name="address" id="address" placeholder=""/></div>
                <div class="clearfix"></div></div>
                <!-- <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Alternate Address: </label></div><div class="col-md-8 col-sm-8 "> <span id="cityid"><?php echo $altaddress_select; ?></span></div>
                <div class="clearfix"></div></div> -->
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> City: </label></div><div class="col-md-8 col-sm-8 "> <span id="cityid"><?php echo $city_select; ?></span></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Zip: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"  name="zip" id="zip" placeholder=""  maxlength="5" /></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> State: </label></div><div class="col-md-8 col-sm-8 "> <?php echo $states_select; ?></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> School Name: </label></div><div class="col-md-8 col-sm-8 "> <?php echo $school_name; ?></div>
                <div class="clearfix"></div></div>
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Cell phone number: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"  name="contactNumber" id="contactNumber" placeholder=""/></div>
                <div class="clearfix"></div></div>

                <!-- student fields end up -->

                <!-- parent fields starting. -->

                <!-- first parent -->
                 
                <div class="col-md-4 col-sm-4 parent_text"><label> Parent/Guardian or Emergency Contact Details </label></div>
                <div class="clearfix"></div>
                
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Name: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"   name="parent1Name" id="parent1Name" placeholder=""/></div>
                <div class="clearfix"></div></div> 
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Email: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"  name="parent1Email" id="parent1Email" placeholder=""/></div>
                <div class="clearfix"></div></div> 
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Cell phone: </label></div><div class="col-md-8 col-sm-8 "> <input type="text" name="parent1Number" id="parent1Number" placeholder=""/></div>
                <div class="clearfix"></div></div> 
                <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Relation: </label></div><div class="col-md-8 col-sm-8 "> 
                <select name="parent1Relation" id="parent1Relation">
                    <option value="">select relation</option>
                    <option value="mother">Mother</option>
                    <option value="father">Father</option>
                    <option value="guardian">Guardian</option>
                </select></div>
                <div class="clearfix"></div></div> 


                <!-- second parent fields -->
                <div class="col-md-4 col-sm-4 parent_text"><label> 
                  <a href='javascript:void(0);' onclick="showSecondParentDetails('ShowSecondParentDetails')">
                    Add second Parent/Guardian?
                  </a> </label></div>
                <div class="clearfix"></div>
                <div id='ShowSecondParentDetails' style="display:none;">
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Name: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"   name="parent2Name" id="parent2Name" placeholder=""/></div>
                  <div class="clearfix"></div></div> 
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Email: </label></div><div class="col-md-8 col-sm-8 "> <input type="text"  name="parent2Email" id="parent2Email" placeholder=""/></div>
                  <div class="clearfix"></div></div> 
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Cell phone: </label></div><div class="col-md-8 col-sm-8 "> <input type="text" name="parent2Number" id="parent2Number" placeholder=""/></div>
                  <div class="clearfix"></div></div> 
                  <div class="new-input"><div class="col-md-4 col-sm-4 "><label> Parent/Guardian Relation: </label></div><div class="col-md-8 col-sm-8 "> 
                  <select name="parent2Relation" id="parent2Relation">
                      <option value="">select relation</option>
                      <option value="mother">Mother</option>
                      <option value="father">Father</option>
                      <option value="guardian">Guardian</option>
                  </select></div>
                  <div class="clearfix"></div></div> 
                </div>
                <div class="buuton-new"><div class="col-md-4 col-sm-4 "><label>  </label></div>
                <div class="col-md-8 col-sm-8 "> <button class="btn bt" type="submit" value="true" name="registrationSubmit" id="registrationSubmit">Sign up</button>
               <!--  <div class="check-box"><input type="checkbox"/> <label>Remember me</label></div> -->
                </br> </br> </br>
                <div class="login"><img src="/media/img/face-book.jpg" alt="facebook"/> <span>Login with facebook</span></div>
                </div>
                <div class="clearfix"></div></div>
                
                <input type="hidden" name="parent2Relationset" id="parent2Relationset" value="no">
                </form>
       
       </div>
       <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
      <!--  <div><img src="/media/img/login.png" alt="user" /> Forgot Password ? <a href="/website/login/forgotten">Click here</a></div> -->
      </div>
    </div>
  </div>
</div> <!--POP-UP-2-->

<!-- forgot pass -->
 <div class="modal fade pop-up-prp" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="/media/img/cross.png" alt="cross"/></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password.</h4>
      </div>
      <div class="modal-body">
      <div class="successHolder topMargin whiteText" id="basicsSuccess">
               Success! Password send on your email id that you provided ! Please check your mail.
      </div>
      <div id="forgotpasserror" class="errorsHolder" style="display: none;">
      Please correct the following errors;
      <ul class="err">
               <span id="emailAddressforgotErrorShow" style="display:none;"><li><span id="emailAddressforgotError"></span></li></span>
            </ul>
      </div>
       <div class="pop-up-content col-md-12 col-sm-12">
                <form method="POST" id="forgotForm" name="forgotForm" >
                  <div class="new-input"><div class="col-md-4 col-sm-4"><label> Email Address </label></div> <div class="col-md-8 col-sm-8"> <input type="text" name="emailid" id="emailid" /></div>
                  <div class="clearfix"></div></div>
                  <div class="buuton-new"><div class="col-md-4 col-sm-4 "><label>  </label></div>
                  <div class="col-md-8 col-sm-8 "> <button class="btn bt" name="forgot_submit" value="true" id="forgot_submit">Submit</button>
                  </div>
                  <div class="clearfix"></div></div>
                </form>
       </div>
       <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div> <!--pop-up 3-->



<div class="clearfix"></div>
<div class="menuu text-right">
                                
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li  class="active" ><a href="/website/general/show/index">Home</a></li>
         <li class="active" ><a href="/website/general/show/driver_ed">Driver's Ed</a></li>
         <li class="active" ><a href="/website/general/show/behind_the_wheel">Behind The Wheel</a></li>
         <li class="active" ><a href="/website/general/show/pricing">Pricing</a></li>
         <li class="active" ><a href="/student/dashboard/logout">Logout</a></li>
        
        
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
                    
</div>
<div class="clearfix"></div>
</div>
</div> <!--bot-header-->
</div>
<div class="clearfix"></div>
</div> <!--container-->

  <?php include($subview . '.php'); ?>

  <div class="footer footer-top">
    <div class="container foot-ul">
        <div class="row">
        <div class="col-md-3 col-sm-3"><ul>
    <div class="foot-head"><p>Popular Categories</p></div>
    <li><a href="/website/general/show/index"><i class="fa fa-angle-double-right"></i> Homepage</a></li>    
    <li><a href="/website/general/show/behind_the_wheel"><i class="fa fa-angle-double-right"></i> Behind The Wheel</a></li>
    <li><a href="/website/general/show/driver_ed"><i class="fa fa-angle-double-right"></i> Online Drivers Ed</a></li>
    <li><a href="#"><i class="fa fa-angle-double-right"></i> Free DMV practice test</a></li>
    <li><a href="/website/general/show/contact_us"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
    </ul></div>
    <div class="col-md-3 col-sm-3"><ul>
    <div class="foot-head"><p>Pricing</p></div>   
    <li><a href="/website/general/show/about_us"><i class="fa fa-angle-double-right"></i> About Us</a></li>
    <li><a href="/website/general/show/blog"><i class="fa fa-angle-double-right"></i> Blog</a></li>
    <li><a href="/website/general/show/our_cars"><i class="fa fa-angle-double-right"></i> Our Cars</a></li>
    <li><a href="/website/general/show/our_instructors"><i class="fa fa-angle-double-right"></i> Our Instructors</a></li>
    <!-- <li data-target="#myModal2" data-toggle="modal"><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Register</a></li> -->
    <li><a href="/website/general/show/register"><i class="fa fa-angle-double-right"></i> Register</a></li>
    <li><a href="/website/general/show/employement"><i class="fa fa-angle-double-right"></i> Employment</a></li>
    </ul></div>
    <div class="col-md-3 col-sm-3"><ul>
    <div class="foot-head"><p>Give us a call:</p></div>
    <li class="white-call">(805)-374-2393</li>
    <li class="white-call">(818)-865-9455</li>
    </ul></div>
    <div class="col-md-3 col-sm-3 "><ul class="last-coloumn">
    <div class="foot-head  clearfix"><p>Contact us</p></div>
    <li class="upper-case"> Safety First Driving School</li>
    <li> 3055 E. Thousand Oaks Bl, </li>
    <li> Westlake Village, Ca 91362</li>
    <li>Email: <a href="#">info@SafetyFirstDS.com</a></li>
    <li> Mon – Fri 11:00 AM – 6:00 PM </li>
    </ul></div>
         
    
    </div>

</div>
</div> <!--footer-->
<div class="foot-bott">
 <div class="container">
<p class="pull-left footer-text"><a href="#">&copy;2015 Safety First Driving School </a></p>
<ul class="pull-right social-icon">
<li><a href="#"><i class="fa fa-facebook"></i></a></li>
<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
<li><a href="#"><i class="fa fa-twitter"></i></a></li>
</ul>
<div class="clearfix"></div>
</div>
</div>
</div> <!--wrapper-->


<script>
  $(".close").on("click",function(){
    location.reload();
  })
    $("#forgot_submit").click(
        function() {
           var errhtml= ""; 
           if($("#emailid").val()==""){
              jQuery("#forgotpasserror").show();
              jQuery("#emailAddressforgotErrorShow").show();
              jQuery("#emailAddressforgotErrorShow").html("Email Must be filled in.");
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
                            jQuery("#forgotpasserror").hide();
                            jQuery(".successHolder").show();
                            setTimeout(function(){ $("#myModal3").hide(); },2000)
                    } else{
                            document.getElementById("forgotpasserror").style.display = "block";
                            jQuery("#emailAddressforgotErrorShow").show();
                            jQuery("#emailAddressforgotErrorShow").html(data["status"]);
                    }
                }
            });

            return false;
        }
    );

</script>
<!-- include the contact form on the right side -->
<?php //include("contactUsForm.php"); ?>
<style>
    #paymentform{
        margin-top: 50px;
    }
    #forgotpasserror{
        margin-top: -35px;
    }
</style>


<script type="text/javascript">
  
    function hideloginErrors() {
        document.getElementById("loginErrors").style.display = "none";
     
    }

 $("#login_submit").click(
        function() {

            hideloginErrors();

            var data = {
                "emailAddress":$("#emailAddress").val(),
                "password":$("#password").val(),
                "type":$("#type").val(),
                "login_submit" :$("#login_submit").val()
            };

            data = $(this).serialize() + "&" + $.param(data);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/website/login/login",
                data: data,
                success: function(data) { 
                    if(data["status"] == "success") {
                        window.location="/"+data['type'];
                    } else {
                        document.getElementById("loginErrors").style.display = "block";
                        $("#logerrors").html(data['errors']);
                    }
                }
            });
            return false;
        }
    );


    function showSecondParentDetails(div) {
        $("#"+div).fadeIn();
        $("#parent2Relationset").val("yes");
    }

    function hideRegistrationErrors() {
        document.getElementById("registrationErrors").style.display = "none";
        document.getElementById("emailAddressErrorShow").style.display = "none";
        document.getElementById("emailAddressConfirmationErrorShow").style.display = "none";
        document.getElementById("parentEmailaddressShow").style.display = "none";
        document.getElementById("parentEmailaddresssecondShow").style.display = "none";
        document.getElementById("passwordErrorShow").style.display = "none";
        document.getElementById("passwordConfirmationErrorShow").style.display = "none";
        document.getElementById("fullNameErrorShow").style.display = "none";
        document.getElementById("birthDateErrorShow").style.display = "none";
        document.getElementById("addressErrorShow").style.display = "none";
        document.getElementById("cityErrorShow").style.display = "none";
        document.getElementById("zipErrorShow").style.display = "none";
        document.getElementById("contactNumberErrorShow").style.display = "none";
        document.getElementById("schoolNameErrorShow").style.display = "none";
    }

    $("#registrationSubmit").click(
        function() {

            hideRegistrationErrors();
            var data = {
                "emailAddress":$("#emailAddressregis").val(),
                "emailAddressConfirmation":$("#emailAddressConfirmationregis").val(),
                "password":$("#passwordregis").val(),
                "passwordConfirmation":$("#passwordConfirmationregis").val(),
                "fullName":$("#fullName").val(),
                "birthDateMonth":$("#birthDateMonth").val(),
                "birthDateDay":$("#birthDateDay").val(),
                "birthDateYear":$("#birthDateYear").val(),
                "address":$("#address").val(),
                "city":$("#city").val(),
                "zip":$("#zip").val(),
                "state":$("#state").val(),
                "contactNumber":$("#contactNumber").val(),
                "parent2Name":$("#parent2Name").val(),
                "parent2Email":$("#parent2Email").val(),
                "parent2Number":$("#parent2Number").val(),
                "parent2Relation":$("#parent2Relation").val(),
                "parent1Name":$("#parent1Name").val(),
                "parent1Email":$("#parent1Email").val(),
                "parent1Number":$("#parent1Number").val(),
                "parent1Relation":$("#parent1Relation").val(),
                "school":$("#school").val(),
                "parent2Relationset":$("#parent2Relationset").val(),
               /* "alternate_address" : $("#alternate_address").val(),*/
            };

            data = $(this).serialize() + "&" + $.param(data);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/website/register/process",
                data: data,
                success: function(data) { 
                    if(data["status"] == "success") {
                          document.getElementById("basicsSuccess").style.display = "block";
                          var body = $(".modal");
                          body.animate({scrollTop:0}, '1000','swing',function() { 
                          });
                          setTimeout(function () { location.reload();},2000);
                    } else {
                      
                         var body = $(".modal");
                          body.animate({scrollTop:0}, '1000','swing',function() { 
                          });

                         document.getElementById("registrationErrors").style.display = "block";

                        /*
                         ********************************
                         * Test each error and display if needed
                         */
                        
                        if(data["emailAddress"] != undefined) {
                            document.getElementById("emailAddressErrorShow").style.display = "inline";
                            document.getElementById("emailAddressError").innerHTML = data["emailAddress"];
                        }
                        if(data["parent1Email"] != undefined) {
                            document.getElementById("parentEmailaddressShow").style.display = "inline";
                            document.getElementById("parentEmailaddressError").innerHTML = data["parent1Email"];
                        }
                        if(data["parent2Email"] != undefined) {
                            document.getElementById("parentEmailaddresssecondShow").style.display = "inline";
                            document.getElementById("parentEmailaddresssecondError").innerHTML = data["parent2Email"];
                        }
                        if(data["emailAddressConfirmation"] != undefined) {
                            document.getElementById("emailAddressConfirmationErrorShow").style.display = "inline";
                            document.getElementById("emailAddressConfirmationError").innerHTML = data["emailAddressConfirmation"];
                        }
                        if(data["password"] != undefined) {
                            document.getElementById("passwordErrorShow").style.display = "inline";
                            document.getElementById("passwordError").innerHTML = data["password"];
                        }
                        if(data["passwordConfirmation"] != undefined) {
                            document.getElementById("passwordConfirmationErrorShow").style.display = "inline";
                            document.getElementById("passwordConfirmationError").innerHTML = data["passwordConfirmation"];
                        }
                        if(data["fullName"] != undefined) {
                            document.getElementById("fullNameErrorShow").style.display = "inline";
                            document.getElementById("fullNameError").innerHTML = data["fullName"];
                        }
                        if(data["birthDate"] != undefined) {
                            document.getElementById("birthDateErrorShow").style.display = "inline";
                            document.getElementById("birthDateError").innerHTML = data["birthDate"];
                        }
                        if(data["address"] != undefined) {
                            document.getElementById("addressErrorShow").style.display = "inline";
                            document.getElementById("addressError").innerHTML = data["address"];
                        }
                        if(data["city"] != undefined) {
                            document.getElementById("cityErrorShow").style.display = "inline";
                            document.getElementById("cityError").innerHTML = data["city"];
                        }
                        if(data["zip"] != undefined) {
                            document.getElementById("zipErrorShow").style.display = "inline";
                            document.getElementById("zipError").innerHTML = data["zip"];
                        }
                        if(data["contactNumber"] != undefined) {
                            document.getElementById("contactNumberErrorShow").style.display = "inline";
                            document.getElementById("contactNumberError").innerHTML = data["contactNumber"];
                        }
                        if(data["school"] != undefined) {
                            document.getElementById("schoolNameErrorShow").style.display = "inline";
                            document.getElementById("schoolNameError").innerHTML = data["school"];
                        }
                        if(data["parent1Relation"] != undefined) {
                            document.getElementById("parent1RelationErrorShow").style.display = "inline";
                            document.getElementById("parent1RelationError").innerHTML = data["parent1Relation"];
                        }
                        if(data["parent2Relation"] != undefined) {
                            document.getElementById("parent2RelationErrorShow").style.display = "inline";
                            document.getElementById("parent2RelationError").innerHTML = data["parent2Relation"];
                        }
                    }
                    
                }
            });
            return false;
        }
    );

</script>
<style type="text/css">
 .errorsHolder ul li {
    display: block;
 }
 .parent_text{
  width: 100%;
  margin: 30px 0 10px 0;
 }
</style>

</body>
</html>