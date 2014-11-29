<?php
/**
* Articlepay Administrator article model
* 
* @package com_articlepay
* @subpackage components
* @link http://www.packtpub.com
* @license GNU/GPL
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Import the JModel class
jimport ( 'joomla.application.component.model' );
/**
 * Articlepay Article Model
 *
 * @package com_articlepay
 * @subpackage components
 */
class ArticlepayModelArticle extends JModel {
	/**
	 * Articles data array of objects
	 *
	 * @access private
	 * @var array
	 */
	public $_articles;
	/**
	 * Method to get a list of revues
	 *
	 * @access public
	 * @return array of objects
	 */
	private function getDbName() {
		return '#__articlepay_articles';
	}
	public function getArticleDetails($article) {
		$data=array();
		if($article) {
			$db = & $this->getDBO ();
			$table = $db->nameQuote ($this->getDbName());
			$field0 = $db->nameQuote ('id');
			$field1 = $db->nameQuote ('article_id');
			$field2 = $db->nameQuote ('article_title');
			$field3 = $db->nameQuote ('article_link');
			$field4 = $db->nameQuote ('amount');
			$field5 = $db->nameQuote ('active');
			$articleId = $db->Quote ($article);
			$query = "SELECT $field0,$field1,$field2,$field3,$field4,$field5 FROM ".$table." WHERE $field1=$articleId AND $field5=1";
			$db->setQuery($query);
			$data=$db->loadObject();
		}
		return $data;
	}
	public function getArticlePrice($article) {
		$amount=0;
		if($article) {
			$db = & $this->getDBO ();
			$table = $db->nameQuote ($this->getDbName());
			$field1 = $db->nameQuote ('amount');
			$field2 = $db->nameQuote ('article_id');
			$field3 = $db->nameQuote ('active');
			$articleId = $db->Quote ($article);
			$query = "SELECT $field1 FROM ".$table." WHERE $field2=$articleId AND $field3=1";
			$db->setQuery($query);
			$amount=$db->loadResult();
		}
		return $amount;
	}
	public function isArticlePayable($article) {
		$count=0;
		if($article) {
			$db = & $this->getDBO ();
			$table = $db->nameQuote ($this->getDbName());
			$field1 = $db->nameQuote ('id');
			$field2 = $db->nameQuote ('article_id');
			$field3 = $db->nameQuote ('active');
			$field4 = $db->nameQuote ('amount');
			$articleId = $db->Quote ($article);
			$query = "SELECT COUNT($field1) FROM ".$table." WHERE $field2=$articleId AND $field3=1 AND $field4 > 0";
			$db->setQuery($query);
			$count=$db->loadResult();
		}
		return $count > 0 ? true : false;
	}
	
}