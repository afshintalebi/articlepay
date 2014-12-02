<?php
/**
* Articlepay Administrator transactions table
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class TableTransactions extends JTable {
	/**
	 * @var int Primary key
	 */
	public $id = 0;
	/**
	 * @var int
	 */
	public $payment_type_id = 0;
	/**
	 * @var int
	 */
	public $user_id = 0;
	/**
	 * @var int
	 */
	public $amount = 0;
	/**
	 * @var string
	 */
	public $ref_code = '';
	/**
	 * @var datetime
	 */
	public $created_date = '';
	/**
	 * @var string
	 */
	public $payment_data = '';
	/**
	 * @var int
	 */
	public $has_error = 0;
	/**
	 * @var int
	 */
	public $done = 0;
	
	function __construct(&$db) {
		parent::__construct ( '#__articlepay_transactions', 'id', $db );
	}
	/**
	 * Validation
	 *
	 * @return boolean True if buffer is valid
	 */
	function check()
	{
		if(!$this->payment_type_id && !(int)$this->payment_type_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR10' ));
			return false;	
		}
		if(!$this->user_id && !(int)$this->user_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR11' ));
			return false;	
		}
		if(!$this->amount && !(int)$this->amount) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR6' ));
			return false;
		}
		if(!$this->created_date) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR5' ));
			return false;
		}
		if(!$this->has_error=='1' && !$this->has_error==='0') {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR12' ));
			return false;
		}
		if(!$this->done=='1' && !$this->done==='0') {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR12' ));
			return false;
		}
		return true;
	}
}