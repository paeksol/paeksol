


var mainApp = angular.module('mainApp', ["ngResource"]);//angular.module('validationApp', []);
//var app = angular.module("MyApp", ["ngResource"]);

		
// create angular controller
mainApp.controller('mainController', function($scope,$http) {
	
	$scope.logined=false;
	$scope.username="";
	
	$scope.mailok=false;
	$scope.mailnook=false;
	
	$scope.successview=false;
	
	$scope.step1=true;
	$scope.step2=false;
	$scope.step3=false;
	$scope.step4=false;
	
	$scope.gender="Male";
	
	$scope.fname="";
	$scope.email="";
	
	$scope.coupon_amount=0;
	
	
	/**
	set default date of birth date.(curdate- 15 years and 6 months)
	*/
	var date=new Date();
	
	var minusmonth=15*12+6;
	var curyear=date.getYear()+1900;
	var curmonth=date.getMonth()+1;
	
	var sety=Math.floor(((curyear*12+curmonth)-minusmonth)/12);
	var setm=((curyear*12+curmonth)-minusmonth)%12;
	
	$scope.birthday=setm+"/"+date.getDate()+"/"+sety;
	//$scope.pissuedate=curmonth+"/"+date.getDate()+"/"+curyear;
	//$scope.pexpirationdate=curmonth+"/"+date.getDate()+"/"+curyear;
	$scope.expiration_mo=curmonth;
	$scope.expiration_yr=curyear;
	/**
	loading city list from backend.
	*/
	$scope.citylist=new Array();
	var res = $http.post('/api/api.php', {"action":"GetCityList"});
	res.success(function(data) {
		$scope.citylist=data['data'];
	});
	res.error(function(data) {
		
	});		
	
	/**
	loading school list from backend.
	*/
	$scope.schoollist=new Array();
	var res = $http.post('/api/api.php', {"action":"GetSchoolList"});
	res.success(function(data) {
		$scope.schoollist=data['data'];
	});
	res.error(function(data) {
		
	});		
	/**
	loading package list from backend.
	*/
	$scope.packagelist=new Array();
	var res = $http.post('/api/api.php', {"action":"GetPackageList"});
	res.success(function(data) {
		$scope.packagelist=data['data'];
	});
	res.error(function(data) {
		
	});
	
	/**
	loading coupon list from backend.
	*/
	$scope.couponlist=new Array();
	var res = $http.post('/api/api.php', {"action":"GetCouponList"});
	res.success(function(data) {
		$scope.couponlist=data['data'];
	});
	res.error(function(data) {
		
	});			
	
	
	$scope.selid=-1;
	
	// function to submit the form after all validation has occurred 
	
	$scope.submitFormwithAddress = function(arr){
		
		var dataObj = {
				"action" : "register",
				"userID" : $scope.selid,
				"fname" : $scope.fname,
				"email" : $scope.email,
				"password" : $scope.password,
				"phonenumber" : $scope.phonenumber,
				"address" : $scope.address,
				"city" : $scope.mycity.name,
				"zip" : $scope.zip,
				"gender" : $scope.gender,//
				"birthday" : $scope.birthday,
				"schoolname" : $scope.myschool.name,
				"permit" : $scope.permit,
				"pissuedate" : $scope.pissuedate,
				"pexpirationdate" : $scope.pexpirationdate,
				"latitude" : arr[0],
				"longitude" : arr[1],
				};
				
				//console.log(dataObj);
				
				var res = $http.post('/api/api.php', dataObj);
				
				res.success(function(data) {
					//console.log(data);
					if(data['status']=="OK")
					{
						$scope.mailok = false;
						$scope.mailnook = false;
					
						$scope.step1=false;
						$scope.step2=true;
						$scope.step3=false;
						
						$scope.selid=data["msg"];
						
						
					}else{
						//display the email check error.
						$scope.mailnook = true;
						$scope.mailok = false;
						
					}
					
				});
				res.error(function(data) {
					
				});
	};
	$scope.submitForm = function() {
		
		// check to make sure the form is completely valid
		if ($scope.userForm.$valid && $scope.mailok) {
			$scope.getLatitudeAndLongitude($scope.address+","+$scope.mycity.name,$scope.submitFormwithAddress);
		}
	};
	
	/**
	Get Latitude and Longitude from Address using google api.
	*/
	$scope.getLatitudeAndLongitude = function(addr,callbackfunc){
	    var retval=[];
		//console.log(addr);
		var res=$http.get('https://maps.googleapis.com/maps/api/geocode/json?address='+addr+'&apikey=AIzaSyCOJnYKgKKvDBgarFZTexDR2At8hHZ7Jog&sensor=false');
		res.success(function(result) {
				//Successfully.
				if(result['status']=='ZERO_RESULTS')
				{
					retval[0] = 0;
					retval[1] = 0;
				}else{
					retval[0] = result["results"][0].geometry.location.lat;
					retval[1] = result["results"][0].geometry.location.lng;
				}
				
				callbackfunc(retval);
			});
		res.error(function(result){
				//Fail.
				retval[0] = 0;
				retval[1] = 0;
				callbackfunc(retval);
		});
	}
	
	
	$scope.submitForm2withAddress = function (arr){
		
		var dataObj = {
				"action" : "register2",
				"selid" : $scope.selid,
				//first
				"fpname" : $scope.fpname,
				"fpemail" : $scope.fpemail,
				"fpphonenumber" : $scope.fpphonenumber,
				//second
				"spname" : $scope.spname,
				"spemail" : $scope.spemail,
				"spphonenumber" : $scope.spphonenumber,
				//alternate
				"apname" : $scope.apname,
				"apaddress" : $scope.apaddress,
				"alt_latitude" : arr[0],
				"alt_longitude" : arr[1],
				"apcity" : $scope.apcity==undefined?"":$scope.apcity.name,
			};
			var res = $http.post('/api/api.php', dataObj);
			
			res.success(function(data) {
				//console.log(data);
				if(data['status']=="OK")
				{
					
					//$scope.email="";
					$scope.step1=false;
					$scope.step2=false;
					$scope.step3=true;
					$scope.selid=data['msg'];
					
					
				}else{
					//display the email check error.
				}
				
			});
			res.error(function(data) {
				//console.log(data);
			});
	};
	$scope.submitForm2 = function() {
		if ($scope.userForm2.$valid && $scope.selid!=-1) {
				if($scope.apaddress==undefined || $scope.apaddress=="")
				{
					var arr=[];
					arr[0] = 0;
					arr[1] = 0;
					$scope.submitForm2withAddress(arr);
				}else{
				
					$scope.getLatitudeAndLongitude($scope.apaddress,$scope.submitForm2withAddress);
				}
		}
	};
	$scope.cardnumber="";//4111111111111111;
	$scope.couponvalid=false;
	$scope.couponinvalid=false;
	$scope.billingzip="";//"02412";
	$scope.authorization_error="";
	
	
	$scope.submitForm3 = function() {
		// check to make sure the form is completely valid
		//alert("step3 : "+$scope.selid);
		//alert($scope.userForm3.$valid);
		if ($scope.userForm3.$valid && $scope.selid!=-1) {
			//alert("here");
			//console.log($scope.mypackage);
			//return;
			var dataObj = {
				"action" : "CreateCustomerProfile",
				"selid" : $scope.selid,
				"email" : $scope.email,
				"fname" : $scope.fname,
				"packageName" : $scope.mypackage==undefined?"":$scope.mypackage.name,
				"packageID" : $scope.mypackage==undefined?"":$scope.mypackage.id,
				"packageDescription" : $scope.mypackage==undefined?"":$scope.mypackage.description,
				"couponcode" : $scope.coupon_id,
				//"addiscount" : $scope.addiscount,
				"expiration_mo" : $scope.expiration_mo,
				"expiration_yr" : $scope.expiration_yr,
				//"cardfname" : $scope.cardfname,
				//"cardlname" : $scope.cardlname,
				"description" : $scope.fname,
				"cardnumber" : $scope.cardnumber,
				"cvvcode" : $scope.cvvcode==undefined?"":$scope.cvvcode,
				"billingzip" : $scope.billingzip==undefined?"":$scope.billingzip,
				"amount" : $scope.mypackage.price-$scope.coupon_amount,
			};
			//console.log(dataObj);
			//alert("Request CreateTransactionID!");
			var res = $http.post('/api/api.php', dataObj);
			
			res.success(function(result) {
				//console.log(result);
				//alert("customerProfie status : "+result['status']);
				if(result['status']=="OK")
				{
					
					//$scope.email="";
					//console.log("transaction_id : "+result['data']['transaction_id']);
					//alert(result['customerProfileId']);
					dataObj = {
								"action" : "InsertCustomerProfileID",
								"userID" : $scope.selid,
								"transactionID" : result['data']['transaction_id'],
								"customerProfileID" : result['customerProfileId'],
								"password" : $scope.password,
								"name" : $scope.mypackage==undefined?"":$scope.mypackage.name,
								"packageID" : $scope.mypackage==undefined?"":$scope.mypackage.id,
								"amount" : $scope.mypackage.price-$scope.coupon_amount,
								"couponID" : $scope.coupon_id==undefined?"":$scope.coupon_id,
								"couponamount" : $scope.coupon_amount,
								"email" : $scope.email,
								//packageID,name,amount,couponID,couponamount
							};
					//console.log(dataObj);
					var res1 = $http.post('/api/api.php', dataObj);
					
					res1.success(function(_result){
						//console.log(_result);
						if(_result['status']=="failed")
						{
							
							//alert("error123");
							
						}else{
						    //alert("success");
							$scope.step1=false;
							$scope.step2=false;
							$scope.step3=false;
							$scope.step4=true;
						}
					
					});
					res1.error(function(_result){
						//console.log(_result);
					});
				
					$scope.transactionID = result['data']['transaction_id'];
					$scope.paymentmethod = "  Credit Card   "+result['data']['account_number'];
					$scope.authorization_code = result['data']['authorization_code'];
					
					//$scope.$apply();
					$scope.authorization_error="";
					
				}else{
					//display the email check error.
					//alert(result['msg'].code+"  :  "+result['msg'].text);
					$scope.authorization_error=result['msg'];
					
					
				}
				
			});
			res.error(function(result) {
				//console.log(result);
				console.log("CreateCustomerProfile Request Error.");
			});
			
			/*$scope.step1=false;
			$scope.step2=false;
			$scope.step3=false;
			$scope.step4=true;*/
			//location.href="index.php";
			
		}
	};
	$scope.emailchecking = function() {
		
		if($scope.userForm.email.$valid){
			var dataObj = {
				"email" : $scope.email,
				"action" : "checkemail"
			};
			var res = $http.post('/api/api.php', dataObj);
			
			res.success(function(data) {
				
				if(data['status']=="OK")
				{
					//display the email check image.
					$scope.mailok = true;
					$scope.mailnook = false;
					
				}else{
					//display the email check error.
					$scope.mailnook = true;
					$scope.mailok = false;
					
					
				}
				
			});
			res.error(function(data) {
				console.log(data);
				//$scope.mailflag=false;
			});		
		}else{
			//$scope.mailflag=false;
		}
	};
	/**
	Get Detail information of selected coupon.
	*/
	$scope.coupon_code="";
	$scope.getDetailOfCoupon = function(){
		//alert($scope.coupon_code);
		if($scope.coupon_code==undefined || $scope.coupon_code=="")return;
		if($scope.userForm3.coupon_code.$valid)
		{
			
			var dataObj = {
					"action" : "GetDetailOfCoupon",
					"couponcode" : $scope.coupon_code
				};
			var res = $http.post('/api/api.php', dataObj);
				
				res.success(function(result) {
					//alert("getDetailOfCoupon Success!");
					if(result['status']=="OK")
					{
						//console.log(result["data"]);
						//valid coupon.
						//alert(result["data"][0].id);
						
						$scope.coupon_id=result["data"][0].id;
						//alert($scope.coupon_id);
						$scope.coupon_code=result["data"][0].name;
						$scope.coupon_amount=result["data"][0].amount;
						$scope.coupon_minpurchase=result["data"][0].minpurchase;
						$scope.coupon_maxuses=result["data"][0].maxuses;
						$scope.coupon_expiration=result["data"][0].expiration;
						$scope.coupon_timesused=result["data"][0].timesused;
						$scope.couponvalid=true;
						$scope.couponinvalid=false;
						
					}else{
						
						//invalid coupon.
						$scope.coupon_code="";
						$scope.coupon_id="";
						$scope.coupon_amount="";
						$scope.coupon_minpurchase="";
						$scope.coupon_maxuses="";
						$scope.coupon_expiration="";
						$scope.coupon_timesused="";
						$scope.couponvalid=false;
						$scope.couponinvalid=true;
					}
					
					
					
					
				});
				res.error(function(result) {
					
				});
				
		}			
	};
	$scope.CouponReset = function(){
		$scope.coupon_id="";
		$scope.coupon_amount="";
		$scope.coupon_minpurchase="";
		$scope.coupon_maxuses="";
		$scope.coupon_expiration="";
		$scope.coupon_timesused="";
		$scope.couponvalid=false;
		$scope.couponinvalid=false;
		
	};
	$scope.phoneNumberPattern = (function() {
		var regexp = /^\(?(\d{3})\)?[ .-]?(\d{3})[ .-]?(\d{4})$/;
		return {
			test: function(value) {
				if( $scope.requireTel === false ) {
					return true;
				}
				return regexp.test(value);
			}
		};
	})();
	$scope.permitPattern = (function() {
		var regexp = /^\w{1}\d{7}$/;
		return {
			test: function(value) {
				if( $scope.requireTel === false ) {
					return true;
				}
				return regexp.test(value);
			}
		};
	})();
	$scope.zipcodePattern = (function() {
		var regexp = /^\d{5}$/;
		return {
			test: function(value) {
				if( $scope.requireTel === false ) {
					return true;
				}
				return regexp.test(value);
			}
		};
		
	})();
	
	$scope.relationlist = [{
		id: 1,
		name: 'Mother'
		}, {
		id: 2,
		name: 'Father'
		}, {
		id: 3,
		name: 'Guardian'
		}];
	$scope.gohomepage = function(){
		location.href="index.php";
	};
	
	
	
	/**
	========================Login=================================
	*/
	
	$scope.usertypelist = [{
		id: 1,
		name: 'Student'
		}, {
		id: 2,
		name: 'Parent'
		}];
	$scope.login_usertype=$scope.usertypelist[0];
	$scope.existloginerror = false;
	$scope.loginerror = "";
	$scope.LoginFormSubmit = function() {
		// check to make sure the form is completely valid
		if ($scope.loginForm.$valid) {
			var dataObj = {
					"action" : "Login",
					"email" : $scope.login_email,
					"password" : $scope.login_password,
					"type" : $scope.login_usertype.name,
					"rememberme" : $scope.login_rememberme,
			};
			
			//console.log(dataObj);
			
			var res = $http.post('/api/api.php', dataObj);
			res.success(function(result) {
					//console.log(result);
					if(result['status']=="OK")
					{
						$scope.existloginerror = false;
						$scope.loginerror = "";
						//set header.
						$scope.logined=true;
						$scope.username=result["data"]['lastname'];
						//console.log("====="+result["msg"]);
						location.href="/student_dashboard.php";
						$("#spinner").show();
					}else{
						$scope.existloginerror = true;
						$scope.loginerror = result['msg'];
					}
			});
			res.error(function(result) {
				$scope.existloginerror = true;
				$scope.loginerror = result['msg'];
			});
		}
	};
	$scope.Signout = function(){
		
		var dataObj = {
					"action" : "Signout",
		};
		var res = $http.post('/api/api.php',dataObj);
		res.success(function(result){
			$scope.logined=false;
			$scope.username="";
			location.href="/index.php";
		});
		res.error(function(result){
			
		});
		$("#spinner").show();
	};
	$scope.EditProfile = function(){
		$("#spinner").show();
		location.href="student_editprofile.php";
	};
	$scope.GoHome = function(){
		$("#spinner").show();
		location.href='student_dashboard.php';
	};
	
	
	$scope.init = function(param1,param2){
		//alert(param1);
		if(param1=="")
		{
			$scope.logined=false;
			
		}else{
			$scope.logined=true;
			//set init parameter 
			var dataObj={
					"action" : "GetUserInfo",
					"userID" : param2,
			};
			
			var res = $http.post('/api/api.php', dataObj);
			res.success(function(result) {
				//console.log(result);
				if(result['status']=="OK")
				{
					$scope.selid=result['data'][0].userID;
					$scope.fname=result['data'][0].lastname;	
					$scope.email=result['data'][0].email;
					$scope.address=result['data'][0].address;						
					$scope.phonenumber=result['data'][0].phone;	
					for($i=0;$i<$scope.citylist.length;$i++)
					{
						$item=$scope.citylist[$i];
						if($item.name==result['data'][0].city)
						{
							$scope.mycity=$item;
							break;
						}
					}
					for($i=0;$i<$scope.schoollist.length;$i++)
					{
						$item=$scope.schoollist[$i];
						if($item.name==result['data'][0].school)
						{
							$scope.myschool=$item;
							break;
						}
					}
					$scope.zip=result['data'][0].zip;		
					$scope.gender=result['data'][0].gender;
					
					
					//var str=result['data'][0].birthday;
					
					$scope.birthday=$scope.ToMyDate(result['data'][0].birthday);
					
					
					$scope.permit=result['data'][0].permit_num;
					$scope.pissuedate=$scope.ToMyDate(result['data'][0].permit_issuedate);
					$scope.pexpirationdate=$scope.ToMyDate(result['data'][0].permit_expiredate);
					
					$scope.fpname=result['data'][0].econtact1name;
					$scope.fpemail=result['data'][0].econtact1email;
					$scope.fpphonenumber=result['data'][0].econtact1phone;
					
					$scope.spname=result['data'][0].econtact2name;
					$scope.spemail=result['data'][0].econtact2email;
					$scope.spphonenumber=result['data'][0].econtact2phone;
					
					$scope.apname=result['data'][0].alt_pickup_name;
					$scope.apaddress=result['data'][0].alt_pickup_address;
					$scope.apcity=result['data'][0].alt_pickup_city;
					$scope.customerProfileID=result['data'][0].customerProfileID;
					$scope.mailok=true;
					
					/**
					loading payment method from backend for logined user.
					*/
					$scope.paymentmethod=new Array();
					var dataObj = {
									"action" : "getPaymentMethod",
									"customerProfileID" : $scope.customerProfileID,
						};
					//console.log(dataObj);
					
					var res = $http.post('/api/api.php', dataObj);
					res.success(function(result) {
						console.log(result["data"][0]["CustomerPaymentProfileId"]["0"]);
						var a=new Array();
						var i=0;
						for(i=0;i<result["data"].length;i++)
						{
							var obj=new Array();
							obj['id']=result["data"][i]["CustomerPaymentProfileId"]["0"];
							obj['name']="Credit Card  "+result["data"][i]["card"]["0"];
							a[i]=obj;
						}
						var obj=new Array();
						obj["id"]="-1";
						obj["name"]="New Payment Method.....";
						a[i]=obj;
						$scope.paymentmethod=a;
						//console.log($scope.paymentmethod);
					});
					res.error(function(result) {
						
					});
				}else{
					
				}
			});
			res.error(function(result) {});
		
			
			
		}
		$scope.username=param1;
		//$scope.$apply();
	};
	
	/**new payment process*/
	$scope.visiblenewpm = false;
	
	$scope.selectPaymentMethod = function(){
		if($scope.mypaymentmethod==undefined)return;
		if($scope.mypaymentmethod.id=="-1")
		{
			$scope.visiblenewpm = true;
		}else{
			$scope.visiblenewpm = false;
		}
		$scope.authorization_error="";
	};
	$scope.customerProfileID=-1;
	$scope.viewflag=true;
	$scope.PaymentProcessing = function() {
		
		if ($scope.userForm3.$valid && $scope.customerProfileID!=-1) {
			//alert("here");
			//console.log($scope.mypackage);
			//return;
			//alert("customerProfileID : "+$scope.customerProfileID+"   ,    customerPaymentProfileID : "+($scope.mypaymentmethod==undefined?"-1":$scope.mypaymentmethod.id));
			var dataObj = {
				"action" : "PaymentProcessing",
				"customerProfileID" : $scope.customerProfileID,
				"packageName" : $scope.mypackage==undefined?"":$scope.mypackage.name,
				"packageID" : $scope.mypackage==undefined?"":$scope.mypackage.id,
				"packageDescription" : $scope.mypackage==undefined?"":$scope.mypackage.description,
				"couponcode" : $scope.couponcode,
				"addiscount" : $scope.addiscount,
				"expiration_mo" : $scope.expiration_mo,
				"expiration_yr" : $scope.expiration_yr,
				"description" : $scope.fname,
				"cardnumber" : $scope.cardnumber,
				"cvvcode" : $scope.cvvcode==undefined?"":$scope.cvvcode,
				"billingzip" : $scope.billingzip==undefined?"":$scope.billingzip,
				"amount" : $scope.mypackage.price-$scope.coupon_amount,
				"paymentProfileID" : $scope.mypaymentmethod==undefined?"-1":$scope.mypaymentmethod.id,
			};
			
			//alert("Request CreateTransactionID!");
			var res = $http.post('/api/api.php', dataObj);
			
			res.success(function(result) {
				//console.log(result);
				//alert("customerProfie status : "+result['status']);
				if(result['status']=="OK")
				{
					
					//$scope.email="";
					
					//alert(result['customerProfileId']);
					dataObj = {
								"action" : "InsertCustomerProfileID",
								"transactionID" : result['data']['transaction_id'],
								"customerProfileID" : result['customerProfileId'],
								"name" : $scope.mypackage==undefined?"":$scope.mypackage.name,
								"packageID" : $scope.mypackage==undefined?"":$scope.mypackage.id,
								"amount" : $scope.mypackage.price-$scope.coupon_amount,
								"couponID" : $scope.coupon_id,
								"couponamount" : $scope.coupon_amount,
								//packageID,name,amount,couponID,couponamount
							};
					var res1 = $http.post('/api/api.php', dataObj);
					res1.success(function(_result){
						//console.log(_result);
						if(_result['status']=="failed")
						{
							
							//alert("error123");
							
						}else{
						   $scope.viewflag=false;
						}
					
					});
					res1.error(function(_result){
						//alert("Inserting Error  in Our database ");
					});
				
					$scope.transactionID = result['data']['transaction_id'];
					//$scope.paymentmethod = "  Credit Card   "+result['data']['account_number'];
					$scope.authorization_code = result['data']['authorization_code'];
					
					//$scope.$apply();
					//$scope.authorization_error="Successfully! New Transaction ID : "+$scope.transactionID;
					
				}else{
					//display the email check error.
					//alert(result['msg'].code+"  :  "+result['msg'].text);
					
						$scope.authorization_error=result['msg'];
					
					
				}
				
			});
			res.error(function(result) {
				
				alert("CreateCustomerProfile Request Error.");
			});
			
			
			
		}
	};	
	
	$scope.Newpaymentmethod = function(){
		$("#spinner").show();
		location.href="https://newhtml.drivingware.com/studentpaymentprocessing.php";
	};
	
	//forgot password.
	$scope.flag="0";
	$scope.subtitle="Sign in With your account.";
	
	$scope.ForgotPassword_click = function() {
		//GetVerifyKeyForNewPassword
		//alert($scope.login_email);
		if ($scope.loginForm.login_email.$valid) {
			var dataObj = {
						"action" : "GetVerifyKeyForNewPassword",
						"email" : $scope.login_email,
			};
			var res = $http.post('/api/api.php',dataObj);
			res.success(function(result){
				if(result['status']=="OK")
				{
					$scope.flag="1";
					$scope.subtitle="Verification For Password Recovery.";
				}else{
					console.log("Get Verification Key Error");
					console.log(result['msg']);
				}
			});
			res.error(function(result){
				console.log("Get Verification Key Request Error");
			});
		}
	};
	$scope.verifyFormSubmit = function() {
		//Verify_P
		
		if($scope.verifyForm.$valid){
			var dataObj = {
						"action" : "Verify_P",
						"email" : $scope.login_email,
						"verifykey" : $scope.verifykey
			};
			var res = $http.post('/api/api.php',dataObj);
			res.success(function(result){
				console.log(result);
				if(result['status']=="OK")
				{
					$scope.flag="2";
					$scope.subtitle="New Password!";
					$scope.error="";
				}else{
					//console.log("Verify Error");
					$scope.error="Invalid Key ! Please Copy again.";
				}
			});
			res.error(function(result){
				console.log("Verify Request Error");
			});
		}
	};
	$scope.newpasswordFormSubmit = function() {
		//NewPasswordRegister
		if($scope.newpasswordForm.$valid){
			var dataObj = {
						"action" : "NewPasswordRegister",
						"email" : $scope.login_email,
						"password" : $scope.newpassword
			};
			var res = $http.post('/api/api.php',dataObj);
			res.success(function(result){
				//console.log(result);
				if(result['status']=="OK")
				{
					$scope.flag="0";
					$scope.subtitle="Sign in With your account.";
				}else{
					console.log("New Password Error");
				}
			});
			res.error(function(result){
				console.log("New Password Request Error");
			});
		}
	};
	
	
	$scope.ToMyDate = function(str){
		if(str!="" && str.indexOf("0000")==-1)
		{
			return str.split("-")[1]+"/"+str.split("-")[2]+"/"+str.split("-")[0];
		}
		return "";
	};
	$scope.UpdateUserInfo = function() {
		//alert($scope.mailok);
		// check to make sure the form is completely valid
		if ($scope.userForm.$valid && $scope.mailok) {
			$scope.getLatitudeAndLongitude($scope.address+","+$scope.mycity.name,$scope.submitFormwithAddress);
			//alert("here");
			location.href="student_editprofile.php";
		}
	};
	
	/**
	social login. ==== start.
	*/
	var social_load = function(){
		if (typeof(window.socialid) !== "object") window.socialid = {};
		 socialid.onLoad = function() {
		   showLoginWidget();
		   //customLoginButtons();
		   eventHandlers();
		 };
		 var e = document.createElement('script');
		 e.type = 'text/javascript';
		 e.id = 'socialid_api_script';
		 if (document.location.protocol === 'https:') {
		   e.src = 'https://app.socialidnow.com/assets/api/socialid.js';
		 } else {
		   e.src = 'http://app.socialidnow.com/assets/api/socialid.js';
		 }
		 var s = document.getElementsByTagName('script')[0];
		 s.parentNode.insertBefore(e, s);
	};
	social_load();
	var showLoginWidget = function() {
     socialid.login.init(36, {loginType: "event"});
     socialid.login.renderLoginWidget("socialid_login_container", {
       theme: "bricks", 
       providers: ["facebook", "gplus", "twitter", "linkedin"],
       language: "pt_br",
       showSocialIdLink: true,
       loadCss: true
     });
   }
   
   $scope.sociallogin = function(social_type)
   {
		switch(social_type){
			case 0:
				//facebook.
				socialid.login.startLogin("facebook");
				break;
			case 1:
				//gplus.
				socialid.login.startLogin("gplus");
				break;
			case 2:
				//twitter.
				socialid.login.startLogin("twitter");
				break;
			case 3:break;
		};
   };
    // add event handlers
   var eventHandlers = function() {
	
     socialid.events.onLoginSuccess.addHandler(function(data) {
		 //console.log("Website received onLoginSuccess: ", data);
		 socialid.login.getUserInfo(function(data){
			//console.log(data);
			//alert(data['data']);
			$scope.fname = data['data']['name'];
			$scope.email = data['data']['email'];
			$scope.$apply();
		 }); 
     });
     socialid.events.onLoginCancel.addHandler(function(data) {
       //console.log("Website received onLoginCancel: ", data);
     });
     socialid.events.onLoginError.addHandler(function(data) {
       //console.log("Website received onLoginError: ", data);
     });
     socialid.events.onLoginStart.addHandler(function(data) {
       //console.log("Website received onLoginStart: ", data);
     });
   }
	/**
	social login. ==== end.
	*/
	
	
	
	
});

