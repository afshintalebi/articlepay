<?php
/**
* Articlepay Administrator article controller
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );
class ArticlepayControllerArticle extends JController {
	public function display() {
		$view = &$this->getView ( 'article', 'html' );
		$layout = JRequest::getVar( 'tmpl', 'list' );
		$model = &$this->getModel ( 'article' );
		$view->setModel ( $model, true );
		$view->setLayout( $layout );

		// Use the View display method
		$view->display();
	}
	/* function cancel() {
		$redirectTo = JRoute::_ ( 'index.php?option=' . JRequest::getVar ( 'option' ) . '&view=article' );
		$this->setRedirect ( $redirectTo, 'Cancelled' );
	} */
	public function add() {
		$view = &$this->getView ( 'article', 'html' );
		$layout = JRequest::getVar( 'tmpl', 'form' );
		$model = &$this->getModel ( 'article' );
// 		check for submitted form
		if($_POST) {
			$result=false;
			$exist=$model->checkItemExists();
			if(!$exist) {
				$result=$model->store();
			}
			$resultUrl=JRoute::_('index.php?option=com_articlepay&amp;view=article&amp;task=result&amp;exist='.($exist ? '1' : '0').'&amp;result='.($result ? '1' : '0'),false);
			$this->setRedirect ($resultUrl);
			$this->redirect();
		}
		$view->setModel ( $model, true );
		$view->setLayout( $layout );

		// Use the View display method
		$view->form();
	}
	
	public function result() {
		$view = &$this->getView ( 'article', 'html' );
		$layout = JRequest::getVar( 'tmpl', 'result' );
		$view->setLayout($layout);
		// Use the View display method
		$view->result();
	}
	
	public function delete() {
		$articleIds = JRequest::getVar ( 'cid', null, 'default', 'array' );
		if ($articleIds === null) {
			// Make sure there were records to be removed
			JError::raiseError ( 500, '' );
		}
		$model = & $this->getModel ( 'article' );
		$model->delete ( $articleIds );
		$redirectTo = JRoute::_ ( 'index.php?option=com_articlepay&view=article',false);
		$this->setRedirect ( $redirectTo, JText::_('COM_ARTICLEPAY_DELETED_MSG') );
	}
}
?>