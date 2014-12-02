<?php
/**
*  Articlepay Component Administrator User View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );
class ArticlepayViewUser extends JView {
	/**
	 * show login msg if user does not login
	 * @param string $tpl
	 */
	public function loginRequired($tpl=null) {
		parent::display( $tpl );
	}
}
?>