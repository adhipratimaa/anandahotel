<?php
namespace App\Helpers;
// session_start();

use App\Helpers\MyIpay;

class IpayHelpers {
	//__________________________________________________________________________________________
 //    //ipay API config settings - this can be set using property file
	// public static $MerchantId = '405635000006437'; 
	// public static $Password = '123456789';                                              // ipay API password
	// public static $Key = 'MjM0MDU2MzUwMDAwMDY0MzdmMWRhMWRkMS1jZjliLTRkY2YtYTRiNi1jOWE5MDZhM2U1M';                                // ipay API key
	// public static $Version = '1.00';                                              // API version.
	// public static $API_URL = "http://202.63.245.71:30090/ipg/servlet_exppear";   // ipay end point
	// //__________________________________________________________________________________________
	
	public static function processPayment () {

	// 	$ipay_product['items'][] = array('itm_name'=> 'Android Phone FX1',
	// 		'itm_price'=> '1.21',
	// 		'itm_code'=> 'PD1001', 
	// 		'itm_qty'=> '1',
	// 	);
		

		
		
	// // $GrandTotal = ($ItemTotalPrice );
	// 	$GrandTotal = 10.21;
	// // Set up your API credentials & ipay end point
	// 	$iPay_URL = 'http://202.63.245.71:30090/ipg/servlet_exppay';
	// 	$sAction = 'SaleTxn';                    
	// $_SESSION["ipay_in__action"] = $sAction;                 // Create invoice for sale transaction 'SaleTxn' or 'saleTxnGroup' / AddWallet / AddCard / SaleWalletTxn / ListCards /
	// $_SESSION["ipay_in__cur"] = 'NPR';                       // currency
	// $_SESSION["ipay_in__lang"] = 'eng';                      // language
	// $_SESSION["ipay_in__ret_url"] = 'http://127.0.0.1:8000/ipay-response'; //Return URL for the confirmation page
	// $_SESSION["ipay_in__mer_var1"] = '';                     
	// $_SESSION["ipay_in__mer_var2"] = '';
	// $_SESSION["ipay_in__mer_var3"] = '';
	// $_SESSION["ipay_in__mer_var4"] = '';
	// $_SESSION["ipay_in__item_list"] = '';

	// $mer_txn_id = rand(1000, 9999999);	
	// $_SESSION["ipay_in__mer_ref_id"] = $mer_txn_id.'';          // merchant reference id
	// $_SESSION["ipay_products"] = $ipay_product;              //create session array for later use
	// $_SESSION["ipay_in__txn_amt"] =$GrandTotal;              //Grand total including all tax, insurance, shipping cost and discount

	/**
	* Create invoice for sale transaction
	*/
	$ipay= new MyIpay();
	
	// if($sAction == 'SaleTxn') 
		$httpParsedResponseAr = $ipay->saleTxn();          // We need to execute the method to obtain uudi token
		return $httpParsedResponseAr;
		// return self::saleTxn($txnRequest);          // We need to execute the method to obtain uudi token
	// else if($sAction == "saleTxnGroup") 
		// $httpParsedResponseAr = $ipay->saleTxnGroup();     // We need to execute the method to obtain uudi token
	// dd($httpParsedResponseAr);
	// dd($_SESSION['ipay_products']);
	// print_r($_SESSION["ipay_in__mer_ref_id"]);
	// dd($httpParsedResponseAr['ipay_out__txn_uuid']);
	// dd(strlen($httpParsedResponseAr['ipay_out__txn_uuid']));
	// if(0 < strlen($httpParsedResponseAr['ipay_out__txn_uuid']))
	// {
	// 	// dd('true');
	// 	$data['txn_uuid'] = $httpParsedResponseAr['ipay_out__txn_uuid'];
	// 	$data['url'] = $iPay_URL;
	// 	return $data;
	// 	// return view('ipay.redirect-to-ipay', ['url' => $iPay_URL, 'TXN_UUID' => $httpParsedResponseAr]);
	// 	dd($iPay_URL);
	// }
	// else {
	// 	dd('error');
	// }
}

public static function collectResponse ($data) {
	// $ipay_product = $_SESSION["ipay_products"];
	// 	$uuid_session = $_SESSION["ipay_out__txn_uuid"]; //13f101ed-c2d2-4691-b08c-14665d91dda3
	// 	$mer_txn_id_sesson = $_SESSION["ipay_in__mer_ref_id"];
	// 	foreach($ipay_product['items'] as $key=>$p_item)
	// 	{		
	// 		$itm_qty = $p_item['itm_qty'];
	// 		$itm_price = $p_item['itm_price'];
	// 		$itm_name = $p_item['itm_name'];
	// 		$itm_code = $p_item['itm_code'];	
	// 	}
	// dd($data['mer_ref_id']);

		$_SESSION["ipay_in__action"] = 'saleTxnVerify';
		$_SESSION["ipay_in__mer_ref_id"] = $data['mer_ref_id'];
		$_SESSION["ipay_out__txn_uuid"] = $data['TXN_UUID'];
		// Issue is here @echobinod
		$ipay_sec= new MyIpay();
		$httpParsedResponseArsec = $ipay_sec->saleTxnVerify($data);  // Extract the response details.
		return $httpParsedResponseArsec;
	}

