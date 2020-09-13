<?php
namespace App\Http\Controllers\Ipay;
session_start();

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\IPayHelpers;
use App\IpayDetail;

class IpayController extends Controller
{

	public function processPayment (Request $request) {
    	//NOTE : FROM SAILESH
    	// IPAY ONLY PROVIDE ONE DEMO CODE WHICH IS IN CORE PHP
    	// HAD ISSUES WITH SOME OLD PHP FUNCTIONS
    	// TRIED GET RID OF SESSION THINGS - THEIR API IS NOT WORKING 

    	// FEEL FREE TO ADD PROPER REDIRECTION AND MESSAGES

    	
		//TODO:AFTER SAVING ORDER IN TABLE - GET RECORDS AND FEED IT HERE..
		$ipay_product['items'][] = array('itm_name'=> 'Android Phone FX1',
			'itm_price'=> '1.21',
			'itm_code'=> 'PD1001', 
			'itm_qty'=> '1',
		);

		$GrandTotal = 1.21;

		$iPay_URL = 'http://202.63.245.71:30090/ipg/servlet_exppay';
		$sAction = 'SaleTxn';

		$mer_txn_id = rand(1000, 9999999);

		
		//CHECK DEMO CODE / DOCUMENT FOR DESCRIPTION OF THESE PARAMETERS
		$_SESSION["ipay_in__action"] = $sAction;
		$txn["ipay_in__action"] = $sAction;                
		$_SESSION["ipay_in__cur"] = 'NPR';                   
		$txn["ipay_in__cur"] = 'NPR';                      
		$_SESSION["ipay_in__lang"] = 'eng';          
		$txn["ipay_in__lang"] = 'eng';               
		$_SESSION["ipay_in__mer_var1"] = '';                     
		$txn["ipay_in__mer_var1"] = '';                     
		$_SESSION["ipay_in__mer_var2"] = '';
		$txn["ipay_in__mer_var2"] = '';
		$_SESSION["ipay_in__mer_var3"] = '';
		$txn["ipay_in__mer_var3"] = '';
		$_SESSION["ipay_in__mer_var4"] = '';
		$txn["ipay_in__mer_var4"] = '';
		$_SESSION["ipay_in__item_list"] = '';
		$txn["ipay_in__item_list"] = '';
		$_SESSION["ipay_in__mer_ref_id"] = $mer_txn_id.'';   
		$txn["ipay_in__mer_ref_id"] = $mer_txn_id.'';
		$_SESSION["ipay_products"] = $ipay_product; 
		$txn["ipay_products"] = $ipay_product;
		$_SESSION["ipay_in__txn_amt"] = $GrandTotal;
		$txn["ipay_in__txn_amt"] = $GrandTotal;


		$txnDBId = IpayDetail::insertGetId(['sale_txn_request' => json_encode($txn, JSON_NUMERIC_CHECK)]);
	
		$ret_url = $request->getSchemeAndHttpHost().'/ipay-response/'.$txnDBId; 
		$_SESSION["ipay_in__ret_url"] = $ret_url; //Return URL for the confirmation page
		$txn["ipay_in__ret_url"] = $ret_url; //Return URL for the confirmation page

		$txnResponse = IpayHelpers::processPayment();
		if (0 < strlen($txnResponse['ipay_out__txn_uuid'])) {

			$data['txn_uuid'] = $txnResponse['ipay_out__txn_uuid'];
			$data['url'] = $iPay_URL;

			$updatedIpay = IpayDetail::whereId($txnDBId)->update(['sale_txn_response' => json_encode($txnResponse, JSON_NUMERIC_CHECK)]);

			return view('ipay.redirect-to-ipay', ['data' => $data]);
		} else {
			//TODO: show proper payment process error here..
			dd('payment-failed');

		}
	}

	public function collectIpayResponse (Request $request, $id) {

		$_SESSION["ipay_in__action"] = 'saleTxnVerify';
		$txn["ipay_in__action"] = 'saleTxnVerify';
		$_SESSION["ipay_in__mer_ref_id"] = $request->mer_ref_id;
		$txn["ipay_in__mer_ref_id"] = $request->mer_ref_id;
		$_SESSION["ipay_out__txn_uuid"] = $request->TXN_UUID;
		$txn["ipay_out__txn_uuid"] = $request->TXN_UUID;

		$updateRequest = IpayDetail::whereId($id)->update(['sale_txn_verify_request' => json_encode($txn, JSON_NUMERIC_CHECK)]);

		$response = IPayHelpers::collectResponse($request->all());

		$updateResponse = IpayDetail::whereId($id)->update(['sale_txn_verify_response' => json_encode($response, JSON_NUMERIC_CHECK), 'final_status' => $response['ipay_out__txn_status']]);
    	//store the response as well..
		if ($response['ipay_out__txn_status'] == 'ACCEPTED') {
			//TODO: update the particular order table to indicate if paid or not

			//might need to send user email about order and payment record
			//also redirect user to his order detail page - kind of order invoice..
			return view('ipay.payment-success', ['amount' => $response['ipay_out__txn_amt']]);
		} else {

			dd('payment-failed');
		}
	}

}
