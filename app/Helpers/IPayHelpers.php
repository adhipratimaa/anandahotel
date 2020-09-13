<?php
namespace App\Helpers;

use App\Helpers\MyIpay;

class IpayHelpers {
	
	public static function processPayment () {
		
		$ipay = new MyIpay();
		return $ipay->saleTxn(); 
	}

	public static function collectResponse ($data) {

		$_SESSION["ipay_in__action"] = 'saleTxnVerify';
		$_SESSION["ipay_in__mer_ref_id"] = $data['mer_ref_id'];
		$_SESSION["ipay_out__txn_uuid"] = $data['TXN_UUID'];
		$ipay_sec= new MyIpay();
		return $ipay_sec->saleTxnVerify($data);  // Extract the response details.
	}
}