	public static function saleTxn ($txnRequest) {
		//ONLY SESSION BASED THINGS CHANGED - WE CAN REFACTOR OTHER TOO..
		$MerchantId = '405635000006437'; 
	$Password = '123456789';                                              // ipay API password
	$Key = 'MjM0MDU2MzUwMDAwMDY0MzdmMWRhMWRkMS1jZjliLTRkY2YtYTRiNi1jOWE5MDZhM2U1M';                                // ipay API key
	$Version = '1.00';                                              // API version.
	$API_URL = "http://202.63.245.71:30090/ipg/servlet_exppear";


		$MerRefID = $txnRequest["ipay_in__mer_ref_id"];
		$Action = $txnRequest["ipay_in__action"];
		$TxnAmount = $txnRequest["ipay_in__txn_amt"];
		$currencyCode = $txnRequest["ipay_in__cur"];
		$LanguageCode = $txnRequest["ipay_in__lang"];
		$ReturnURL = $txnRequest["ipay_in__ret_url"];

		$MerVar1 = $txnRequest["ipay_in__mer_var1"];
		$MerVar2 = $txnRequest["ipay_in__mer_var2"];
		$MerVar3 = $txnRequest["ipay_in__mer_var3"];
		$MerVar4 = $txnRequest["ipay_in__mer_var4"];
		$sItemList = $txnRequest["ipay_in__item_list"]; 

		//Parameters for SetExpressCheckout, which will be sent to ipay
		$Invoice = "";
		$Invoice .= "<req>".
						"<mer_id>" . $MerchantId . "</mer_id>".
						"<mer_txn_id>" .$MerRefID. "</mer_txn_id>".
						"<action>" . $Action . "</action>".
				"<txn_amt>" . $TxnAmount . "</txn_amt>".
				"<cur>" . $currencyCode . "</cur>" .
				"<lang>" .$LanguageCode. "</lang>";

		if($ReturnURL != "") {
		   $Invoice .= "<ret_url>" . $ReturnURL . "</ret_url>"; 
		}

		if($MerVar1 != "") {
			$Invoice .= "<mer_var1>" .$MerVar1. "</mer_var1>";
		}

		if($MerVar2 != "") {
			$Invoice .= "<mer_var2>" .$MerVar2. "</mer_var2>";
		}

		if($MerVar3 != "") {
			$Invoice .= "<mer_var3>" .$MerVar3. "</mer_var3>";
		}

		if($MerVar4 != "") {
			$Invoice .= "<mer_var4>" .$MerVar4. "</mer_var4>";
		}
		
		if($sItemList != "") {
			$Invoice .= "<item_list>" .$sItemList. "</item_list>";
		}

		$Invoice .= "</req>";
		
		//echo '<pre>', htmlspecialchars($Invoice), '</pre>';
		//adding hash val
		$sHash = hash('sha256', $Invoice.$Key,false);
		
		$ServerParam = 'VERSION='.$Version.'&PWD='.$Password.'&MERCHANTID='.$MerchantId.'&KEY='.$Key.'&HASH='.$sHash;
		//error_log(print_r($ServerParam,true ));
		$url  = $API_URL;
		//$myXML = $ServerParam.'&PTINVOICE='.$Invoice;
		$myXML = $ServerParam.'&PTINVOICE='.bin2hex($Invoice);
		
		//echo '<pre>', htmlspecialchars($myXML), '</pre>';
			
		$options = array 
		(
			CURLOPT_URL            => $url,
			CURLOPT_POST           => true,
			CURLOPT_POSTFIELDS     => $myXML,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false
			
		);

		$curl = curl_init();
		curl_setopt_array($curl, $options);
		$response = curl_exec($curl);
		curl_close($curl);
		//echo '<pre>', htmlspecialchars($response), '</pre>';
		//die;
		$myhashmap = array();
		
		// Extract the response details.
		$httpResponseAr = explode("&", $response);
		
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$myhashmap[strtoupper($tmpAr[0])] = $tmpAr[1];
			}
		}
		
		//echo '<pre>', htmlspecialchars('ERROR_CODE='. $myhashmap['ERROR_CODE']. '&PTRECEIPT='. $this->hextostr($myhashmap['PTRECEIPT'])), '</pre>';
		dd($myhashmap);
		if (strcasecmp($myhashmap['ERROR_CODE'], '000') == 0)
		{	
			$sHash1 = hash('sha256', $myhashmap['PTRECEIPT'].$Key,false);
			if (true) //(strcasecmp($myhashmap['HASH'], $sHash1) == 0)
			{
				$xml = new \SimpleXMLElement(self::hextostr( $myhashmap['PTRECEIPT'] ));
				$TxnUuid = (string)$xml->txn_uuid;
				$ipg_txn_id = (string)$xml->ipg_txn_id;
				
				//$TxnUuid_hex = bin2hex($TxnUuid.'|'.$this->Key); // gayan
				$TxnUuid_hex = $TxnUuid; // gayan
				
				$_SESSION["ipay_out__txn_uuid"] = $TxnUuid;
				
				if(0 < strlen($TxnUuid))
				{
				$myhashmap['ipay_out__txn_uuid'] = $TxnUuid_hex;
				}
				if(0 < strlen(trim($ipg_txn_id)))
				{
				$myhashmap['ipay_out__ipg_txn_id'] = $ipg_txn_id;
				}

				$myhashmap['status'] = true;
			}	
			else
			{
			// 	//*********IF ERROR***************	
			// 	echo '<div style="color:red"><b>Error1 : </b></div>';
			// 	echo '<pre>';
			// 	echo '<h4>Hash verification failed!!</h4>';
			// 	echo '</pre>';
			// 	//*********IF ERROR***************
				$myhashmap['status'] = false;
			}
		}
		else
		{
			//*********IF ERROR***************	
			echo '<div style="color:red"><b>Error2 : </b></div>';
			echo '<pre>';
			echo '<pre>', htmlspecialchars('>>'.print_r($myhashmap)), '</pre>';
			echo '</pre>';
			//*********IF ERROR***************
			$myhashmap['status'] = false;
		}

		return $myhashmap;
	}
	 public static function hextostr($hex)
	{
		$str='';
		for ($i=0; $i < strlen($hex)-1; $i+=2)
		{
		$str .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		//echo '<pre>', htmlspecialchars($str), '</pre>';
		return $str;
	}

}