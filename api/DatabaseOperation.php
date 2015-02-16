<?php

class PDOConfig extends PDO {

    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
	
    public function __construct() {
        
		$this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'customdbase2';
        $this->user = 'dw40';
        $this->pass = 'dw40pass!';
		//$this->user = 'root';
        //$this->pass = '';
  
        $dns = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host;
        parent::__construct($dns, $this->user, $this->pass);
    }

}

class DBOperations {

    private $dbh;

    public function __construct() {
        $this->dbh = new PDOConfig();
    }
	
	/**
	The function which login.
	*/
    public function Login($obj) {
        try {
			
			//extract parameter from request object.
			$email = isset($obj['email'])?$obj['email']:"";
			$password = isset($obj['password'])?$obj['password']:"";
			$type = isset($obj['type'])?$obj['type']:"";
			
			//prepare sql get user info.
			$stmt = $this->dbh->prepare("select userID, email, password, firstname, lastname, emailValidated, customerProfileID from userinfo where email=:email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
			
			$status = "failed";
            
            if ($stmt->execute()) {
                $no = $stmt->rowCount();
								
                if ($no <> 1) {
                    $msg = "Email Address does not exist please try again ... ";
					$status = "failed";
					return array("status"=>$status,"msg"=>$msg);
                } else {
                    $row = $stmt->fetch(PDO::FETCH_OBJ);
                    if ($row->password == md5($password)) {
						if($row->emailValidated=="Y"){
						
                         	$_SESSION['id']=session_id();
                            $_SESSION['userid']=$row->userID;
							$_SESSION['username']=$row->firstname.' '.$row->lastname;
							$_SESSION['customerProfileID']=$row->customerProfileID;
							$msg = " welcome ".$_SESSION['username']."loging successfully , please wait ... ";
							$status = "OK";
							$data = $row;
							return array("status"=>$status,"msg"=>$msg,"data"=>$data);
						}else{
							//please verify the email.
							
							$msg="Please Verify the your email";
							return array("status"=>$status,"msg"=>$msg);
						}
                    }else{
						//password error.
						 $msg = "Password is incorrect. please try again ... ";
						 
						 return array("status"=>$status,"msg"=>$msg);
					}
                }
            }
			return array("status" => $status, "msg" => "Please try it again later.");
        } catch (Exception $e) {
            return array("status" => "failed", "msg" => "Please try it again later. ". $e->getMessage());
        }
        
    }
	public function GetVerifyKeyForNewPassword($obj)
	{
		$email=$obj['email'];
		try{
			$stmt = $this->dbh->prepare("select * from userinfo where email=:email and emailValidated='Y'");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
			if ($stmt->execute()) {
                $no = $stmt->rowCount();
				if ($no <> 1) {
                    $msg = "Email Address does not exist Or not verified.  please try again ... ";
					$status = "failed";
					return array("status"=>$status,"msg"=>$msg);
                } else {
                    //$row = $stmt->fetch(PDO::FETCH_OBJ);
					$verificationkey=md5(rand(0,1));
					$stmt1 = $this->dbh->prepare("update userinfo set emailValidated='N', verifykey=:verifykey where email=:email");
					$stmt1->bindParam(":verifykey", $verificationkey, PDO::PARAM_STR);
					$stmt1->bindParam(":email", $email, PDO::PARAM_STR);
					$stmt1->execute();
					
					//send verification key to email address.
					$em=" info@safetyfirstds.com";
					$headers4=$em;
					$headers="";
					$headers.="Reply-to: $headers4\n";
					$headers .= "From: $headers4\n"; 
					$headers .= "Errors-to: $headers4\n"; 
					$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
					
					$content="<h1>Your Verification Key Information!</h1>\n\n";
					$content .="<hr/>";
					
					$content .=" Verification Key : $verificationkey <br/><br/>\n";
					$content .=" Thanks!<br/> ";
					$content .=" Safety First Driving School <br/>\n\n";
					
					$sub="Forgot Password....";
					
					$re=mail($email,"$sub",$content,$headers);
					
					if($re == true){
						return array("status" => "OK");
					}else{
						return array("status" => "failed", "msg" => "Please try again later.");
					}
					
				}
			}
		}catch(Exception $e)
		{
			 return array("status" => "failed", "msg" => "Please try it again later. ". $e->getMessage());
		}
	}
	/**
	The function whether this email address already is exist or not.
	*/
	public function CheckEmail($obj)
	{
		$status="OK";
		$msg="";
		$email=$obj['email'];
		
		if(isset($email))
		{
			//return array("status" => "OK", "msg" => $email);
			$count=$this->dbh->prepare("select email from userinfo where email=:email");
            $count->bindParam(":email",$email);
            $count->execute();
            $no=$count->rowCount();
            if($no > 0 ){
                $msg = "Already This email address is exist.\n Or Please try another one";
                $status= "failed";
            }else{
				$msg = "Successfully Check!";
                $status= "OK";
			}
		} else {
			$msg="Please Enter Your Email address!";
			$status= "failed";
		}
		return array("status" => $status, "msg" => $msg);
	}
	/**
	The function which register the member information of new user.
	*/
    public function Register($obj) {
        
		$status = "OK";
        $msg="";
		
				$userID = $obj["userID"];
				
				$fname = $obj["fname"];
				$email = $obj["email"];
				$verifykey = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
				// Example output: f4552671f8909587cf485ea990207f3b
				$password = isset($obj["password"])?$obj['password']:"";
				$phonenumber = $obj["phonenumber"];
				$address = $obj["address"];
				$city = $obj["city"];
				$zip = $obj["zip"];
				$gender=$obj["gender"];
				$latitude=$obj["latitude"];
				$longitude=$obj["longitude"];
				//return array("status" => "OK", "msg" => $obj["birthday"]);
				
				$birthday=$this->convertdateformat($obj["birthday"]);
				$schoolname = $obj["schoolname"];
				$permit = isset($obj["permit"])?$obj["permit"]:"";
				$pissuedate = $this->convertdateformat(isset($obj["pissuedate"])?$obj["pissuedate"]:"");//$obj["pissuedate"];//
				$pexpirationdate = $this->convertdateformat(isset($obj["pexpirationdate"])?$obj["pexpirationdate"]:"");//$obj["pexpirationdate"];//
				
				
		
		
		
        $password_original = $password;
		$password=md5($password); // Encrypt the password before storing
		
		if($userID=="-1")
		{
			//insert.
			$stmt=$this->dbh->prepare("insert into userinfo(user,email,password,lastname,address,birthday,city,zip,school,phone,permit_num,permit_issuedate,
			permit_expiredate,gender,latitude,longitude,verifykey) 
			values(:user,:email,:password,:lastname,:address, :birthday,:city,:zip,:school,:phone,:permit,:pissuedate,:pexpirationdate,
			:gender,:latitude, :longitude, :verifykey)");
		}else{
			//update.
			$stmt=$this->dbh->prepare("update userinfo set user=:user,email=:email,lastname=:lastname,address=:address,birthday=:birthday,city=:city,zip=:zip,
			school=:school,phone=:phone,permit_num=:permit,permit_issuedate=:pissuedate,permit_expiredate=:pexpirationdate,
			gender=:gender,latitude=:latitude,longitude=:longitude where userID=:userID ");
		}
		
		
		//return array("status" => "failed", "msg" => $userID);
		
		$stmt->bindParam(':user',$email,PDO::PARAM_STR, 75);
		$stmt->bindParam(':email',$email,PDO::PARAM_STR, 75);
		if($userID=="-1")
		{ 
			$stmt->bindParam(':password',$password,PDO::PARAM_STR, 32);
		}
		$stmt->bindParam(':lastname',$fname,PDO::PARAM_STR, 75);
		$stmt->bindParam(':address',$address,PDO::PARAM_STR);
		$stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
		$stmt->bindParam(':city',$city,PDO::PARAM_STR);
		$stmt->bindParam(':zip',$zip,PDO::PARAM_STR);
		$stmt->bindParam(':school',$schoolname,PDO::PARAM_STR);
		$stmt->bindParam(':phone',$phonenumber,PDO::PARAM_STR);
		$stmt->bindParam(':permit',$permit,PDO::PARAM_STR);
		$stmt->bindParam(':pissuedate',$pissuedate,PDO::PARAM_STR);
		$stmt->bindParam(':pexpirationdate',$pexpirationdate,PDO::PARAM_STR);
		$stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
		$stmt->bindParam(':latitude',$latitude,PDO::PARAM_STR);
		$stmt->bindParam(':longitude',$longitude,PDO::PARAM_STR);
		if($userID=="-1")
		{
			$stmt->bindParam(':verifykey',$verifykey,PDO::PARAM_STR);
		}else{
			$stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
		}
		
		if($stmt->execute()){
			
			$userid=$this->dbh->lastInsertId();
			return array("status" => "OK", "msg" => $userid);
			
		} else {
			$msg=$stmt->errorInfo(); 
			return array("status" => "failed", "msg" => $msg);
		}
    }
	public function Register2($obj) {
        
		$status = "OK";
        $msg="";
		
       		
				$fpname = $obj["fpname"];
				$fpemail = $obj["fpemail"];
				$fpphonenumber = $obj["fpphonenumber"];
				
				$spname = isset($obj["spname"])?$obj["spname"]:"";
				$spemail = isset($obj["spemail"])?$obj["spemail"]:"";
				$spphonenumber = isset($obj["spphonenumber"])?$obj["spphonenumber"]:"";
				
				$apname = isset($obj["apname"])?$obj["apname"]:"";
				$apaddress = isset($obj["apaddress"])?$obj["apaddress"]:"";
				$apcity = isset($obj["apcity"])?$obj["apcity"]:"";
				$alt_latitude=$obj["alt_latitude"];
				$alt_longitude=$obj["alt_longitude"];
				
				$selid = $obj["selid"];
				
        
		$stmt=$this->dbh->prepare("update userinfo set econtact1name=:fpname, econtact1email=:fpemail, econtact1phone=:fpphonenumber,econtact2name=:spname,
									econtact2email=:spemail,econtact2phone=:spphonenumber,
									alt_pickup_name=:apname,alt_pickup_address=:apaddress,alt_pickup_city=:apcity, alt_latitude=:alt_latitude, alt_longitude=:alt_longitude where userID=:selid");
		
		
		$stmt->bindParam(':fpname',$fpname,PDO::PARAM_STR, 75);
		$stmt->bindParam(':fpemail',$fpemail,PDO::PARAM_STR, 32);
		$stmt->bindParam(':fpphonenumber',$fpphonenumber,PDO::PARAM_STR, 75);
		
		$stmt->bindParam(':spname',$spname,PDO::PARAM_STR, 75);
		$stmt->bindParam(':spemail',$spemail,PDO::PARAM_STR, 32);
		$stmt->bindParam(':spphonenumber',$spphonenumber,PDO::PARAM_STR, 75);
		
		$stmt->bindParam(':apaddress',$apaddress,PDO::PARAM_STR);
		$stmt->bindParam(':apcity',$apcity,PDO::PARAM_STR);
		$stmt->bindParam(':apname',$apname,PDO::PARAM_STR);
		$stmt->bindParam(':alt_latitude',$alt_latitude,PDO::PARAM_STR);
		$stmt->bindParam(':alt_longitude',$alt_longitude,PDO::PARAM_STR);
		$stmt->bindParam(':selid',$selid,PDO::PARAM_STR);
		
		if($stmt->execute()){
			
			//send email for registration/email verification.
			
			$em=" info@safetyfirstds.com";    // Change to your email address 
					//$em="hjr20131224@gmail.com";
					$headers4=$em;
					$headers="";
					$headers.="Reply-to: $headers4\n";
					$headers .= "From: $headers4\n"; 
					$headers .= "Errors-to: $headers4\n"; 
					$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
					
					
					//get user info in userinfo table.
					
					$sql="select email,verifykey,userID from userinfo where userID=".$selid;
					
					
					$userinfo=$this->GetList($sql);
					
					
					$content="<h1>Thank you for registering with Safety First Driving School</h1>\n\n";
					$content .="Info@safetyfirstds.com <br/>\n";
					$content .="Sent: ". date("D M j G:i:s T Y")."<br/>\n";
					$content .=" To ".$userinfo['data'][0]['email']." <br/>\n";
					$content .=" Your registration with Safety First Driving School requires you to verify your email <br/>\n
					address. Please click the Verify Email button to verify you are able to receive email from Safety <br/>\n
					First Driving School.  We will use this email to send appointment notifications in the future so it <br/>\n
					is important that you add us to your contacts so we don't end up in your spam folder. <br/>\n ";
					$link="http://newhtml.drivingware.com/api/api.php?email=".$userinfo['data'][0]['email']."&verifykey=".$userinfo['data'][0]['verifykey'];
					$content .="<a href='$link'>$link</a>\n\n";
					
					$content .="<hr/>";
					
					$content .=" Thanks!<br/> ";
					$content .=" Safety First Driving School <br/>\n\n";
					
					
					$sub="Please Verification your email!";
					
					
					
					
					$re=mail($userinfo['data'][0]['email'],"$sub",$content,$headers);
					
					if($re == true){
						return array("status" => "OK", "msg" => $selid);
					}else{
						return array("status" => "failed", "msg" => "");
					}
			
			
			
			
		} else {
			$msg=$stmt->errorInfo(); 
			return array("status" => "failed", "msg" => $msg);
		}
    }
	public function InsertCustomerProfileID($obj)
	{
		$status = "OK";
        $msg="";
		try{
			
			if(isset($obj["userID"]))
			{
				$userID=$obj['userID'];
				$_SESSION['userid']=$userID;
			}else {
				$userID = isset($_SESSION['userid'])?$_SESSION['userid']:"-1";
			}
			
			$sql="select email,userID from userinfo where userID=".$userID;
			$userinfo=$this->GetList($sql);
			$email = $userinfo['data'][0]['email'];
			
			
			$transactionID = $obj["transactionID"];
			$customerProfileID = $obj["customerProfileID"];
			
			
			$stmt=$this->dbh->prepare("update userinfo set customerProfileID=:customerProfileID where userID=:userID");
			$stmt->bindParam(':customerProfileID',$customerProfileID,PDO::PARAM_STR);
			$stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
			
			if($stmt->execute()){
				
				//$stmt2=$this->dbh->prepare("delete from transactions");
				//$stmt2->execute();
				
				$stmt1=$this->dbh->prepare("insert into transactions(anet_transid,userID,packageID,name,amount,couponID,couponamount,location,date_charged) values(:transactionID,:userID,:packageID,:name,:amount,:couponID,:couponamount,'Online',curdate())");
				$stmt1->bindParam(':transactionID',$transactionID,PDO::PARAM_STR);
				$stmt1->bindParam(':userID',$userID,PDO::PARAM_STR);
				$stmt1->bindParam(':packageID',$obj['packageID'],PDO::PARAM_STR);
				$stmt1->bindParam(':name',$obj['name'],PDO::PARAM_STR);
				$stmt1->bindParam(':amount',$obj['amount'],PDO::PARAM_STR);
				$stmt1->bindParam(':couponID',$obj['couponID'],PDO::PARAM_STR);
				$stmt1->bindParam(':couponamount',$obj['couponamount'],PDO::PARAM_STR);
				if($stmt1->execute()){
					
					//send email.
					$em=" info@safetyfirstds.com";    // Change to your email address 
					$headers4=$em;
					$headers="";
					$headers.="Reply-to: $headers4\n";
					$headers .= "From: $headers4\n"; 
					$headers .= "Errors-to: $headers4\n"; 
					$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
					
					$content="<h1>Your Transaction Information!</h1>\n\n";
					
					$content .="<hr/>";
					
					
					$content .=" Customer Profile ID : $customerProfileID <br/>\n";
					$content .=" Transaction ID : $transactionID <br/><br/>\n";
					$content .=" Thanks!<br/> ";
					$content .=" Safety First Driving School <br/>\n\n";
					
					$sub="Transaction Information";
					
					
					
					
					$re=mail($email,"$sub",$content,$headers);
					
					if($re == true){
						return array("status" => "OK", "msg" => $userID);
					}else{
						return array("status" => "failed", "msg" => "mail sending error!");
					}
					
					
				} else {
					$msg=$stmt1->errorInfo(); 
					return array("status" => "failed", "msg" => $msg);
				}	
			} else {
				//$msg=$stmt->errorInfo(); 
				return array("status" => "failed", "msg" => "2");
			}
			
			
		}catch (Exception $e) {
            return array("result" => "failed", "msg" => "3");
        }
	}
	public function Verify($obj,$i)
	{
		$sql="update userinfo set emailValidated='Y' where email='".$obj['email']."' and verifykey='".$obj['verifykey']."' and emailValidated='N'";
		$stmt=$this->dbh->prepare($sql);
		if($stmt->execute()){
			if($i==0){
				header("Location:http://newhtml.drivingware.com/");
			}else if($i==1){
				 $no=$stmt->rowCount();
				if($no > 0 ){
					return array("status" => "OK");
				}else{
					return array("status" => "failed","msg"=>"Invaid Verification Key");
				}
			}
		}
	}
	public function NewPasswordRegister($obj)
	{
		$sql="update userinfo set password=:password where email='".$obj['email']."'";
		$stmt=$this->dbh->prepare($sql);
		$password=md5($obj['password']);
		$stmt->bindParam(':password',$password,PDO::PARAM_STR);
		if($stmt->execute()){
				return array("status" => "OK");
		}else{
			return array("status" => "failed");
		}
	}
	public function GetUserInfo($obj)
	{
		$sql = "select * from userinfo where userID = ".$obj['userID'];
		return $this->GetList($sql);
	}
	public function GetCityList()
	{
		 $sql = "select listID as id, itemname as name from lists where listname ='cities' order by itemname ";
		 return $this->GetList($sql);
		
	}
	public function GetSchoolList()
	{
		 $sql = "select listID as id, itemname as name from lists where listname ='schools' order by itemname ";
		 return $this->GetList($sql);
		
	}
	public function GetPackageList()
	{
		 $sql = "select packageID as id, title as name, if(price is null,0, price) as price, description,driversed, wheelhours from packages where active='Y' and displayonweb='Y'";
		 return $this->GetList($sql);
	}
	public function GetCouponList()
	{
		 $sql = "select couponID as id, code as name,amount,minpurchase,maxuses,expiration,timesused from coupons";
		 return $this->GetList($sql);
		
	
	}
	public function GetDetailOfCoupon($obj)
	{
		$sql = "select couponID as id, code as name,amount,minpurchase,maxuses,expiration,timesused from coupons where code='".$obj["couponcode"]."'";
		return $this->GetList($sql);
	}
	public function GetList($sql)
	{
		try {
            $msg = "";
            $status = 'OK';
            $data ="null";
            
			$stmt = $this->dbh->prepare($sql);
            $status = "failed";
            if ($stmt->execute()) {
                $no = $stmt->rowCount();
                if ($no > 0) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$status="OK";
                } 
            }
            return array("status" => $status, "data" =>$data);
        } catch (Exception $e) {
            return array("status" => "failed", "msg" => 'Error message :: ' . $e->getMessage());
        }
	}
	
	public function convertdateformat($str)
	{
		if(isset($str) && $str!=""){
			$arr=split("/",$str);
			return $arr[2]."-".$arr[0]."-".$arr[1];
		}
		return "null";
	}
	/**
	This is  only for developing.
	Please delete this code.
	*/
	public function temp($obj)
	{
		if($obj['action']=="select")
		{
			return $this->GetList("select * from ".$obj['tablename'].(isset($obj['where'])?" where ".$obj['where']:""));
		}else if($obj['action']=="delete"){
			$stmt=$this->dbh->prepare("delete from ".$obj['tablename'].(isset($obj['where'])?" where ".$obj['where']:""));
			$stmt->execute();
		}
	}
	
}

?>