mainApp.config(function ($httpProvider) {
		  $httpProvider.responseInterceptors.push('myHttpInterceptor');

		  var spinnerFunction = function spinnerFunction(data, headersGetter) {
			
			$("#spinner").show();
			return data;
		  };

		  $httpProvider.defaults.transformRequest.push(spinnerFunction);
		});

		mainApp.factory('myHttpInterceptor', function ($q, $window) {
		  return function (promise) {
			return promise.then(function (response) {
			
			  $("#spinner").hide();
			  return response;
			}, function (response) {
			
			  $("#spinner").hide();
			  return $q.reject(response);
			});
		  };
		});


$(function(){
		
		 $('#birthday').datepicker({
                    format: "mm/dd/yyyy"
            });  
		$('#pissuedate').datepicker({
                    format: "mm/dd/yyyy"
            });  
		$('#pexpirationdate').datepicker({
                    format: "mm/dd/yyyy"
            }); 
		
 });


   //<![CDATA[
   // load the Social-ID Javascript API
  /* (function(){
     if (typeof(window.socialid) !== "object") window.socialid = {};
     socialid.onLoad = function() {
       showLoginWidget();
       customLoginButtons();
       eventHandlers();
     };
     var e = document.createElement('script');
     e.type = 'text/javascript';
     e.id = 'socialid_api_script';
     if (document.location.protocol === 'https:') {
       e.src = 'https://app.socialidnow.com/assets/api/socialid.js';
     } else {
       e.src = 'http://app.socialidnow.com/assets/api/socialid.js';
     }
     var s = document.getElementsByTagName('script')[0];
     s.parentNode.insertBefore(e, s);
   })();
   // render the login widget
   function showLoginWidget() {
     socialid.login.init(36, {loginType: "event"});
     socialid.login.renderLoginWidget("socialid_login_container", {
       theme: "bricks", 
       providers: ["facebook", "gplus", "twitter", "linkedin"],
       language: "pt_br",
       showSocialIdLink: true,
       loadCss: true
     });
   }
    // start login for custom buttons
   function customLoginButtons() {
     // start login process when user clicks on facebook button
     facebook_button = document.getElementById("facebook_login");
     facebook_button.onclick = function() {
       socialid.login.startLogin("facebook");
     };
     // start login process when user clicks on twitter and linkedin button
     socialid.login.startLoginClick("twitter_login", "twitter");
     socialid.login.startLoginClick("linkedin_login", "linkedin");
     socialid.login.startLoginClick("gplus_login", "gplus");
   }
    // add event handlers
   function eventHandlers() {
	
     socialid.events.onLoginSuccess.addHandler(function(data) {
		
		//console.log(socialid.login.getUserInfo());
		
       console.log("Website received onLoginSuccess: ", data);
       socialid.login.getUserInfo(function(data){
			console.log(data);
	   }); 
	 
	   
	   
     });
     socialid.events.onLoginCancel.addHandler(function(data) {
       console.log("Website received onLoginCancel: ", data);
     });
     socialid.events.onLoginError.addHandler(function(data) {
       console.log("Website received onLoginError: ", data);
     });
     socialid.events.onLoginStart.addHandler(function(data) {
       console.log("Website received onLoginStart: ", data);
     });
   }
    //]]>*/
