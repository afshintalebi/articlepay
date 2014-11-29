<?php
/**
*  Articlepay Component Administrator Article View
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
class ArticlepayViewArticle extends JView {
	/**
	 * Revues view display method
	 *
	 * @return void
	 *
	 */
	public function display($tpl=null) {
		JToolBarHelper::title ( JText::_ ( 'COM_ARTICLEPAY_LIST_PAGE_TITLE' ));
		JToolBarHelper::deleteList (JText::_ ( 'COM_ARTICLEPAY_DELETE_CONFIRM_MSG' ),'delete');
		JToolBarHelper::addNewX ('add');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_articlepay');
		$model = &$this->getModel ( 'article' );
		$articles =& $model->getArticles();
		$this->assignRef('articles',  $articles);
		parent::display( $tpl );
	}
	
	public function form($tpl=null) {
		JToolBarHelper::title ( JText::_ ('COM_ARTICLEPAY_ADD_PAGE_TITLE'));
		JToolBarHelper::save('add');
		JToolBarHelper::cancel('cancel');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_articlepay');
// 		JToolBarHelper::deleteList ();
// 		JToolBarHelper::editListX ();
// 		JToolBarHelper::addNewX ();
		parent::display( $tpl );
	}
	public function result($tpl=null) {
		JToolBarHelper::title ( JText::_ ('COM_ARTICLEPAY_ADD_PAGE_TITLE'));
		JToolBarHelper::addNewX ('add');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_articlepay');
		parent::display( $tpl );
	}
}
?>