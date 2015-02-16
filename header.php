<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>Safety First Driving School</title>
<link href="/media/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/media/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="/media/css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="/media/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="/media/css/font-awesome.css" rel="stylesheet" type="text/css" />

<script src="/media/js/jquery-latest.min.js" type="text/javascript" ></script>

<script src="/media/js/bootstrap.js" type="text/javascript"></script>
<script src="/media/js/jquery.anchor.js" type="text/javascript"></script>
<script src="/media/js/bootstrap-select.js" type="text/javascript"></script> 
<script src="/media/js/bootstrap-datepicker.js" type="text/javascript"></script> 
<script src="/media/js/angular.min.js" type="text/javascript"></script>
<script src="/media/js/angular-resource.min.js" type="text/javascript"></script>
<script src="/media/js/app.js" type="text/javascript"></script> 
<script src="/media/js/jquery.popupoverlay.js" type="text/javascript"></script>

<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


</head>
<?php session_start(); 
$username=isset($_SESSION['username'])?$_SESSION['username']:"";
$userID=isset($_SESSION['userid'])?$_SESSION['userid']:"";

?>
<body ng-app="mainApp" ng-controller="mainController" ng-init="init('<?php echo $username;?>','<?php echo $userID;?>')" ng-cloak><div class="pagecontainer">

<div class="wrapper">

<div class="header-fixed">
<div class="container">
 <div class="row bot-header">
  <div class="col-md-3 col-sm-3">
   <div class="logo row">
    <a href="index.php">
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
    <li ng-show="!logined"><a href="https://newhtml.drivingware.com/register.php"><i class="fa fa-user"></i> SIGN-UP</a></li>
	<li ng-show="logined"><a href="#"><i class="fa fa-user"></i>{{username}}</a></li>
  </ul>
