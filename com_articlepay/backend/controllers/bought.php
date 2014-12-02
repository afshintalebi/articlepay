<?php
/**
 * Articlepay Administrator bought controller
 *
 * @package com_articlepay
 * @subpackage components
 * @link https://github.com/afshintalebi/articlepay
 * @license GNU/GPL version 3
 */
// no direct access

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