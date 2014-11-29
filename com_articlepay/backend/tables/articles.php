<?php
/**
* Articlepay Administrator article table
* 
* @package com_articlepay
* @subpackage components
* @link http://www.packtpub.com
* @license GNU/GPL
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
/**
 * Article Table class
 *
 * @package com_boxoffice
 * @subpackage components
 *            
 */
class TableArticles extends JTable {
	/**
	 * @var int Primary key
	 */
	public $id = 0;
	/**
	 * @var int
	 */
	public $article_id = 0;
	/**
	 * @var string
	 */
	public $article_title = '';
	/**
	 * @var int
	 */
	public $article_cat_id = 0;
	/**
	 * @var string
	 */
	public $article_object = '';
	/**
	 * @var datetime
	 */
	public $article_link = '';
	/**
	 * @var string
	 */
	public $article_lang = '';
	/**
	 * @var string
	 */
	public $created_date = '';
	/**
	 * @var int
	 */
	public $amount = 0;
	/**
	 * @var int
	 */
	public $active = 0;
	
	function __construct(&$db) {
		parent::__construct ( '#__articlepay_articles', 'id', $db );
	}
	/**
	 * Validation
	 *
	 * @return boolean True if buffer is valid
	 */
	function check()
	{
		if(!$this->article_id && !(int)$this->article_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR1' ));
			return false;	
		}
		if(!$this->article_title) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR2' ));
			return false;	
		}
		if(!$this->article_cat_id && !(int)$this->article_cat_id) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR3' ));
			return false;	
		}
		if(!$this->article_link) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR4' ));
			return false;	
		}
		if(!$this->created_date) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR5' ));
			return false;
		}
		if(!$this->amount && !(int)$this->amount) {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR6' ));
			return false;
		}
		if(!$this->active=='1' && !$this->active==='0') {
			$this->setError(JText::_ ( 'COM_ARTICLEPAY_VALIDATION_ERROR7' ));
			return false;
		}
		return true;
	}
}