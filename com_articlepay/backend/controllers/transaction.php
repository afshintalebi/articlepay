<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );
class ArticlepayControllerTransaction extends JController {
	public function display() {
		$view = &$this->getView ( 'transaction', 'html' );
		$layout = JRequest::getVar( 'tmpl', 'default' );
		$model = &$this->getModel ( 'transaction' );
		$view->setModel ( $model, true );
		$view->setLayout( $layout );

		// Use the View display method
		$view->display();
	}
	
	
	public function delete() {
		$ids = JRequest::getVar ( 'cid', null, 'default', 'array' );
		if ($ids === null) {
			// Make sure there were records to be removed
			JError::raiseError ( 500, '' );
		}
		$model = & $this->getModel ( 'transaction' );
		$model->delete ( $ids );
		$redirectTo = JRoute::_ ( 'index.php?option=com_articlepay&view=transaction',false);
		$this->setRedirect ( $redirectTo, JText::_('COM_ARTICLEPAY_TRANSACTION_DELETED_MSG') );
	}
}
?>