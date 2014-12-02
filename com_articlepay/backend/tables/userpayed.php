<?php
/**
* Articlepay Administrator transactions table
* 
* @package com_articlepay
* @subpackage components
* @link http://www.packtpub.com
* @license GNU/GPL
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class TableUserpayed extends JTable {
	/**
	 * @var int Primary key
	 */
	public $id = 0;
	/**
	 * @var int
	 */
	public $article_id = 0;
	/**
	 * @var int
	 */
	public $user_id = 0;
	
	function __construct(&$db) {
		parent::__construct ( '#__articlepay_user_payed', 'id', $db );
	}
	/**
	 * Validation
	 *
	 * @return boolean True if buffer is valid
	 */
	function check()
	{
		if(!$this->article_id && !(int)$this->article_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR4' ));
			return false;	
		}
		if(!$this->user_id && !(int)$this->user_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR11' ));
			return false;	
		}
		return true;
	}
}