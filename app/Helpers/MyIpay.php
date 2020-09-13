<?php
namespace App\Helpers;

class MyIpay {

	public function saleTxn() 
	{
		$MerRefID = $_SESSION["ipay_in__mer_ref_id"];
		$Action = $_SESSION["ipay_in__action"];
		$TxnAmount = $_SESSION["ipay_in__txn_amt"];
		$currencyCode = $_SESSION["ipay_in__cur"];
		$LanguageCode = $_SESSION["ipay_in__lang"];
		$ReturnURL = $_SESSION["ipay_in__ret_url"];

		$MerVar1 = $_SESSION["ipay_in__mer_var1"];
		$MerVar2 = $_SESSION["ipay_in__mer_var2"];
		$MerVar3 = $_SESSION["ipay_in__mer_var3"];
		$MerVar4 = $_SESSION["ipay_in__mer_var4"];
		$sItemList = $_SESSION["ipay_in__item_list"]; 


		//Parameters for SetExpressCheckout, which will be sent to ipay
		$Invoice = "";
		$Invoice .= "<req>".
						"<mer_id>" . env('IPAY_MERCHANT_ID') . "</mer_id>".
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
		
		//adding hash val
		$sHash = hash('sha256', $Invoice.env('IPAY_KEY'),false);
		
		$ServerParam = 'VERSION='.env('IPAY_VERSION').'&PWD='.env('IPAY_PASSWORD').'&MERCHANTID='.env('IPAY_MERCHANT_ID').'&KEY='.env('IPAY_KEY').'&HASH='.$sHash;
		$url  = env('IPAY_API_URL');
		$myXML = $ServerParam.'&PTINVOICE='.bin2hex($Invoice);
		
			
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
		$myhashmap = array();
		
		// Extract the response details.
		$httpResponseAr = explode("&", $response);
		
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$myhashmap[strtoupper($tmpAr[0])] = $tmpAr[1];
			}
		}
						
		if (strcasecmp($myhashmap['ERROR_CODE'], '000') == 0)
		{	
			$sHash1 = hash('sha256', $myhashmap['PTRECEIPT'].env('IPAY_KEY'),false);
			if (true) //(strcasecmp($myhashmap['HASH'], $sHash1) == 0)
			{
				$xml = new \SimpleXMLElement($this->hextostr( $myhashmap['PTRECEIPT'] ));
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
			}	
			else
			{
				dd('Hash verification failed');
			}
		}
		else
		{
			dd('Error '.print_r($myhashmap)); // handle this error in better way
		}

		return $myhashmap;
	}
	
	public function saleTxnVerify() 
	{
		$MerRefID = $_SESSION["ipay_in__mer_ref_id"];
		$Action = $_SESSION["ipay_in__action"];
		$TxnUUID = $_SESSION["ipay_out__txn_uuid"];
		$Action = 'saleTxnVerify';
		
		//Parameters for SetExpressCheckout, which will be sent to ipay		
		$PTInvoice = "";
		$PTInvoice .= "<req>".
						"<mer_id>" . env('IPAY_MERCHANT_ID'). "</mer_id>".
						"<mer_txn_id>" .$MerRefID. "</mer_txn_id>".
						"<txn_uuid>" . $TxnUUID . "</txn_uuid>".
						"<action>" . $Action . "</action>" .
						"</req>";
		
		// ISSUE : SESSION VARIABLES ARE GETTING EMPTY - SAILESH
						
		//adding hash val
		$sHashverify = hash('sha256', $PTInvoice.env('IPAY_KEY'),false);	
		
		$ServerParam = 'VERSION='.env('IPAY_VERSION').'&PWD='.env('IPAY_PASSWORD').'&MERCHANTID='.env('IPAY_MERCHANT_ID').'&KEY='.env('IPAY_KEY').'&HASH='.$sHashverify;
		$url  = env('IPAY_API_URL');
		//$myXML = $ServerParam.'&PTINVOICE='.$PTInvoice;
		$myXML = $ServerParam.'&PTINVOICE='.bin2hex($PTInvoice);
		
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

		$myhashmap = array();
		
		// Extract the response details.
		$httpResponseAr = explode("&", $response);
		
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$myhashmap[strtoupper($tmpAr[0])] = $tmpAr[1];
			}
		}
		
		if (strcasecmp($myhashmap['ERROR_CODE'], '000') == 0)
		{	
			$sHash1 = hash('sha256', $myhashmap['PTRECEIPT'].env('IPAY_KEY'),false);
			if (true) 
			{
				$xml = new \SimpleXMLElement($this->hextostr( $myhashmap['PTRECEIPT'] ));
				$BankRefID  = (string)$xml->bank_ref_id;
				$CurrencyCode = (string)$xml->cur;
				$IPGTransactionID = (string)$xml->ipg_txn_id;
				$MerRefID = (string)$xml->mer_txn_id;
				$TxnAmount = (string)$xml->txn_amt;
				$TxnStatus = (string)$xml->txn_status;
				$ServerTime = (string)$xml->server_time;
				$MaskedAccNo = (string)$xml->acc_no;
				$LanguageCode = (string)$xml->lang;
				$MerVar1 = (string)$xml->mer_var1;
				$MerVar2 = (string)$xml->mer_var2;
				$MerVar3 = (string)$xml->mer_var3;
				$MerVar4 = (string)$xml->mer_var4;
				$CustomerName = (string)$xml->name;
				$FailReason = (string)$xml->reason;
				$AuthCode = (string)$xml->auth_code;
				
				
				$myhashmap = array();
				if(0 < strlen($BankRefID))
				{
					$myhashmap['ipay_out__bank_ref_id'] = $BankRefID;
				}
				if(0 < strlen($CurrencyCode))
				{
					$myhashmap['ipay_out__cur_code'] = $CurrencyCode;
				}
				if(0 < strlen($IPGTransactionID))
				{
					$myhashmap['ipay_out__ipg_txn_id'] = $IPGTransactionID;
				}
				if(0 < strlen($MerRefID))
				{
					$myhashmap['ipay_out__mer_ref_id'] = $MerRefID;
				}
				if(0 < strlen($TxnAmount))
				{
					$myhashmap['ipay_out__txn_amt'] = $TxnAmount;
				}
				if(0 < strlen($TxnStatus))
				{
					$myhashmap['ipay_out__txn_status'] = $TxnStatus;
				}
				if(0 < strlen($ServerTime))
				{
					$myhashmap['ipay_out__server_time'] = $ServerTime;
				}
				if(0 < strlen($MaskedAccNo))
				{
					$myhashmap['ipay_out__masked_acc_number'] = $MaskedAccNo;
				}
				if(0 < strlen($LanguageCode))
				{
					$myhashmap['ipay_out__lang'] = $LanguageCode;
				}
				if(0 < strlen($MerVar1))
				{
					$myhashmap['ipay_out__mer_var_1'] = $MerVar1;
				}
				if(0 < strlen($MerVar2))
				{
					$myhashmap['ipay_out__mer_var_2'] = $MerVar2;
				}
				if(0 < strlen($MerVar3))
				{
					$myhashmap['ipay_out__mer_var_3'] = $MerVar3;
				}
				if(0 < strlen($MerVar4))
				{
					$myhashmap['ipay_out__mer_var_4'] = $MerVar4;
				}
				if(0 < strlen($CustomerName))
				{
					$myhashmap['ipay_out__card_holder_name'] = $CustomerName;
				}
				if(0 < strlen($FailReason))
				{
					$myhashmap['ipay_out__fail_reason'] = $FailReason;
				}
				if(0 < strlen($AuthCode))
				{
					$myhashmap['ipay_out__auth_code'] = $AuthCode;
				}
			}	
			else
			{
				dd('Hash verification failed');
			}
		}
		else
		{
			dd('Error '.print_r($myhashmap)); // handle this error in better way
		}
		
		return $myhashmap;
	}
	
	public function hextostr($hex)
	{
		$str='';
		for ($i=0; $i < strlen($hex)-1; $i+=2)
		{
		$str .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $str;
	}	
}
?>
