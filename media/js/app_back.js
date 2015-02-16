


var validationApp = angular.module('validationApp', ["ngResource"]);//angular.module('validationApp', []);
//var app = angular.module("MyApp", ["ngResource"]);

		
// create angular controller
validationApp.controller('mainController', function($scope,$http) {
	
	$scope.mailok=false;
	$scope.mailnook=false;
	$scope.successview=false;
	
	$scope.step1=true;
	$scope.step2=false;
	$scope.step3=false;
	
	$scope.gender="Male";
	
	$scope.fname="";
	$scope.email="";
	
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
	
	$scope.selid=-1;
	
	// function to submit the form after all validation has occurred 
	
	$scope.submitFormwithAddress = function(arr){
		
		var dataObj = {
				"action" : "register",
				
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
				var res = $http.post('/api/api.php', dataObj);
				
				res.success(function(data) {
					
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
			$scope.getLatitudeAndLongitude($scope.address,$scope.submitFormwithAddress);
		}
	};
	
	/**
	Get Latitude and Longitude from Address using google api.
	*/
	$scope.getLatitudeAndLongitude = function(addr,callbackfunc){
	    var retval=[];
		var res=$http.get('https://maps.googleapis.com/maps/api/geocode/json?address='+addr+'&apikey=AIzaSyCOJnYKgKKvDBgarFZTexDR2At8hHZ7Jog&sensor=false');
		res.success(function(result) {
				//Successfully.
				retval[0] = result["results"][0].geometry.location.lat;
				retval[1] = result["results"][0].geometry.location.lng;
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
				if($scope.apaddress=="")
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
	$scope.submitForm3 = function() {
		// check to make sure the form is completely valid
		
		if ($scope.userForm3.$valid && $scope.selid!=-1) {
			
			var dataObj = {
				"action" : "register2",
				"selid" : $scope.selid,
				
				"package" : $scope.mypackage,
				"couponcode" : $scope.couponcode,
				"addiscount" : $scope.addiscount,
				
				"discountnote" : $scope.discountnote,
				"mypaymentmethod" : $scope.mypaymentmethod,
				"experiation_mo" : $scope.experiation_mo,
				"experiation_hr" : $scope.experiation_hr,
				
				"cardnumber" : $scope.cardnumber,
				"cvvcode" : $scope.cvvcode,
				"billingzip" : $scope.billingzip,
			};
			/*var res = $http.post('/api/api.php', dataObj);
			
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
				$scope.mailflag=false;
			});
			*/
			location.href="index.php";
			
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
				
				//$scope.mailflag=false;
			});		
		}else{
			//$scope.mailflag=false;
		}
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
	
	/**
	google social login === start.
	*/
	$scope.start = function(){
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/client.js?onload=onGoogleLoadCallback';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    };
	
		
	$scope.start();
	
	$scope.googlelogin=function(){
		var myParams = {
			'clientid' : '1029450377686-rt3km11iej79uqs9n4ojam5oir9e5q69.apps.googleusercontent.com',
			'cookiepolicy' : 'single_host_origin',
			'callback' : $scope.googleloginCallback,
			'approvalprompt':'force',
			'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
		  };
		  gapi.auth.signIn(myParams);
	};
	$scope.googleloginCallback = function(result)
	{
		if(result['status']['signed_in'])
		{
			var request = gapi.client.plus.people.get(
			{
				'userId': 'me'
			});
			request.execute(function (resp)
			{
				var email = '';
				if(resp['emails'])
				{
					for(i = 0; i < resp['emails'].length; i++)
					{
						if(resp['emails'][i]['type'] == 'account')
						{
							email = resp['emails'][i]['value'];
						}
					}
				}
				
				$scope.fname = resp['displayName'];
				$scope.email = email;
				/*
				Image : resp['image']['url']
				URL :   resp['url']
				*/
				
				$scope.$apply();
				
			});
	 
		}
		
	 
	};
	/**
	google social login === end.
	*/
	
	/**
	facebook social login == start.
	*/
	$scope.facebooklogin = function() {
	  FB.login(function (response) {
		if (response.authResponse) {
		  FB.api('/me', function (response) {
			//console.log(response);
			alert(response.name+"-"+response.username);
			//document.getElementById("userID").innerHTML = response.id;
			//$("#email").val(response.email);
			$scope.fname = response.name;
			$scope.email = response.email;
			$scope.$apply();
			
			
			});
		} else {
		  //alert("Login attempt failed!");
		}
	  }, { scope: 'email,user_photos,publish_actions' });
	}

	
});

validationApp.config(function ($httpProvider) {
		  $httpProvider.responseInterceptors.push('myHttpInterceptor');

		  var spinnerFunction = function spinnerFunction(data, headersGetter) {
			
			$("#spinner").show();
			return data;
		  };

		  $httpProvider.defaults.transformRequest.push(spinnerFunction);
		});

		validationApp.factory('myHttpInterceptor', function ($q, $window) {
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

/**
	facebook social login.
	*/
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
	
window.fbAsyncInit = function () {
		  FB.init({
			//appId: '801600066531232',
			//appId: '1431748493782491',
			appId: '318040328392045',
			status: true,
			cookie: true,
			xfbml: true
		  });
		};

		(function (doc) {
		  var js;
		  var id = 'facebook-jssdk';
		  var ref = doc.getElementsByTagName('script')[0];
		  if (doc.getElementById(id)) {
			return;
		  }
		  js = doc.createElement('script');
		  js.id = id;
		  js.async = true;
		  js.src = "//connect.facebook.net/en_US/all.js";
		  ref.parentNode.insertBefore(js, ref);
		}(document));	
/*		
	function Login() {
	  FB.login(function (response) {
		if (response.authResponse) {
		  FB.api('/me', function (response) {
			console.log(response);
			$("#fname").val(response.name+"-"+response.username);
			//document.getElementById("userID").innerHTML = response.id;
			$("#email").val(response.email);
			});
		} else {
		  alert("Login attempt failed!");
		}
	  }, { scope: 'email,user_photos,publish_actions' });
	}
*/
/**
client.js callback function for google login.
*/	
var onGoogleLoadCallback = function(){
	gapi.client.setApiKey('AIzaSyB5rF-39WyuJmT4d6A5g-fdYh-43-JcJbI');
	gapi.client.load('plus', 'v1',function(){
		
	});
};

/**
twitter login
*/

   //<![CDATA[
   // load the Social-ID Javascript API
   (function(){
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
    //]]>
