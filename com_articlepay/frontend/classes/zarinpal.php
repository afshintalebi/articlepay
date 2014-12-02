<?php
/**
 * ZarinaPal gateway class
 *
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
 */
class ZarinPalPayment {
	public $status = array (
			'100' => 'تراکنش با موفقیت انجام شد',
			'101' => 'تراکنش با موفقیت انجام شد ، اما عملیات PaymentVerification قبلا بر روی این تراکنش انجام شده است',
			'-1' => 'اطلاعات ارسال شده ناقض است',
			'-2' => 'IP و یا مرچنت کد پذیرنده صحیح نیست .',
			'-3' => 'رقم باید بالای 100 تومان باشد',
			'-4' => 'سطح تایید پذیرنده پایین تر از سطح نقره ای می باشد',
			'-11' => 'درخواست مورد نظر یافت نشد',
			'-21' => 'هیچ نوع عملیات مالی برای این تراکنش یافت نشد',
			'-22' => 'تراکنش موقیت آمیز نبود',
			'-33' => 'رقم تراکنش با رقم پرداخت شده مطابقت ندارد',
			'-54' => 'درخواست مورد نظر آرشیو شده است',
// 			added custom error number 
			'-55' => 'شناسه مرجع درخواست معتبر نمی باشد',
	);
	private $_errors = array (
			'merchant' => 'کد درگاه پرداخت تعریف نشده است',
			'authority' => 'کد شناسه مرجع تعریف نشده است',
			'amount' => 'مبلغ تراکنش تعریف نشده است', 
			'description' => 'توضیحات تعریف نشده است', 
			'callBackURL' => 'آدرس بازگشت تعریف نشده است',
	);
	private $_deSoapURL = 'https://ir.zarinpal.com/pg/services/WebGate/wsdl';
	private $_irSoapURL = 'https://ir.zarinpal.com/pg/services/WebGate/wsdl';
	private $webGateURL = 'https://www.zarinpal.com/pg/StartPay/';
	private $zarinGateURL = 'https://www.zarinpal.com/pg/StartPay/';

	
	public $merchantCode = '5413e130-a2d8-4fb4-a34c-03a95bef37d4';
	public $callBackURL = '';
	public $authority = '';
	public $amount = 0;
	public $description = '';
	public $email = '';
	public $mobile = '';
	public function __construct() {
	}
	private function checkPaymentRequestParams() {
		if (!$this->merchantCode || strlen ( $this->merchantCode ) != 36)
			die ( $this->_errors ['merchant'] );
		if (!( int ) $this->amount)
			die ( $this->_errors ['amount'] );
		if (!$this->description)
			die ( $this->_errors ['description'] );
		if (!$this->callBackURL)
			die ( $this->_errors ['callBackURL'] );
		
	}
	private function checkPaymentVerificationParams() {
		if (!$this->merchantCode || strlen ( $this->merchantCode ) != 36)
			die ( $this->_errors ['merchant'] );
		if (!( int ) $this->amount)
			die ( $this->_errors ['amount'] );
		if (!$this->authority)
			die ( $this->_errors ['authority'] );
		
	}
	private function makeUrlParams($params) {
		$result='';
		if(is_array($params) && $params) {
			$temp=array();
			foreach ($params as $key=>$param) {
				$temp[]=$key.'='.$param;
			}
			$result=implode('&', $temp);
		}
		return $result;
	}
	public function redirectToWebGate($autority,$params=array()) {
		if(!$autority && strlen($autority) != 36) {
			die('شناسه مرجع درخواست تعریف نشده است');
		}
		$params=$this->makeUrlParams($params,$params=array());
		header('location:'.$this->webGateURL.$autority.($params ? '?'.$params : ''));
		exit();
	}
	public function redirectToZarinGate($autority,$params) {
		if(!$autority && strlen($autority) != 36) {
			die('شناسه مرجع درخواست تعریف نشده است');
		}
		$params=$this->makeUrlParams($params);
		header('location:'.$this->zarinGateURL.$autority.'/ZarinGate'.($params ? '?'.$params : ''));
		exit();
	}
	public function PaymentRequest() {
		$this->checkPaymentRequestParams();
		$client = new soapclient ( $this->_irSoapURL );
		$parameters = array (
				'MerchantID' => $this->merchantCode,
				'Amount' => $this->amount,
				'Description' => $this->description,
				'Email' => $this->email,
				'Mobile' => $this->mobile,
				'CallbackURL' => $this->callBackURL 
		);
		$result = $client->PaymentRequest ( $parameters );
		if(strlen($result->Authority) != 36) {
			die($this->status[-55]);
		}
		return array (
				'status' => $result->Status,
				'authority' => $result->Authority 
		);
	}
	public function PaymentVerification() {
		$this->checkPaymentVerificationParams();
		$client = new soapclient ( $this->_irSoapURL );
		$parameters = array (
				'MerchantID' => $this->merchantCode,
				'Authority' => $this->authority,
				'Amount' => $this->amount 
		);
		$result = $client->PaymentVerification ( $parameters );
		return array (
				'status' => $result->Status,
				'refId' => $result->RefID
		);
	}
}
?>