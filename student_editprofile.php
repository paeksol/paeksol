<?php

$page = "";
include("header.php");
?>
<div class="inner-content row">
  
  <div class="col-md-3"  style="padding:60px 0px 40px 80px;">
   <?php
    include("student_dashboard_sidebar.php");
   ?>  
   
  </div>
  <div class="col-md-9 student_dashboard_content" style="">
   <div class="dashboard_main">
					
 
 <div class="clearfix"></div>
 <form class="" name="userForm" ng-submit="UpdateUserInfo()" validate >   
				<div class="clearfix"></div>
					   <div class="col-md-12 col-sm-12">
							<button class="btn btn-warning col-md-2 col-sm-2 fixed_button" type="submit"  style="float:right;background-color:#f37736;" value="true">Save</button>
							<div class="clearfix"></div>
							<div id="fb-root"></div>
					   </div>
				<div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
					<div class=""><hr/></div>
					<div class="col-md-10">Student info</div>
				</div>
					<div class="col-md-12 ">
						
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
								<input type="email" name="email"  class="form-control" ng-model="email" required ng-change="emailchecking()"/>
								
							</div>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;" ng-show="userForm.email.$dirty && userForm.email.$invalid">
							  <label ng-show="userForm.email.$error.required">Email is required.</label>
							  <label ng-show="userForm.email.$error.email">Invalid email address.</label>
							</span>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;"   ng-show="userForm.email.$valid">
								<span class="checkmark" ng-show="userForm.email.$valid && mailok"></span>
								<span ng-show="userForm.email.$valid && mailnook">That email address is already in use</span>
							</span>
					   </div>
					   <div class="clearfix"></div>
					   <!--
					   <div class="form-group" ng-class="{ 'has-error' : userForm.password.$invalid && !userForm.password.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Password</label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="password" class="form-control" ng-model="password" ng-minlength="8" required>
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.password.$error.required && !userForm.password.$pristine">Password is required</label>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.password.$error.minlength">
								Password Should Contain At least 8 Characters
							</label>
							
					   </div>
					   <div class="clearfix"></div>
					   
					   <div class="form-group" ng-class="{ 'has-error' : userForm.password_confirm.$invalid && !userForm.password_confirm.$pristine }">
							<div class="col-md-3 col-sm-3"><label> Password Confirm </label></div> 
							<div class="col-md-6 col-sm-6">
								<input type="password" name="password_confirm" class="form-control" ng-model="password_confirm"  required />
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="password_confirm!=password || userForm.password_confirm.$invalid && !userForm.password_confirm.$pristine">Confirm Password!</label>
					   </div>
					   <div class="clearfix"></div>
					   //-->
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
					<div class="col-md-12 ">
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
								<select class="form-control"  ng-model="myschool" ng-options="school as school.name for school in schoollist" style="width:100%;" required>
								  <option value="">-- Choose School Name. --</option>
								</select>
								            
							</div>
							<label class="col-md-3 col-sm-3 help-inline" ng-show="userForm.schoolname.$invalid && !userForm.schoolname.$pristine" >schoolname is required</label>
					   </div>
					   
				</form>
				<form class="" name="userForm2"  ng-submit="submitForm2()"  validate >
					  <div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
							<div class=""><hr/></div>
							<div class="col-md-10">Permit/Certificate info</div>
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
				</form>   
		</div>
		<div class="clearfix"></div>
		<div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
					<div class=""><hr/></div>
					<div class="col-md-10">Parent/Emergency Contact/Alternate Pickup</div>
		</div>
		
		<div class="col-md-12 ">
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
					<div class="col-md-12 ">
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
  </div>
</div><!--inner-content--> 

<?php
include("footer.php");
?>