<?php

$page = "studentpaymentprocessing";
include("header.php");
?>
<div class="inner-content row">
  
  <div class="col-md-3"  style="padding:60px 0px 40px 80px;">
   <?php
    include("student_dashboard_sidebar.php");
   ?>  
   
  </div>
  <div class="col-md-9 student_dashboard_content" style="">
	<!-- Step 3 //-->
		 <form class="" name="userForm3"  ng-submit="PaymentProcessing()"  validate ng-show="viewflag">
			 <div class="pop-up-content pop-up-content row" >
					
					<div class="col-md-12" style="margin-top:30px;margin-left:10%;margin-right:10%" ng-show="false">
						<div class="col-md-10 ">
							<div class="col-md-6 ">Your CustomerProfileID on Authorize.net</div>
							<div class="col-md-6 ">{{customerProfileID}}</div>
						</div>
						
					</div>
					<!--First column.//-->
					<div class="col-md-6 ">
						
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Package </label></div>
							<div class="col-md-8 col-sm-8">
								<select class="form-control"  ng-model="mypackage" ng-options="package as package.name for package in packagelist" style="width:100%;">
								  <option value="">-- Choose Package Name. --</option> 
								</select>
								<!--Package Price  : {{ mypackage.price }}//-->
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Coupon Code : </label></div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="coupon_code" class="form-control" ng-model="coupon_code" ng-blur="getDetailOfCoupon()" ng-keydown="CouponReset();"/>
							</div>
							<span class="col-md-3 col-sm-3 help-inline"  style="color:red;">
								<span class="checkmark" ng-show="couponvalid"></span>
								<label class="help-inline" ng-show="couponinvalid" >Invalid Coupon</label>
							</span>
							<div class="col-md-3 col-sm-3"></div>
							<div class="col-md-8 col-sm-8">	
								<!--<select class="form-control"  ng-model="mycoupon" ng-options="coupon as coupon.name for coupon in couponlist" style="width:100%;">
								  <option value="">-- Choose Coupon. --</option>
								</select>//-->
								<input type="hidden" name="coupon_id" class="form-control" ng-model="coupon_id"/>
								<input type="hidden" name="coupon_amount" class="form-control" ng-model="coupon_amount"/>
								<input type="hidden" name="coupon_minpurchase" class="form-control" ng-model="coupon_minpurchase"/>
								<input type="hidden" name="coupon_maxuses" class="form-control" ng-model="coupon_maxuses"/>
								<input type="hidden" name="coupon_expiration" class="form-control" ng-model="coupon_expiration"/>
								<input type="hidden" name="coupon_timesused" class="form-control" ng-model="coupon_timesused"/>
								
								
							</div>
							
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3"></div>
							<div class="col-md-8 col-sm-8">
								<div ng-show="couponvalid">Original Price : ${{mypackage.price}}</div>
								<div ng-show="couponvalid">Coupon "{{coupon_code}}"  ${{ coupon_amount }}</div>
								<div ng-show="couponvalid">Discounted Price : ${{(mypackage.price-coupon_amount) | number:2}}</div>
								<div ng-show="couponvalid" style="margin-top:30px;">Amount to be charged : ${{(mypackage.price-coupon_amount) | number:2}}</div>
								<div><hr/></div>
								<div>Price : ${{(mypackage.price-coupon_amount) | number:2}}</div>
							</div>
						</div>
						<div class="clearfix"></div>
						
					</div>
					
					<!--Second column.//-->
					<div class="col-md-6 ">
					    
						<div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Payment Method </label></div>
							<div class="col-md-8 col-sm-8">
								<select class="form-control"  ng-model="mypaymentmethod" ng-options="payment.name for payment in paymentmethod" style="width:100%;" ng-change="selectPaymentMethod()">
								  <option value="">-- Choose Payment Method. --</option>
								</select>
							</div>
					   </div>
					   <div class="clearfix"></div>
					   <!--
					   <div class="form-group">
							<div class="col-md-3 col-sm-3"><label> Name on Card: </label></div>
							<div class="col-md-6 col-sm-6">
						
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> First Name </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="text" name="cardfname" class="form-control" ng-model="cardfname" style="padding-right:0px;"/>
								</div>
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> Last Name </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="text" name="cardlname" class="form-control" ng-model="cardlname" style="padding-right:0px;"/>
								</div>
							</div>
							
					   </div>
					   <div class="clearfix"></div>
					   //-->
					   <div class="form-group" ng-show="visiblenewpm">
							<div class="col-md-3 col-sm-3"><label> Card Number : </label></div>
							<div class="col-md-8 col-sm-8">
								<input type="text" name="cardnumber" class="form-control" ng-model="cardnumber"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group" ng-show="visiblenewpm">
							<div class="col-md-3 col-sm-3"><label> Expiration : </label></div>
							<div class="col-md-8 col-sm-8">
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> Mo : </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="Number" name="expiration_mo" class="form-control" ng-model="expiration_mo" style="padding-right:0px;" required/>
								</div>
								<div class="col-md-2 col-sm-2" style="padding-right:0px;"><label> Yr : </label></div>
								<div class="col-md-4 col-sm-4">
									<input type="Number" name="expiration_yr" class="form-control" ng-model="expiration_yr" style="padding-right:0px;" required/>
								</div>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="form-group" ng-show="visiblenewpm">
							<div class="col-md-3 col-sm-3"><label> CVV Code : </label></div>
							<div class="col-md-8 col-sm-8">
								<input type="text" name="cvvcode" class="form-control" ng-model="cvvcode"/>
							</div>
							
					    </div>
						<div class="clearfix"></div>
						<div class="form-group" ng-show="visiblenewpm">
							<div class="col-md-3 col-sm-3"><label> Billing Zip : </label></div>
							<div class="col-md-8 col-sm-8">
								<input type="text" name="billingzip" class="form-control" ng-model="billingzip" ng-pattern="zipcodePattern"/>
							</div>
							
					    </div>
					    <div class="clearfix"></div>
						<div class="clearfix"></div>
						<div class="form-group">
							 <span class="col-md-10 col-sm-10 help-inline"  style="color:red;">{{authorization_error}}</span>
						</div>
					    <div class="clearfix"></div>
				   </div>
				   <div class="clearfix"></div> 
				   <div class="col-md-10 col-sm-10" style="margin:0 auto;margin-left:10%;margin-right:10%;">
						<hr/>
				   </div>
				   <div class="col-md-10 col-sm-10">
						<div class=" col-md-6 col-sm-6 "></div>
						<button class="btn btn-warning col-md-2 col-sm-2 " type="submit"  value="true"  style="margin:20px;float:right;">Save and Process</button>
						<div class="clearfix"></div>
				   </div>
				  
			 </div>
		 </form>
		<div class="pop-up-content pop-up-content row" ng-show="!viewflag" >
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								<h3>Thank you for your purchase.</h3>
							</div>
							
					   
					    
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								<h4>Item Purchased : {{mypackage.name}}</h4>
							</div>
							
					   
					    
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								<h4>TransactionID : {{transactionID}}</h4>
							</div>
							
					   
					    
				</div>
				 <div class="clearfix"></div>
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								<h4>Amount : ${{(mypackage.price-coupon_amount) | number:2}}</h4>
							</div>
							
					    
					   
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								<h4>Aproval Code : {{authorization_code}}</h4>
							</div>
							
					   
					    
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
							<div class="col-md-10 col-sm-10">
								You will receive an email receipt for your purchase, however, you may want to print this page for your records.
							</div>
							
					   
					    
				</div>
				<div class="clearfix"></div>
				 <div class="col-md-10 col-sm-10">
						<div class=" col-md-6 col-sm-6 "></div>
						<button class="btn btn-warning col-md-2 col-sm-2 " type="button"  value="true" ng-click="GoHome()"  style="margin:20px;float:right;">Home</button>
						<div class="clearfix"></div>
				   </div>
		</div>
  </div>
</div><!--inner-content--> 

<?php
include("footer.php");
?>