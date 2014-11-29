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
class ArticlepayModelBought extends JModel {
	/**
	 * @var int
	 */
	public $articleId;
	/**
	 * @var int
	 */
	public $userId;
	/**
	 * Method to get a list of revues
	 *
	 * @access public
	 * @return array of objects
	 */
	private function getDbName() {
		return '#__articlepay_user_payed';
	}
	
	public function isUserPayed($user,$article) {
		$count=0;
		if($user && $article) {
			$db = & $this->getDBO ();
			$table = $db->nameQuote ($this->getDbName());
			$field1 = $db->nameQuote ('id');
			$field2 = $db->nameQuote ('user_id');
			$field3 = $db->nameQuote ('article_id');
			$articleId = $db->Quote ($article);
			$userId = $db->Quote ($user);
			$query = "SELECT COUNT($field1) FROM ".$table." WHERE $field2=$userId AND $field3=$articleId";
			$db->setQuery($query);
			$count=$db->loadResult();
		}
		return $count > 0 ? true : false;
	}
	
	public function saveUserPay() {
		$articleId=(int)$this->articleId;
		$userId=(int)$this->userId;
		$result=false;
		if($articleId && $userId) {
			$table = & $this->getTable ('userpayed');
			$result=true;
			$data=array(
					'article_id'=>$articleId,
					'user_id'=>$userId,
			);
			if (! $table->bind ( $data )) {
				$this->setError ( $this->_db->getErrorMsg () );
				$result=false;
			}
			if (! $table->check ()) {
				$this->setError ( $this->_db->getErrorMsg () );
				$result=false;
			}
			// Store the revue
			if (! $table->store()) {
				// An error occurred, update the model error message
				$this->setError ( $this->_db->getErrorMsg () );
				$result=false;
			}
		}
		return $result;
	}
	
}