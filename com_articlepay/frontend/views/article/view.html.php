<?php
/**
*  Articlepay Component Administrator Article View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );
class ArticlepayViewArticle extends JView {
	/**
	 * show login msg if user does not login
	 * @param string $tpl
	 */
	public function articleDetails($articleId,$tpl=null) {
		$model = &$this->getModel ( 'article' );
		$article =& $model->getArticleDetails($articleId);
		$failed=true;
		if($article) {
			$failed=false;
			$this->assignRef('article',  $article);
			$this->assign('paymentUrl',  JRoute::_('index.php?option=com_articlepay&task=pay_redirect&item='.$articleId));
		}
		$this->assign('failed',  $failed);
		$this->display( $tpl );
	}
}
?>