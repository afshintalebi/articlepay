<?php
/**
* Articlepay Administrator transaction model
* 
* @package com_articlepay
* @subpackage components
* @link http://www.packtpub.com
* @license GNU/GPL
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Import the JModel class
jimport ( 'joomla.application.component.model' );
/**
 * Articlepay Article Model
 *
 * @package com_articlepay
 * @subpackage components
 */
class ArticlepayModelTransaction extends JModel {
	/**
	 * Transactions data array of objects
	 *
	 * @access private
	 * @var array
	 */
	public $_transactions;
	/**
	 * Method to get a list of transactions
	 *
	 * @access public
	 * @return array of objects
	 */
	private function getDbName() {
		return '#__articlepay_transactions';
	}
	public function getTransactions() {
		$db = & $this->getDBO ();
		$table = $db->nameQuote ($this->getDbName());
		$joinTable1=$db->nameQuote('#__articlepay_payment_types');
		$joinTable2=$db->nameQuote('#__users');
		$query = "SELECT 
					`trn`.`id`,`trn`.`payment_type_id`,`trn`.`user_id`,
					`trn`.`amount`,`trn`.`created_date`,`trn`.`payment_data`,
					`trn`.`has_error`,`trn`.`done`,`trn`.`ref_code`,
					`pmtp`.`title` AS `payment_type`, 
					`usr`.`username`
				  FROM ".$table." AS `trn`
				  INNER JOIN $joinTable1 AS `pmtp` ON `pmtp`.`id`=`trn`.`payment_type_id`
				  INNER JOIN $joinTable2 AS `usr` ON `usr`.`id`=`trn`.`user_id`;";
		$db->setQuery ( $query );
		$this->_transactions = $db->loadObjectList ();
		// Return the list of revues
		return $this->_transactions;
	}
	
	
	public function delete( $ids )
	{
		$db = $this->getDBO();
		$table = $db->nameQuote($this->getDbName());
		$id   = $db->nameQuote('id');
		$query = ' DELETE FROM '.$table.' WHERE '.$id. ' IN (' .implode( ',', $ids ). ') ';
		$db->setQuery( $query );
		if( !$db->query() )
		{
			$errorMessage = $this->getDBO()->getErrorMsg();
			JError::raiseError(500, JText::_('COM_ARTICLEPAY_VALIDATION_ERROR13')
			. $errorMessage );
		}
	}
}