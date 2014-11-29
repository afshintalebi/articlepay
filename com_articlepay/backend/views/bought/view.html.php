<?php
/**
*  Articlepay Component Administrator Article Payed View
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
class ArticlepayViewBought extends JView {
	/**
	 * Revues view display method
	 *
	 * @return void
	 *
	 */
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