<?php

$page = "register";
include("header.php");
?>
<div class="inner-content" ng-app="validationApp"  ng-controller="mainController" ng-cloak>
		 <div class="modal-header">
			<h4 class="modal-title" id="myModalLabel"></h4>
		 </div>
		 
		 <form class="" name="userForm" ng-submit="submitForm()" validate >
			 <div class="pop-up-content pop-up-content row"   ng-show="step1">
					<div class="col-md-12 stepdisplay" style="padding:0px!important;margin-left:10%;margin-right:10%">
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Basic<br>Student Info</div>
							<div class="col-md-12 stepdisplaycontent first" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Parent/Emergency Contact<br>Alternate Pickup</div>
							<div class="col-md-12 stepdisplaycontent" style="background-color:#d3d3d3;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Package Seletion<br>Payment Processing</div>
							<div class="col-md-12 stepdisplaycontent last" style="background-color:#d3d3d3;padding:0px!important;"></div>
						</div>
					</div>
					
					<!--First column.//-->
					<div class="col-md-6 ">
						
						<div class="form-group" ng-class="{ 'has-error' : userForm.fname.$invalid && !userForm.fname.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Name </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="fname"  class="form-control" ng-model="fname" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.fname.$invalid && !userForm.fname.$pristine" >Name is required</label>
						</div>
						<div class="clearfix"></div>
						<div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Email Address: </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="email" name="email"  class="form-control" ng-model="email" required ng-blur="emailchecking()"/>
								
							</div>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;" ng-show="userForm.email.$dirty && userForm.email.$invalid">
							  <label ng-show="userForm.email.$error.required">Email is required.</label>
							  <label ng-show="userForm.email.$error.email">Invalid email address.</label>
							</span>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;"   ng-show="userForm.email.$valid">
								<span id="mailcheckmark" ng-show="userForm.email.$valid && mailok"></span>
								<span ng-show="userForm.email.$valid && mailnook">That email address is already in use</span>
							</span>
					   </div>
					   <div class="clearfix"></div>
					   
					   <div class="form-group" ng-class="{ 'has-error' : userForm.password.$invalid && !userForm.password.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Password</label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="password" class="form-control" ng-model="password" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.password.$invalid && !userForm.password.$pristine">Password is required</label>
					   </div>
					   <div class="clearfix"></div>
					   
					   <div class="form-group" ng-class="{ 'has-error' : userForm.password_confirm.$invalid && !userForm.password_confirm.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Password Confirm </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="password_confirm" class="form-control" ng-model="password_confirm" required />
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="password_confirm!=password || userForm.password_confirm.$invalid && !userForm.password_confirm.$pristine">Confirm Password!</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.phonenumber.$invalid && !userForm.phonenumber.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Phone Number </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="phonenumber" class="form-control" ng-model="phonenumber" required ng-pattern="phoneNumberPattern" >
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.phonenumber.$error.required && !userForm.phonenumber.$pristine" >PhoneNumber is required</label>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="!userForm.phonenumber.$error.required && userForm.phonenumber.$invalid && userForm.phonenumber.$error && !userForm.phonenumber.$pristine" >PhoneNumber is invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.address.$invalid && !userForm.address.$pristine }">
			            <div class="col-md-3 col-sm-3"><label> Address </label></div> 
			            <div class="col-md-6 col-sm-6">
							<input type="text" name="address" class="form-control" ng-model="address"  required>
						</div>
						<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.address.$invalid && !userForm.address.$pristine" >address is required</label>
					   </div>
					   <div class="clearfix"></div>
					
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> City </label></div> 
							<div class="col-md-6 col-sm-6">
								<select class="form-control" ng-model="mycity" ng-model="citylist" ng-options="city.name for city in citylist" required>
									<option value="">-- Choose City Name. --</option>
								</select>
								
							</div>
							
					   </div>
					   <div class="clearfix"></div>
					   
						<div class="form-group" ng-class="{ 'has-error' : userForm.zip.$invalid && !userForm.zip.$pristine }">
							<div class="col-md-3 col-sm-3"><label> ZIP </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="zip" class="form-control" ng-model="zip"  required ng-pattern="zipcodePattern">
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.zip.$error.required && !userForm.zip.$pristine" >zip is required</label>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="!userForm.zip.$error.required && userForm.zip.$invalid && userForm.zip.$error && !userForm.zip.$pristine" >Zip is invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   
					</div>
					<!--Second column.//-->
					<div class="col-md-6 ">
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Gender </label></div> 
							<div class="col-md-3 col-sm-3">
								<input type="radio" value="Male" name="gender" class="" ng-model="gender" required selected="selected">Male</input>
							</div>
							<div  class="col-md-3 col-sm-3">
								<input type="radio" value="Female" name="gender" class="" ng-model="gender" required>Female</input>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group" ng-class="{ 'has-error' : userForm.birthday.$invalid && !userForm.birthday.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Birth Date </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="birthday" class="form-control" ng-model="birthday" id="birthday" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.birthday.$invalid && !userForm.birthday.$pristine" >Birthday is required</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.schoolname.$invalid && !userForm.schoolname.$pristine }">
							<div class="col-md-3 col-sm-3"><label> School Name </label></div>
							<div class="col-md-6 col-sm-6">
								<select class="form-control"  ng-model="myschool" ng-options="school.name for school in schoollist" style="width:100%;" required>
								  <option value="">-- Choose School Name. --</option>
								</select>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.schoolname.$invalid && !userForm.schoolname.$pristine" >schoolname is required</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.permit.$invalid && !userForm.permit.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Permit # </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="permit" class="form-control" ng-model="permit"  ng-pattern="permitPattern" >
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.permit.$invalid && userForm.permit.$error && !userForm.permit.$pristine" >Permit # is invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.pissuedate.$invalid && !userForm.pissuedate.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Permit Issue Date </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="pissuedate" class="form-control" ng-model="pissuedate" id="pissuedate">
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.pissuedate.$invalid && !userForm.pissuedate.$pristine" >Invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm.pexpirationdate.$invalid && !userForm.pexpirationdate.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Permit Expiration Date </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="pexpirationdate" class="form-control" ng-model="pexpirationdate" id="pexpirationdate">
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.pexpirationdate.$invalid && !userForm.pexpirationdate.$pristine" >Invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   
				   </div>
				   <div class="clearfix"></div> 
				   <div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
						<hr/>
				   </div>
				   <div class="col-md-10 col-sm-10">
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Save and Continue</button>
						<ul class="social-icon  col-md-3 col-sm-3" style="margin:20px;float:right;">
							<li><a href="#"><i class="fa fa-facebook" ng-click="sociallogin(0)" ></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" ng-click="sociallogin(1)" ></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" ng-click="sociallogin(2)" ></i></a></li>
						</ul>
						<div class="clearfix"></div>
						<div id="fb-root"></div>
				   </div>
				 
			 </div>
		 </form>
		 <!-- Step 2 //-->
		 <form class="" name="userForm2"  ng-submit="submitForm2()"  validate >
			 <div class="pop-up-content pop-up-content row"  ng-show="step2" >
					<div class="col-md-12 stepdisplay" style="padding:0px!important;margin-left:10%;margin-right:10%">
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Basic<br>Student Info</div>
							<div class="col-md-12 stepdisplaycontent first" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Parent/Emergency Contact<br>Alternate Pickup</div>
							<div class="col-md-12 stepdisplaycontent" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Package Seletion<br>Payment Processing</div>
							<div class="col-md-12 stepdisplaycontent last" style="background-color:#d3d3d3;padding:0px!important;"></div>
						</div>
					</div>
					
					<!--First column.//-->
					<div class="col-md-6 ">
						<div class="form-group col-md-12 col-sm-12"">lst Parent/Emergency Contact*</div>
						<div class="form-group" ng-class="{ 'has-error' : userForm2.fpname.$invalid && !userForm2.fpname.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Name : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="fpname" class="form-control" ng-model="fpname" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm2.fpname.$invalid && !userForm2.fpname.$pristine" >Name is required</label>
						</div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm2.fpemail.$invalid && !userForm2.fpemail.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Email : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="email" name="fpemail" class="form-control" ng-model="fpemail" required/>
							</div>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;" ng-show="userForm2.fpemail.$dirty && userForm2.fpemail.$invalid">
							  <label ng-show="userForm2.fpemail.$error.required">Email is required.</label>
							  <label ng-show="userForm2.fpemail.$error.email">Invalid email address.</label>
							</span>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm2.fpphonenumber.$invalid && !userForm2.fpphonenumber.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Phone Number </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="fpphonenumber" class="form-control" ng-model="fpphonenumber" required ng-pattern="phoneNumberPattern" >
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm2.fpphonenumber.$error.required && !userForm2.fpphonenumber.$pristine" >PhoneNumber is required</label>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="!userForm2.fpphonenumber.$error.required && userForm2.fpphonenumber.$invalid && userForm2.fpphonenumber.$error && !userForm2.fpphonenumber.$pristine" >PhoneNumber is invalid</label>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group col-md-12 col-sm-12">2st Parent/Emergency Contact</div>
						<div class="form-group" >
							<div class="col-md-3 col-sm-3"><label> Name : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="spname" class="form-control" ng-model="spname">
							</div>
							
						</div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm2.spemail.$invalid && !userForm2.spemail.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Email : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="email" name="spemail" class="form-control" ng-model="spemail"/>
							</div>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;" ng-show="userForm2.spemail.$dirty && userForm2.spemail.$invalid">
							  <label ng-show="userForm2.spemail.$error.email">Invalid email address.</label>
							</span>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group" ng-class="{ 'has-error' : userForm2.spphonenumber.$invalid && !userForm2.spphonenumber.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Phone Number </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="spphonenumber" class="form-control" ng-model="spphonenumber" ng-pattern="phoneNumberPattern" >
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="!userForm2.spphonenumber.$error.required && userForm2.spphonenumber.$invalid && userForm2.spphonenumber.$error && !userForm2.spphonenumber.$pristine" >PhoneNumber is invalid</label>
					   </div>
					</div>
					<!--Second column.//-->
					<div class="col-md-6 ">
						<div class="form-group col-md-12 col-sm-12">Alternate Pick up Location</div>
						<div class="form-group" >
							<div class="col-md-3 col-sm-3"><label> Name : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="apname" class="form-control" ng-model="apname">
							</div>
						</div>
					   <div class="clearfix"></div>
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Address : </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="text" name="apaddress" class="form-control" ng-model="apaddress"/>
							</div>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> City </label></div> 
							<div class="col-md-6 col-sm-6">
								<select class="form-control" ng-model="apcity" ng-model="citylist" ng-options="city.name for city in citylist">
									<option value="">-- Choose City Name. --</option>
								</select>
								
							</div>
							
					   </div>
					   <div class="clearfix"></div>
					   
					</div>
				   <!--//End of Second column.//-->
				   
				   <div class="clearfix"></div> 
				   
				   <div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
						<hr/>
				   </div>
				   
				   <div class="col-md-10 col-sm-10">
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Save and Continue</button>
						<div class="clearfix"></div>
				   </div>
			 </div>
			
		 </form>
		 
		 <!-- Step 3 //-->
		 <form class="" name="userForm3"  ng-submit="submitForm3()"  validate>
			 <div class="pop-up-content pop-up-content row"   ng-show="step3">
					<div class="col-md-12 stepdisplay" style="padding:0px!important;margin-left:10%;margin-right:10%">
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Basic<br>Student Info</div>
							<div class="col-md-12 stepdisplaycontent first" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Parent/Emergency Contact<br>Alternate Pickup</div>
							<div class="col-md-12 stepdisplaycontent" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
						<div class="col-md-3 ">
							<div class="col-md-12 stepdisplayhead">Package Seletion<br>Payment Processing</div>
							<div class="col-md-12 stepdisplaycontent last" style="background-color:#F37736;padding:0px!important;"></div>
						</div>
					</div>
					
					<!--First column.//-->
					<div class="col-md-6 ">
						
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Package </label></div>
							<div class="col-md-6 col-sm-6">
								<select class="form-control"  ng-model="mypackage" ng-options="package.name for package in packagelist" style="width:100%;">
								  <option value="">-- Choose Package Name. --</option>
								</select>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Coupon Code : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="couponcode" class="form-control" ng-model="couponcode"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Additional Discount : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="addiscount" class="form-control" ng-model="addiscount"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Discount Note : </label></div>
							<div class="col-md-6 col-sm-6">
								<textarea name="discountnote" class="form-control" ng-model="discountnote"></textarea>
							</div>
						</div>
					    <div class="clearfix"></div>
					</div>
					<!--Second column.//-->
					<div class="col-md-6 ">
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Payment Method </label></div>
							<div class="col-md-6 col-sm-6">
								<select class="form-control"  ng-model="mypaymentmethod" ng-options="payment.name for payment in paymentlist" style="width:100%;">
								  <option value="">-- Choose Payment Method. --</option>
								</select>
							</div>
					   </div>
					   <div class="clearfix"></div>
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Experiation : </label></div>
							<div class="col-md-6 col-sm-6">
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> Mo : </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="Number" name="experiation_mo" class="form-control" ng-model="experiation_mo" style="padding-right:0px;"/>
								</div>
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> Yr : </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="Number" name="experiation_yr" class="form-control" ng-model="experiation_yr" style="padding-right:0px;"/>
								</div>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Card Number : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="cardnumber" class="form-control" ng-model="cardnumber"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> CVV Code : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="cvvcode" class="form-control" ng-model="cvvcode"/>
							</div>
							
					    </div>
						<div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Billing Zip : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="billingzip" class="form-control" ng-model="billingzip"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
				   </div>
				   <div class="clearfix"></div> 
				   <div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
						<hr/>
				   </div>
				   <div class="col-md-10 col-sm-10">
				        <label class=" col-md-6 col-sm-6 "><h1>Price : $399.00</h2></label>
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Save and Process</button>
						<div class="clearfix"></div>
				   </div>
			 </div>
		 </form>
</div>	<!--inner-content-->	
<div id="spinner">
	<div id="loaderwrapper">
	</div>
</div>

<style>
#spinner{
	display:none;
	position: fixed;
	z-index: 100000;
	width: 100%;
	height: 100%;
	background-color: #d3d3d3;
	left: 0;
	top: 0;
	opacity:0.5;
}
#loaderwrapper
{
	background: url('/media/img/ajax-loader1.gif') no-repeat;
	background-size:50px;
	width: 50px;
	height: 50px;
	 vertical-align: middle; 
	margin: auto;
	position: fixed;
	left: 50%;
	top: 50%;
}
.stepdisplay>div
{
	margin-bottom:30px;
	margin-top:20px;
}
.stepdisplay>div
{
	padding:0px!important;
}
.stepdisplayhead
{
	text-align: center;
	margin-bottom:10px;
}
.stepdisplaycontent
{
	height:5px;
	
}
.stepdisplaycontent.first
{
		border-radius : 30px 0px 0px 30px;
}
.stepdisplaycontent.last
{
		border-radius : 0px 30px 30px 0px;
}

</style>
<?php

include("footer.php");

?>