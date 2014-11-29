<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );
class ArticlepayControllerBought extends JController {
	public function display() {
		$view = &$this->getView ( 'bought', 'html' );
		$layout = JRequest::getVar( 'tmpl', 'default' );
		$model = &$this->getModel ( 'bought' );
		$view->setModel ( $model, true );
		$view->setLayout( $layout );

		// Use the View display method
		$view->display();
	}
	
}
?>