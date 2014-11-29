<?php
/**
*  Articlepay Component Administrator Transaction View
* 
*  @package com_boxoffice
*  @subpackage components
*  @link http://www.packtpub.com
*  @license GNU/GPL
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );
/**
 * Revues View
 *
 * @package com_boxoffice
 * @subpackage components
 *            
 */
class ArticlepayViewTransaction extends JView {
	/**
	 * Revues view display method
	 *
	 * @return void
	 *
	 */
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