<?php
/**
*  Articlepay Component Administrator Bought View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );
class ArticlepayViewBought extends JView {
	public function display($tpl=null) {
		JToolBarHelper::title ( JText::_ ( 'COM_ARTICLEPAY_BOUGHT_LIST_PAGE_TITLE' ));
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_articlepay');
		$model = &$this->getModel ( 'bought' );
		$articlesPayed =& $model->getArticlesPayed();
		$this->assignRef('articlesPayed',  $articlesPayed);
		parent::display( $tpl );
	}
	
}
?>