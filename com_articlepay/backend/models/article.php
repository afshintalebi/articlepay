<?php
/**
* Articlepay Administrator article model
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Import the JModel class
jimport ( 'joomla.application.component.model' );
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
	public function getArticles() {
		$db = & $this->getDBO ();
		$table = $db->nameQuote ($this->getDbName());
		$query = "SELECT * FROM " . $table;
		$db->setQuery ( $query );
		$this->_articles = $db->loadObjectList ();
		// Return the list of revues
		return $this->_articles;
	}
	
	public function checkItemExists() {
		$db = & $this->getDBO ();
		$article = JRequest::get ( 'post' );
		$table = $db->nameQuote ($this->getDbName());
		$query = "SELECT COUNT(*) FROM ".$table." WHERE `article_id`=".$db->Quote($article['article_id']);
		$db->setQuery($query);
		return $db->loadResult() > 0 ? true : false;
	}
	
	public function delete( $articleIds )
	{
		$db = $this->getDBO();
		$table = $db->nameQuote($this->getDbName());
		$id   = $db->nameQuote('id');
		$query = ' DELETE FROM '.$table.' WHERE '.$id. ' IN (' .implode( ',', $articleIds ). ') ';
		$db->setQuery( $query );
		if( !$db->query() )
		{
			$errorMessage = $this->getDBO()->getErrorMsg();
			JError::raiseError(500, JText::_('COM_ARTICLEPAY_VALIDATION_ERROR8')
			. $errorMessage );
		}
	}
	
	public function store() {
		// Get the table
		$table = & $this->getTable ('articles');
		$article = JRequest::get ( 'post' );
		// Convert the date to a form that the database can understand
		jimport ( 'joomla.utilities.date' );
		$article ['created_date'] = date('Y-m-d H:i:s',time());
		$article ['active'] = $article ['active'] ? '1' : '0';
		if (! $table->bind ( $article )) {
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		if (! $table->check ()) {
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		// Store the revue
		if (! $table->store()) {
			// An error occurred, update the model error message
			$this->setError ( $this->_db->getErrorMsg () );
			return false;
		}
		return true;
	}
}