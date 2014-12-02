<?php
/**
*  Articlepay Component Administrator Transaction View
* 
* @package com_articlepay
 * @subpackage components
 * @link https://github.com/afshintalebi/articlepay
 * @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );
class ArticlepayViewTransaction extends JView {
	public function display($tpl=null) {
		JToolBarHelper::title ( JText::_ ( 'COM_ARTICLEPAY_TRANSACTIONS_LIST_PAGE_TITLE' ));
		JToolBarHelper::deleteList (JText::_ ( 'COM_ARTICLEPAY_DELETE_TRANSACTION_CONFIRM_MSG' ),'delete');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_articlepay');
		$model = &$this->getModel ( 'transaction' );
		$transactions =& $model->getTransactions();
		$this->assignRef('transactions',  $transactions);
		parent::display( $tpl );
	}
	
}
?>