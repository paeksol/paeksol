<?php
$error = "";

if (isset($_POST['submit']) && $_POST['submit']!="")
  {     
  	    require_once("./includes/config.inc.php");
	    require_once("./includes/pay_action_class.php");
	 	$a = new AuthorizeNet($authnet_user, $authnet_txnkey);
	 	if ($authnet_testmode) $a->TESTING = 1;
	 	
	 	//list($firstname, $lastname) = $_REQUEST['cc_name'];
		
		$totalcharge = $_REQUEST['totalcharge']; // as default 
	
	 	$a->cc_no = $_REQUEST['cc_number'];
		//$a->b_firstname = $firstname;
		//$a->b_lastname = $lastname;
        if(strpos($_REQUEST['cc_name']," ")!==false){
           $name = explode(" ", $_REQUEST['cc_name']);
           $a->b_firstname = $name[0];
           $a->b_lastname  = $name[1];
        }else{
           $a->b_firstname =  $_REQUEST['cc_name'];
           $a->b_lastname  =  "";
        }
        $invoice_number = uniqid();
		$a->b_zip = $_REQUEST['billingzip'];
		$a->b_phone = $student_contact_number;
		$a->cc_cvv2 = $_REQUEST['cvv2'];
		$a->b_email = $student_email;
		$a->b_cust_id = $this->pixie->auth->service("Student")->user()->student_id;
	    $a->b_invoice_num = $invoice_number;

		$a->cc_exp = $_REQUEST['exp_month'] . $_REQUEST['exp_year']; //MMYY
		$a->cc_amount = $totalcharge;	
		
		$a->process_payment();
		$ispaid_status = $a->ispaid_status;
		$errcode = $a->errcode;
		$approval_code = $a->approval_code;
		$transaction_id = $a->transaction_id;

		$authnet_payments = 4; 
		//$approvalcode = 100; // not define 
	
		if($ispaid_status != 1){ 
			$error .= "Your credit card was not accepted. Please try again.<br />";
		}else{

		require_once("./includes/subscrip_functions.inc.php");
		/*	$startdate = strtotime("+1 month");
				//build xml to post
				$content =
					"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
					"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
						"<merchantAuthentication>".
							"<name>" . $authnet_user . "</name>".
							"<transactionKey>" . $authnet_txnkey . "</transactionKey>".
						"</merchantAuthentication>".
						"<refId>" . $approvalcode . "</refId>".
						"<subscription>".
							"<paymentSchedule>".
								"<interval>".
									"<length>1</length>".
									"<unit>months</unit>".
								"</interval>".
								"<startDate>" . date("Y-m-d", $startdate) . "</startDate>".
								"<totalOccurrences>" . ($authnet_payments-1) . "</totalOccurrences>".
							"</paymentSchedule>".
							"<amount>". $totalcharge ."</amount>".
							"<payment>".
								"<creditCard>".
									"<cardNumber>" . $_REQUEST['cc_number'] . "</cardNumber>".
									"<expirationDate>" . $_REQUEST['exp_year'].'-'.$_REQUEST['exp_month'] . "</expirationDate>".
								"</creditCard>".
							"</payment>".
							#"<order>".
							#	"<invoiceNumber>" . $_SESSION[invoice] . "</invoiceNumber>".
							#	"<description>" . $desc . "</description>".
							#"</order>".
							"<customer>".
								"<email>" . $student_email . "</email>".
								"<phoneNumber>" . $student_contact_number . "</phoneNumber>".
							"</customer>".
							"<billTo>".
								"<firstName>". $firstname . "</firstName>".
								"<address>" . $address_cross_street . "</address>".
								"<city>" . $address_city . "</city>".
								"<state>" . $address_state . "</state>".
								"<zip>" . $address_zip . "</zip>".
							"</billTo>".
						"</subscription>".
					"</ARBCreateSubscriptionRequest>";
					
				if ($authnet_testmode)
					{
					  $posturl = "https://apitest.authorize.net/xml/v1/request.api"; 
				    }else {
				      $posturl = "https://api.authorize.net/xml/v1/request.api";
				    }
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $posturl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				
				
					$response = curl_exec($ch);
					#echo "<pre>Sent: $content\nGOT RESPONSE: $response</pre>";
					list ($refId, $resultCode, $code, $text, $subscriptionId) =parse_return($response);
				

			$subscrip_logtext = array($refId, $resultCode, $code, $text, $subscriptionId);
			subscrip_sitelog($subscrip_logtext);*/
			$transectiondata =  array();
            $transectiondata['student_id'] = $this->pixie->auth->service("Student")->user()->student_id;
            $transectiondata['package_id'] = $_REQUEST['packageids'];
            $transectiondata['transactions_amount']     = $totalcharge;
            $transectiondata['transactions_deposit']    = $totalcharge;
            $transectiondata['transactions_deposited']  = 'Y';
            $transectiondata['transactions_deposited_date'] = date('Y-m-d H:i:s');
            $transectiondata['transactions_deposited_user'] = $this->pixie->auth->service("Student")->user()->student_name;
            $transectiondata['transactions_method']   = "up front"; // as defualt value ,will add soon when admin complete
            $transectiondata['transactions_cardname'] = $_REQUEST['cc_name'];
            $transectiondata['transactions_cardtype'] = "Visa";
            $transectiondata['transactions_transid']  = $transaction_id;
            $transectiondata['transactions_card_num'] = $_REQUEST['cc_number'];
            $transectiondata['approval_code']         = $approval_code;
            $transectiondata['invoice_number']        = $invoice_number;
            $package  = $this->pixie->orm->get('Package');  
            $package->AddTransection($transectiondata);
            header('Location:/student/dashboard/thankyou');
		}	
}
?>
<?php  $packagearr = array("299"=>"Basic","479"=>"Standard","679"=>"Deluxe");?>
<div class="leftHolder">
    <button onclick="window.location.href='/student'" id="backbutton" >Back</button>

    <div class="titleHolder"><h1>Payment Information</h1></div>
   		
    <div class="contentHolder">
        <?php //echo trim($page_content); ?>
    </div>
     <div class="formHolder paymentinfo" >
        <form method="POST" name="paymentform" id="paymentform" onsubmit="return checkpaymentinfo();" >
        <!-- error block -->
        <div id="paymentinfoerror" class="errorsHolder" style="display: none;">
			Please correct the following errors;
			<ul class="err"></ul>
		</div>
      
            <div class="formLine">
                <label for="cardholdername">Cardholder Name:</label>
                <input type="text" name="cc_name" id="cc_name" />
            </div>
            <div class="formLine">
                <label for="creditcard">Credit Card #:</label>
                <input type="text" name="cc_number" id="cc_number"  maxlength="16" />
            </div>
             <div class="formLine">
                <label for="expdate">Expiration Date:</label>
                <span id="birthDate"><?php
				$dates = "<select name=\"exp_month\" id='exp_month'><option value=''></option>\n";
				for ( $i = 1; $i <= 12; $i++ )	{
					$dates .= "<option value=\"$i\" >$i</option>\n";
				}
				$dates .= "</select>";
				$dates .= "<select name=\"exp_year\" id='exp_year'><option value=''></option>\n";
				for ( $i = date('Y'); $i <= (date('Y')+15); $i++ )	{
					$dates .= "<option value=\"$i\">$i</option>\n";
				}
				$dates .= "</select>";
				echo $dates;
				?></span>
            </div>
            <div class="formLine">
                <label for="cc_cvv2">CVV2 Code:</label>
                <input type="text" name="cvv2" id="cvv2" maxlength="3" />
            </div>
            <div class="formLine">
                <label for="billingzip">Billing Zip:</label>
                <input type="text" name="billingzip" id="billingzip" maxlength="5" />
            </div>
            <div class="formLine coupon_code">
                <label for="coupon">Coupon Code:</label>
                <div class="coupon_div">
                	<input type="text" name="cc_coupon" id="cc_coupon"   />
                    <input type="button"  name="verify_coupon_code" id="verify_coupon_code"  value="Verify" >
                </div>
            </div>
            <div class="formLine">
                <label for="billingzip"></label>
                <label id="coupon_code_sts"></label>
            </div>
	         <div class="clear"></div>
	         <div class="formLine">
	                <label for="package_name">Package Name:</label>
	                <label for="package_name"><?=isset($packagearr[$total_price])?$packagearr[$total_price]:"No package selected";?></label>
	         </div>
	         <div class="formLine">
	                <label for="amount">Amount:</label>
	                <label for="amount" id="amount"><?=isset($total_price)?"$".$total_price:"No package selected";?></label>
	         </div>
            <input type="hidden" name="totalcharge" id="totalcharge" value="<?=isset($total_price)?$total_price:0;?>" >
            <input type="hidden" name="packageids" id="packageids" value="<?=isset($package_id)?$package_id:0;?>" >
            <!-- when the form is submit by this button, it needs to get picked up by jquery and process via AJAX -->
            <button type="submit" value="true" name="submit" id="submit">Process Payment!</button>

        </form>
      
    </div>
