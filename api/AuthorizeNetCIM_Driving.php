<?php

require_once 'AuthorizeNet_Driving_Config.php';


class AuthorizeNetCIM_Driving 
{
  
  public $errormessage="";
  
  
  public function PaymentProcessing($obj)
  {
	  $request = new AuthorizeNetCIM;
	  $customerProfileID=$obj['customerProfileID'];
	  
	  //if User select payment exist already, create transaction, not create payment, transaction.
	  $paymentProfileID=$obj['paymentProfileID'];
	  
	  if($paymentProfileID=="-1"){
		$paymentProfileID = $this->CreatePaymentProfile($customerProfileID, $obj);
	  }
	  //create transaction.
	 $transactionResponse = $this->CreateTransaction($customerProfileID,$paymentProfileID,$obj);
	
		if($transactionResponse == null)
		{
			return array("status"=>"failed","msg"=>$this->errormessage);
		}else{
			return array("status"=>"OK", "data"=>$transactionResponse, "customerProfileId"=>$customerProfileID);
		}
	  
  }
  public function CreatePaymentProfile($customerprofileID,$obj)
  {
		$request = new AuthorizeNetCIM;
		$paymentProfile = new AuthorizeNetPaymentProfile;
		$paymentProfile->customerType = "individual";
		$paymentProfile->payment->creditCard->cardNumber = $obj["cardnumber"];
		$paymentProfile->payment->creditCard->expirationDate = $obj["expiration_yr"]."-".(strlen($obj["expiration_mo"])==1?"0".$obj["expiration_mo"]:$obj["expiration_mo"]);
		//$customerProfile->paymentProfiles[] = $paymentProfile;
		
		$response = $request->createCustomerPaymentProfile($customerprofileID, $paymentProfile);
		
		//return $response;
		
		if(!$response->isOk())
		{
			$this->errormessage.=$response->xml->messages->message->text;
			return -1;
		}
		return $response->getPaymentProfileId();
  }
  public function CreateTransaction($customerProfileID,$paymentProfileID,$obj)
  {
	  $request = new AuthorizeNetCIM;
	  if($customerProfileID!=-1 && $paymentProfileID!=-1)
	  {
	    $transaction = new AuthorizeNetTransaction;
		$transaction->amount = $obj["amount"];
		$transaction->customerProfileId = $customerProfileID;
		$transaction->customerPaymentProfileId = $paymentProfileID;
		
		$lineItem              = new AuthorizeNetLineItem;
		$lineItem->itemId      = $obj["packageID"];
		$lineItem->name        = $obj["packageName"];
		$lineItem->description = $obj["packageDesciption"];
		$lineItem->quantity    = "1";
		$lineItem->unitPrice   = $obj["amount"];
		$transaction->lineItems[] = $lineItem;
		$response = $request->createCustomerProfileTransaction("AuthCapture", $transaction);
		
		//return $response;
		if( $response->isOk())
		{
				$transactionResponse = $response->getTransactionResponse();
				return $transactionResponse;
		}else
		{
				$this->errormessage.=$response->xml->messages->message->text;
				return null;
		}
	  }
	  return null;
		
  }
  public function CreateCustomerProfile($obj)
  {
	$request = new AuthorizeNetCIM;
    // Create new customer profile
    $customerProfile = new AuthorizeNetCustomer;
    $customerProfile->description = $obj['description'];//$obj["cardfname"]." ".$obj["cardlname"];
    $customerProfile->merchantCustomerId = time().rand(1,100);
    $customerProfile->email = $obj["email"];
    
	$response = $request->createCustomerProfile($customerProfile);
    $customerProfileId = $response->getCustomerProfileId();
	
	if(!$response->isOk())
	{
		$this->errormessage=$response->xml->messages->message->text;
		return array("status" => "failed", "msg" => $response->xml->messages->message->text , "data"=>$response);
	}
	
    // Add payment profile.
	
	$paymentProfileId = $this->CreatePaymentProfile($customerProfileId,$obj);
	if($paymentProfileId==-1)
	{
		return array("status"=>"failed","msg"=>$this->errormessage);
	}
	
	$transactionResponse = $this->CreateTransaction($customerProfileId,$paymentProfileId,$obj);
	
	if($transactionResponse == null)
	{
		return array("status"=>"failed","msg"=>$this->errormessage);
	}else{
		return array("status"=>"OK", "data"=>$transactionResponse, "customerProfileId"=>$customerProfileId);
	}
   
  }
  
  
  public function getPaymentMethod($customerProfileID)
  {
	  $request = new AuthorizeNetCIM;
	  $response = $request->getCustomerProfile($customerProfileID);
	  $paymentProfiles=$response->xml->profile->paymentProfiles;//->customerPaymentProfileId;
	  //print_r(json_encode($arr));
	  //exit;
	  $result[]=array();
	  
	 for($i=0;$i<count($paymentProfiles);$i++)
	 {
		 
		$paymentmethod=array("CustomerPaymentProfileId"=>$paymentProfiles[$i]->customerPaymentProfileId,
		"card"=>$paymentProfiles[$i]->payment->creditCard->cardNumber
		);
		//$paymentmethod=$arr[$i];
		//$paymentmethod=$arr[$i]->payment->creditCard->cardNumber->getName();
		//$paymentmethod["expirationDate"]=$arr[$i]->payment->creditCard->expirationDate;
		//print_r($paymentmethod);
		$result[$i]=$paymentmethod;
	 }
	 return array("status"=>"OK","data"=>$result);
	  
  }
 
}

//Unit Test Code.
/*$auth=new AuthorizeNetCIM_Driving;
$customerProfileID=31379694;
$paymentProfileID=28383072;
print_r(json_encode($auth->getPaymentMethod($customerProfileID)));




//print_r("123123132");
/**$obj=array();
$obj['cardnumber']="4111111111111112";
$obj['expiration_yr']="2015";
$obj['expiration_mo']="4";
//print_r($auth->CreatePaymentProfile($customerProfileID,$obj));
//print_r($auth->errormessage);
$obj["packageID"]="1";
$obj["packageName"]="hhhh";
$obj["packageDesciption"]="hhhh_desc";
$obj["amount"]=10;

print_r($auth->CreateTransaction($customerProfileID,$paymentProfileID,$obj));
print_r($auth->errormessage);
*/


?>