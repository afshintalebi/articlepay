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