</div>

<!-- include the contact form on the right side -->
<?php include("contactUsForm.php"); ?>
<script>
 $("#verify_coupon_code").on("click",function(){
 	if($("#cc_coupon").val()!=""){
 	    $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax/website/packages/checkcouponcode",
                data: {"coupon_code":$("#cc_coupon").val(),"package_price":$("#totalcharge").val()},
                success: function(data) { 

                 if(Number($("#totalcharge").val())>Number(data['coupon_price'])){
                   $("#amount").html("$"+(Number($("#totalcharge").val())-Number(data['coupon_price'])));	
                   $("#totalcharge").val((Number($("#totalcharge").val())-Number(data['coupon_price'])));	
                 } 	
                 $("#coupon_code_sts").css("color",data['color']);	
                 $("#coupon_code_sts").html(data['status']);
                }
                
         }); 
 		jQuery("#paymentinfoerror").hide();
 	}else{
 		errhtml = "";
 		errhtml += "<li><span id='couponErrorShow' style='display: inline;'>Coupon Code cannot be empty.</span></li>";
 		jQuery("#paymentinfoerror").show();
		jQuery(".err").html(errhtml);
 	}
 })
     	


function showpaymentform () {
	var err = true;
	var errhtml= ""; 
	
	if(!$("input:checked").is(':checked')){
		 err = false;
         errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Please Select at least one package to proceed.</span></li>";
        
	}

	if(err==false){ 
		jQuery("#packageerror").show();
		jQuery(".err").html(errhtml);
	}else{
		jQuery("#packageerror").hide();
	    jQuery("#allpackages").hide();
		jQuery(".paymentinfo").show();	
	}
	var totalvalue= 0;
	var packageids = "";
    $("input[type='checkbox']").each(function(){
    	if($(this).is(':checked')){
    		totalvalue +=Number($(this).val());
    		packageids +=","+$(this).attr('id');
       
    	}
    });
    $("#totalcharge").val(totalvalue);
    $("#packageids").val(packageids);
    
	return err;
}
function checkpaymentinfo () { 
	var err= true;
	var errhtml= ""; 
	
		if($("#cc_name").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Card Holder Name cannot be empty.</span></li>";
		}
		if($("#cc_number").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Credit Card Number cannot be empty.</span></li>";
		}
		if($("#exp_month").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Exp. Month cannot be empty.</span></li>";
		}
		if($("#exp_year").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Exp. Year cannot be empty.</span></li>";
		}
		if($("#cvv2").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>CVV2 cannot be empty.</span></li>";
		}
		if($("#billingzip").val()==""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Billing Zip cannot be empty.</span></li>";
		}
		if(!$.isNumeric($("#cc_number").val()) && $("#cc_number").val()!=""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Credit Card Number  cannot be String Value.</span></li>";
		}
		if(!$.isNumeric($("#cvv2").val()) && $("#cvv2").val()!=""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>CVV2  cannot be String Value.</span></li>";
		}
		if(!$.isNumeric($("#billingzip").val()) && $("#billingzip").val()!=""){
			err =false;
            errhtml += "<li><span id='nameErrorShow' style='display: inline;'>Billing Zip cannot be String Value.</span></li>";
		}
	
	if(err==false){
		jQuery("#paymentinfoerror").show();
		jQuery(".err").html(errhtml);
	}else{
		jQuery("#paymentinfoerror").hide();
	}
   
	return err;
}

</script>
<style>
	.payment {
      text-align: center;
      font-weight: bold;
	}
	#backbutton{
		background-color: #583b4d;
	    color: white;
	    float: right;
	    margin-right: 10px;
	    margin-top: 20px;
	}
	.wrapper {
		min-height: 140%;
	}
	#verify_coupon_code{
	   margin-left: 9px;
       width: 31%;
	}
    #cc_coupon{
    	 width: 272px;
    }
    .coupon_div{
       display: inline-flex;
       float: right;
    }
    #coupon_code_sts{
    	margin-left:225px; 
    }
</style>