</div>
    
 <div class="modal fade pop-up-prp" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true"><img src="/media/img/cross.png" alt="cross"/></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{{subtitle}}</h4>
      </div>
      <div class="modal-body">
		  <div class="pop-up-content col-md-12 col-sm-12" ng-show="flag==0">
				<form class="" name="loginForm" ng-submit="LoginFormSubmit()" validate>
					<div class="form-group" ng-class="{ 'has-error' : loginForm.login_email.$invalid && !loginForm.login_email.$pristine }">
						<div class="col-md-3 col-sm-3"><label> Email  </label></div> 
						<div class="col-md-6 col-sm-6">
							<input type="email" name="login_email"  class="form-control" ng-model="login_email" required/>
						</div>
						<span class="col-md-3 col-sm-3 help-inline"  style="color:red;" ng-show="loginForm.login_email.$dirty && loginForm.login_email.$invalid">
							<label ng-show="loginForm.login_email.$error.required">Email is required.</label>
							<label ng-show="loginForm.login_email.$error.email">Invalid email address.</label>
						</span>
					</div>
					<div class="clearfix"></div>
					<div class="form-group" ng-class="{ 'has-error' : loginForm.login_password.$invalid && !loginForm.login_password.$pristine }">
						<div class="col-md-3 col-sm-3"><label> Password</label></div> 
						<div class="col-md-6 col-sm-6">
							<input type="password" name="login_password" class="form-control" ng-model="login_password" required>
						</div>
						<label class="col-md-3 col-sm-3 help-inline" ng-show="loginForm.login_password.$error.required && !loginForm.login_password.$pristine">Password is required</label>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3 col-sm-3"><label> Type</label></div> 
						<div class="col-md-6 col-sm-6">
							<select class="form-control"  ng-model="login_usertype" ng-options="usertype.name for usertype in usertypelist" style="width:100%;">
							</select>
						</div>
						
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3 col-sm-3"><label> </label></div> 
						<div class="col-md-6 col-sm-6">
							<div class="check-box"><input type="checkbox" ng-model="login_rememberme"/><label>Remember me</label></div>
						</div>
						
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10 col-sm-10">
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Sign In</button>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10 col-sm-10">
						<div class="col-md-3 col-sm-3"><label> </label></div> 
						<label class="help-inline col-md-8 col-sm-8" ng-show="existloginerror">{{loginerror}}</label>
					</div>
				</form>
				
		   </div>
		   <!--Enter Verification Code.//-->
		   <div class="pop-up-content col-md-12 col-sm-12" ng-show="flag==1">
				<form class="" name="verifyForm" ng-submit="verifyFormSubmit()" validate>
					<div class="form-group">
						<div class="col-md-12 col-sm-12"><label>We sent you Email verification Key for Password Recovery.<br/> Please Copy to here from Your email Inbox.</label></div> 
						
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3 col-sm-3"><label>Verification Key : </label></div> 
						<div class="col-md-6 col-sm-6">
							<input type="text" name="verifykey" class="form-control" ng-model="verifykey" required>
						</div>
						<label class="col-md-3 col-sm-3 help-inline" ng-show="verifyForm.verifykey.$error.required && !verifyForm.verifykey.$pristine">Verification Key is required</label>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10 col-sm-10">
						<label class="col-md-10 col-sm-10 help-inline">{{error}}</label>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10 col-sm-10">
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Verify</button>
					</div>
					
				</form>	
		    </div>
			<!--Enter New Password and Password Confirm.//-->
			<div class="pop-up-content col-md-12 col-sm-12" ng-show="flag==2">
				<form class="" name="newpasswordForm" ng-submit="newpasswordFormSubmit()" validate>
					   <div class="form-group" ng-class="{ 'has-error' : newpasswordForm.newpassword.$invalid && !newpasswordForm.password.$pristine }">
							<div class="col-md-3 col-sm-3"><label> New Password</label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="newpassword" class="form-control" ng-model="newpassword" ng-minlength="8" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="newpasswordForm.newpassword.$error.required && !newpasswordForm.newpassword.$pristine">Password is required</label>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="newpasswordForm.newpassword.$error.minlength">
								Password Should Contain At least 8 Characters
							</label>
							
					   </div>
					   <div class="clearfix"></div>
					   
					   <div class="form-group" ng-class="{ 'has-error' : newpasswordForm.newpassword_confirm.$invalid && !newpasswordForm.newpassword_confirm.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Password Confirm </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="newpassword_confirm" class="form-control" ng-model="newpassword_confirm"  required />
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="newpassword_confirm!=newpassword || newpasswordForm.newpassword_confirm.$invalid && !newpasswordForm.newpassword_confirm.$pristine">Confirm Password!</label>
					   </div>
					   <div class="clearfix"></div>
						<div class="col-md-10 col-sm-10">
							<label class="col-md-10 col-sm-10 help-inline">{{error}}</label>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-10 col-sm-10">
							<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;" ng-click="$('#myModal').hide();">Submit</button>
						</div>
				</form>	
		    </div>
      </div>
      <div class="modal-footer">
       <div ng-show="flag==0"><img src="/media/img/login.png" alt="user" /><a href="javascript:void(0);"  data-target="#myModal3" data-toggle="modal" ng-click="ForgotPassword_click()"> Forgot Password ?</a></div>
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
		<li <?php if($page=="student_dashboard") : ?> class="active" <?php endif; ?>> <a href="student_dashboard.php">Home</a> </li>
        
		<li <?php if($page=="drivers_ed") : ?> class="active" <?php endif; ?>>  <a href="driver_ed.php">Driver's Ed</a> </li>
        
		<li <?php if($page=="behind_the_wheel") : ?> class="active" <?php endif; ?>> <a href="behind_the_wheel.php">Behind The Wheel</a> </li>
        
		
		<li <?php if($page=="pricing") : ?> class="active" <?php endif; ?>  > <a href="pricing.php">Pricing</a></li>
        
		
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

<!--Loading//-->
<div id="spinner">
	<div id="loaderwrapper">
	</div>
</div>
