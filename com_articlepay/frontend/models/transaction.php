<?php
/**
* Articlepay Administrator transaction model
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Import the JModel class
jimport ( 'joomla.application.component.model' );
class ArticlepayModelTransaction extends JModel {
	/**
	 * @var int
	 */
	public $id=0;
	/**
	 * @var int
	 */
	public $paymentType=0;
	/**
	 * @var int
	 */
	public $articleId=0;
	/**
	 * @var int
	 */
	public $userId=0;
	/**
	 * @var int
	 */
	public $amount=0;
	/**
	 * @var string
	 */
	public $refCode='';
	/**
	 * @var string
	 */
	public $createdDate='';
	/**
	 * @var string
	 */
	public $paymentData='';
	/**
	 * @var int
	 */
	public $hasError=0;
	/**
	 * @var int
	 */
	public $done=0;
	/**
	 * Method to get a list of revues
	 *
	 * @access public
	 * @return array of objects
	 */
	private function getDbName() {
		return '#__articlepay_transactions';
	}
	public function transactionDetails($refCode,$paymentType) {
		$result=0;
// 		if($refCode && $paymentType) {
		if($refCode) {
			$db = & $this->getDBO ();
			$table = $db->nameQuote ($this->getDbName());
			$fields=array();
			$fields[0] = $db->nameQuote ('id');
			$fields[1] = $db->nameQuote ('payment_type_id');
			$fields[2] = $db->nameQuote ('user_id');
			$fields[3] = $db->nameQuote ('amount');
			$fields[4] = $db->nameQuote ('ref_code');
			$fields[5] = $db->nameQuote ('created_date');
			$fields[6] = $db->nameQuote ('created_date');
			$fields[7] = $db->nameQuote ('payment_data');
			$fields[8] = $db->nameQuote ('has_error');
			$fields[9] = $db->nameQuote ('done');
			$fields[10] = $db->nameQuote ('article_id');
			$refCode = $db->Quote ($refCode);
			$paymentType = $db->Quote ($paymentType);
// 			$query = "SELECT ".implode(',', $fields)." FROM ".$table." WHERE $fields[1]=$paymentType AND $fields[4]=$refCode";
			$query = "SELECT ".implode(',', $fields)." FROM ".$table." WHERE $fields[4] LIKE $refCode";
			$db->setQuery($query);
			$result=$db->loadObject();
		}
		return $result;
		
	}
	/**
	 * store transaction
	 * @return boolean
	 */
	public function store() {
		// Get the table
		$table = & $this->getTable ('transactions');
		$data=array(
				'payment_type_id'=>$this->paymentType,
				'article_id'=>$this->articleId,
				'user_id'=>$this->userId,
				'amount'=>$this->amount,
				'ref_code'=>$this->refCode,
				'created_date'=>$this->createdDate,
				'payment_data'=>$this->paymentData,
				'has_error'=>$this->hasError,
				'done'=>$this->done,
		);
		if (! $table->bind ( $data )) {
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		if (! $table->check ()) {
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		// Store the revue
		if (! $table->store()) {
			// An error occurred, update the model error message
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		return true;
	}
	public function updatePaymentData() {
		// Get the table
		$table = & $this->getTable ('transactions');
		$table->reset();
		$result=false;
		if($table->load($this->id)) {
			$table->set('payment_data', $this->paymentData);
			$table->set('has_error', $this->hasError);
			$table->set('done', $this->done);
			$result=$table->store(true) ? true : false;
		}
		return $result;
	}
}
?>